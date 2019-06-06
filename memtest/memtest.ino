#include <stdlib.h>
#include<string.h>
#include<stdint.h>
#include<stdio.h>
#define DATA_MAXIMUM_ELEMENTS  (33554432)
typedef float t_sample;
typedef long t_genlib_err;
typedef float t_param;
typedef unsigned long long t_ptr_uint;
typedef struct _genlib_data t_genlib_data;
typedef t_ptr_uint t_ptr_size;    ///< unsigned pointer-sized value for counting (like size_t)  @ingroup misc
typedef char *t_ptr;
typedef float t_param;

struct ParamInfo
{
  t_param defaultvalue;
  void *defaultref;
  char hasinputminmax;
  char hasminmax;
  t_param inputmin, inputmax;
  t_param outputmin, outputmax;
  const char *name;
  const char *units;
  int paramtype;    // 0 -> float64, 1 -> symbol (table name)
  t_param exp;      // future, for scaling
};


struct CommonState
{
    t_sample sr;
    int vs;
    int numins;
    int numouts;
    const char **inputnames;
    const char **outputnames;
    int numparams;
    ParamInfo *params;

    void *parammap; // implementation-dependent
    void *api;      // implementation-dependent
};

typedef struct {
  int         dim, channels;
  t_sample *      data;
} t_genlib_data_info;


typedef struct {
  t_genlib_data_info  info;
  t_sample      cursor; // used by Delay
  //t_symbol *    name;
} t_dsp_gen_data;

static inline t_ptr sysmem_newptr(t_ptr_size size)
{
  return (t_ptr)malloc(size);
}

typedef enum {
  GENLIB_ERR_NONE =     0,  ///< No error
  GENLIB_ERR_GENERIC =    -1, ///< Generic error
  GENLIB_ERR_INVALID_PTR =  -2, ///< Invalid Pointer
  GENLIB_ERR_DUPLICATE =    -3, ///< Duplicate
  GENLIB_ERR_OUT_OF_MEM =   -4, ///< Out of memory

  GENLIB_ERR_LOOP_OVERFLOW =  100,  // too many iterations of loops in perform()
  GENLIB_ERR_NULL_BUFFER =  101 // missing signal data in perform()

} e_genlib_errorcodes;

inline uint64_t next_power_of_two(uint64_t v) {
    v--;
    v |= v >> 1;
    v |= v >> 2;
    v |= v >> 4;
    v |= v >> 8;
    v |= v >> 16;
    v |= v >> 32;
    v++;
    return v;
}
static inline  t_genlib_err genlib_data_getinfo(t_genlib_data *b, t_genlib_data_info *info);
t_genlib_err genlib_data_getinfo(t_genlib_data *b, t_genlib_data_info *info)
{
  t_dsp_gen_data *self = (t_dsp_gen_data *)b;
  info->dim = self->info.dim;
  info->channels = self->info.channels;
  info->data = self->info.data;
  return GENLIB_ERR_NONE;
}



static inline void genlib_data_setcursor(t_genlib_data *b, long cursor)
{
  t_dsp_gen_data *self = (t_dsp_gen_data *)b;
  self->cursor = t_sample(cursor);
}
static inline void sysmem_freeptr(void *ptr)
{
  free(ptr);
}



inline t_sample minimum(t_sample x, t_sample y) { return (y<x?y:x); }
inline t_sample maximum(t_sample x, t_sample y) { return (x<y?y:x); }

inline t_sample clamp(t_sample x, t_sample minVal, t_sample maxVal) {
  return minimum(maximum(x,minVal),maxVal);
}


inline t_sample linear_interp(t_sample a, t_sample x, t_sample y) {
  return x+a*(y-x);
}

static inline void set_zero64(t_sample *memory, long size)
{
  long i;

  for (i = 0; i < size; i++, memory++) {
    *memory = 0.;
  }
}




static inline void genlib_data_release(t_genlib_data *b)
{
  t_dsp_gen_data *self = (t_dsp_gen_data *)b;

  if (self->info.data) {
    sysmem_freeptr(self->info.data);
    self->info.data = 0;
  }
}

static inline void *genlib_obtain_reference_from_string(const char *name)
{
  return 0; // to be implemented
}
static inline t_genlib_data *genlib_obtain_data_from_reference(void *ref)
{
  t_dsp_gen_data *self = (t_dsp_gen_data *)malloc(sizeof(t_dsp_gen_data));
  self->info.dim = 0;
  self->info.channels = 0;
  self->info.data = 0;
  self->cursor = 0;
  return (t_genlib_data *)self;
}

static inline long genlib_data_getcursor(t_genlib_data *b)
{
  t_dsp_gen_data *self = (t_dsp_gen_data *)b;
  return long(self->cursor);
}

static inline void genlib_data_resize(t_genlib_data *b, long s, long c)
{
  t_dsp_gen_data *self = (t_dsp_gen_data *)b;

  size_t sz, oldsz, copysz;
  t_sample *old = 0;
  t_sample *replaced = 0;
  int i, j, copydim, copychannels, olddim, oldchannels;

  //printf("data resize %d %d\n", s, c);

  // cache old for copying:
  old = self->info.data;
  olddim = self->info.dim;
  oldchannels = self->info.channels;

  // limit [data] size:
  if (s * c > DATA_MAXIMUM_ELEMENTS) {
    s = DATA_MAXIMUM_ELEMENTS/c;
    //genlib_report_message("warning: constraining [data] to < 256MB");
  }
  // bytes required:
  sz = sizeof(t_sample) * s * c;
  oldsz = sizeof(t_sample) * olddim * oldchannels;

  if (old && sz == oldsz) {
    // no need to re-allocate, just resize
    // careful, audio thread may still be using it:
    if (s > olddim) {
      self->info.channels = c;
      self->info.dim = s;
    } else {
      self->info.dim = s;
      self->info.channels = c;
    }

    set_zero64(self->info.data, s * c);
    return;

  } else {

    // allocate new:
    replaced = (t_sample *)sysmem_newptr(sz);

    // check allocation:
    if (replaced == 0) {
      //genlib_report_error("allocating [data]: out of memory");
      // try to reallocate with a default/minimal size instead:
      if (s > 512 || c > 1) {
        genlib_data_resize((t_genlib_data *)self, 512, 1);
      } else {
        // if this fails, then Max is kaput anyway...
        genlib_data_resize((t_genlib_data *)self, 4, 1);
      }
      return;
    }

    // fill with zeroes:
    set_zero64(replaced, s * c);

    // copy in old data:
    if (old) {
      // frames to copy:
      // clamped:
      copydim = olddim > s ? s : olddim;
      // use memcpy if channels haven't changed:
      if (c == oldchannels) {
        copysz = sizeof(t_sample) * copydim * c;
        //post("reset resize (same channels) %p %p, %d", self->info.data, old, copysz);
        memcpy(replaced, old, copysz);
      } else {
        // memcpy won't work if channels have changed,
        // because data is interleaved.
        // clamp channels copied:
        copychannels = oldchannels > c ? c : oldchannels;
        //post("reset resize (different channels) %p %p, %d %d", self->info.data, old, copydim, copychannels);
        for (i = 0; i < copydim; i++) {
          for (j = 0; j < copychannels; j++) {
            replaced[j + i * c] = old[j + i * oldchannels];
          }
        }
      }
    }

    // now update info:
    if (old == 0) {
      self->info.data = replaced;
      self->info.dim = s;
      self->info.channels = c;
    } else {
      // need to be careful; the audio thread may still be using it
      // since dsp_gen_data is preserved through edits
      // the order of resizing has to be carefully done
      // to prevent indexing out of bounds
      // (or maybe I'm being too paranoid here...)
      if (oldsz > sz) {
        // shrink size first
        if (s > olddim) {
          self->info.channels = c;
          self->info.dim = s;
        } else {
          self->info.dim = s;
          self->info.channels = c;
        }
        self->info.data = replaced;
      } else {
        // shrink size after
        self->info.data = replaced;
        if (s > olddim) {
          self->info.channels = c;
          self->info.dim = s;
        } else {
          self->info.dim = s;
          self->info.channels = c;
        }
      }

      // done with old:
      sysmem_freeptr(old);

    }

  }
}

namespace darwin {

int num_inputs();
int num_outputs();
int num_params();
int perform(CommonState *cself, t_sample **ins, long numins, t_sample **outs, long numouts, long n);
void reset(CommonState *cself);
void setparameter(CommonState *cself, long index, t_param value, void *ref);
void getparameter(CommonState *cself, long index, t_param *value);
const char *getparametername(CommonState *cself, long index);
t_param getparametermin(CommonState *cself, long index);
t_param getparametermax(CommonState *cself, long index);
char getparameterhasminmax(CommonState *cself, long index);
const char *getparameterunits(CommonState *cself, long index);
size_t getstatesize(CommonState *cself);
short getstate(CommonState *cself, char *state);
short setstate(CommonState *cself, const char *state);
void *create(t_param sr, long vs);
void destroy(CommonState *cself);

} // C74_GENPLUGIN::





//DELAY
struct Delay {
  t_sample *memory;
  long size, wrap, maxdelay;
  long reader, writer;
  t_genlib_data *dataRef;
  Delay() : memory(0) {
    size = wrap = maxdelay = 0;
    reader = writer = 0;
    dataRef = 0;
  }
  ~Delay() {
    if (dataRef != 0) {
      // store write position for persistence:
      genlib_data_setcursor(dataRef, writer);
      // decrement reference count:
      genlib_data_release(dataRef);
    }
  }

  inline void reset(const char *name, long d) {
    // if needed, acquire the Data's global reference:
    if (dataRef == 0) {

      void *ref = genlib_obtain_reference_from_string(name);
      dataRef = genlib_obtain_data_from_reference(ref);
      if (dataRef == 0) {
        printf("failed to acquire data");
        //genlib_report_error("failed to acquire data");
        return;
      }

      // scale maxdelay to next highest power of 2:
      maxdelay = d;
      size = maxdelay < 2 ? 2 : maxdelay;
      size = long(next_power_of_two(size));

      // first reset should resize the memory:
      genlib_data_resize(dataRef, size, 1);

      t_genlib_data_info info;
      if (genlib_data_getinfo(dataRef, &info) == 0) {
        if (info.dim != size) {
          // at this point, could resolve by reducing to
          // maxdelay = size = next_power_of_two(info.dim+1)/2;
          // but really, if this happens, it means more than one
          // object is referring to the same t_gen_dsp_data.
          // which is probably bad news.
          //genlib_report_error("delay memory size error");
          memory = 0;
          return;
        }
        memory = info.data;
        writer = genlib_data_getcursor(dataRef);
      } else {
        //genlib_report_error("failed to acquire data info");
        printf("failed to acquire data info");
      }

    } else {
      // subsequent reset should zero the memory & heads:
      set_zero64(memory, size);
      writer = 0;
    }

    reader = writer;
    wrap = size-1;
  }
  inline void step(){
    reader++;
    if (reader >= size) reader = 0;
  }
  inline void write(t_sample x) {
    writer = reader;  // update write ptr
    memory[writer] = x;
  }
  
  inline t_sample read_step(t_sample d) {
    // extra half for nice rounding:
    // min 1 sample delay for read before write (r != w)
    const t_sample r = t_sample(size + reader) - clamp(d-t_sample(0.5), t_sample(reader != writer), t_sample(maxdelay));
    long r1 = long(r);
    return memory[r1 & wrap];
  }
  
  inline t_sample read_linear(t_sample d) {
    // min 1 sample delay for read before write (r != w)
    t_sample c = t_sample(clamp(d, t_sample(reader != writer), t_sample(maxdelay)));
    const t_sample r = t_sample(size + reader) - c;
    long r1 = long(r);
    long r2 = r1+1;
    t_sample a = r - (t_sample)r1;
    t_sample x = memory[r1 & wrap];
    t_sample y = memory[r2 & wrap];
    return linear_interp(a, x, y);
  }
  
};


//NOISE FUNCTION
struct Noise {
  unsigned long last;
  static long uniqueTickCount(void) {
    static long lasttime = 0;
    long time = 0;
    return (time <= lasttime) ? (++lasttime) : (lasttime = time);
  }

  Noise() { reset(); }
  Noise(t_sample seed) { reset(seed); }
  void reset() { last = uniqueTickCount() * uniqueTickCount(); }
  void reset(t_sample seed) { last = (unsigned long)(seed); }

  inline t_sample operator()() {
    last = 1664525L * last + 1013904223L;
    union {
      uint32_t ui32;
      float f;
    } u = { uint32_t(0x3f800000 | (0x007fffff & last)) }; // type-punning

    return (u.f * 2.f) - 3.f;
  }
};

namespace darwin {
  
  int gen_kernel_numins = 3;
  int gen_kernel_numouts = 2;

  int num_inputs() { return gen_kernel_numins; }
  int num_outputs() { return gen_kernel_numouts; }
  // The State struct contains all the state and procedures for the gendsp kernel
  void genlib_reset_complete(void *data)
  {
  }
  typedef struct State {
    CommonState __commonstate;
    Noise noise;
    Delay m_delay_1;
    int vectorsize;
    int __exception;
    t_sample samplerate;
    // re-initialize all member variables;
    inline void reset(t_param __sr, int __vs) {
      __exception = 0;
      vectorsize = __vs;
      samplerate = __sr;
      m_delay_1.reset("m_delay_1", samplerate);
      genlib_reset_complete(this);
      
    };
    
    // the signal processing routine;
    inline int perform(t_sample ** __ins, t_sample ** __outs, int __n) {
      
      vectorsize = __n;
      const t_sample * __in1 = __ins[0];
      const t_sample * __in2 = __ins[1];
      t_sample * __out1 = __outs[0];
      t_sample * __out2 = __outs[1];
      if (__exception) {
        return __exception;
        
      } else if (( (__in1 == 0) || (__out1 == 0) || (__out2 == 0) )) {
        __exception = GENLIB_ERR_NULL_BUFFER;
        return __exception;
        
      };
      // the main sample loop;
      while ((__n--)) {
        const t_sample in1 = (*(__in1++));
        t_sample noise_3 = noise();
        t_sample out1 = noise_3;
        t_sample out2 = noise_3;
        // assign results to output buffer;
        (*(__out1++)) = out1;
        (*(__out2++)) = out2;
        printf("%d",in1);
        
      };
      return __exception;
    
    };
    
  } State;

  
  void *create(t_param sr, long vs) {
    State *self = new State;
    self->reset(sr, vs);
    /*ParamInfo *pi;*/
    /*self->__commonstate.inputnames = gen_kernel_innames;
    self->__commonstate.outputnames = gen_kernel_outnames;
    self->__commonstate.numins = gen_kernel_numins;
    self->__commonstate.numouts = gen_kernel_numouts;*/
    self->__commonstate.sr = sr;
    self->__commonstate.vs = vs;
    self->__commonstate.params = 0;
    self->__commonstate.numparams = 0;
    
    return self;
  }
  
  void reset(CommonState *cself) {
    State * self = (State *)cself;
    self->reset(cself->sr, cself->vs);
    //printf("%d",cself->vs);
  }
  int perform(CommonState *cself, t_sample **ins, long numins, t_sample **outs, long numouts, long n) {
    State* self = (State *)cself;
    return self->perform(ins, outs, n);
  }

} // C74_GENPLUGIN::
void delayInit(){
 //double *writeT =  &d_buffer[MAX_BUFFER-1];
}
// memcpy(&buffer[write], input, samplesPerFrame); // Assuming samplesPerFrame = FRAME_SIZE
  CommonState       *m_C74PluginState;
  
  t_sample        **m_InputBuffers;
  t_sample        **m_OutputBuffers;
  
void setup() {
  // put your setup code here, to run once:
  m_C74PluginState = (CommonState *)darwin::create(44100, 64);
  darwin::reset(m_C74PluginState);
 // pinMode(D0,OUTPUT);
  
}

void loop() {
  // put your main code here, to run repeatedly:
  

}
