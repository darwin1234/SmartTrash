// defines pins numbers
const int trigPin_1 = D1; 
const int echoPin_1 = D0; 

const int trigPin_2 = D6;  
const int echoPin_2 = D5;  

const int trigPin_3 = D7;  
const int echoPin_3 = D8;  


// defines variables
long duration_1;
int distance_1;

long duration_2;
int distance_2;


long duration_3;
int distance_3;


void setup() {
pinMode(trigPin_1, OUTPUT); // Sets the trigPin as an Output
pinMode(echoPin_1, INPUT); // Sets the echoPin as an Input

pinMode(trigPin_2, OUTPUT); // Sets the trigPin as an Output
pinMode(echoPin_2, INPUT); // Sets the echoPin as an Input

pinMode(trigPin_3, OUTPUT); // Sets the trigPin as an Output
pinMode(echoPin_3, INPUT); // Sets the echoPin as an Input
Serial.begin(9600); // Starts the serial communication
}


void ultrasonic(int type){

  if(type == 1){ 
    // Clears the trigPin
      digitalWrite(trigPin_1, LOW);
      delayMicroseconds(2);
      
      // Sets the trigPin on HIGH state for 10 micro seconds
      digitalWrite(trigPin_1, HIGH);
      delayMicroseconds(10);
      digitalWrite(trigPin_1, LOW);
      
      // Reads the echoPin, returns the sound wave travel time in microseconds
      duration_1 = pulseIn(echoPin_1, HIGH);
      
      // Calculating the distance
      distance_1= duration_1*0.034/2;
      // Prints the distance on the Serial Monitor
      Serial.print("Ultrasonic 1: ");
      Serial.println(distance_1); 
     
  }

  if(type == 2){ 
    // Clears the trigPin
      digitalWrite(trigPin_2, LOW);
      delayMicroseconds(2);
      
      // Sets the trigPin on HIGH state for 10 micro seconds
      digitalWrite(trigPin_2, HIGH);
      delayMicroseconds(10);
      digitalWrite(trigPin_2, LOW);
      
      // Reads the echoPin, returns the sound wave travel time in microseconds
      duration_2 = pulseIn(echoPin_2, HIGH);
      
      // Calculating the distance
      distance_2= duration_2*0.034/2;
      // Prints the distance on the Serial Monitor
      Serial.print("Ultrasonic 2: ");
      Serial.println(distance_2);
     
  }

  if(type == 3){ 
    // Clears the trigPin
      digitalWrite(trigPin_3, LOW);
      delayMicroseconds(2);
      
      // Sets the trigPin on HIGH state for 10 micro seconds
      digitalWrite(trigPin_3, HIGH);
      delayMicroseconds(10);
      digitalWrite(trigPin_3, LOW);
      
      // Reads the echoPin, returns the sound wave travel time in microseconds
      duration_3 = pulseIn(echoPin_3, HIGH);
      
      // Calculating the distance
      distance_3= duration_3*0.034/2;
      // Prints the distance on the Serial Monitor
      Serial.print("Ultrasonic 3: ");
      Serial.println(distance_3);
      
  }
  delay(2000);
}
void loop() {
  ultrasonic(1);
  ultrasonic(2);
  ultrasonic(3);
}
