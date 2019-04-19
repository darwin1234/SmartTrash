#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;



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

WiFiClient client;
HTTPClient http;


void setup() {
   Serial.begin(9600); // Starts the serial communication
   Serial.println();
   Serial.println();
   Serial.println();

  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("SSID", "PASSWORD");

    
pinMode(trigPin_1, OUTPUT); // Sets the trigPin as an Output
pinMode(echoPin_1, INPUT); // Sets the echoPin as an Input

pinMode(trigPin_2, OUTPUT); // Sets the trigPin as an Output
pinMode(echoPin_2, INPUT); // Sets the echoPin as an Input

pinMode(trigPin_3, OUTPUT); // Sets the trigPin as an Output
pinMode(echoPin_3, INPUT); // Sets the echoPin as an Input

}


void ultrasonic(int type){

  if(type == 1){ 

      if (http.begin(client, "http://jigsaw.w3.org/HTTP/connection.html")) 
      {  // HTTP

        int httpCode = http.GET();

        // httpCode will be negative on error
        if (httpCode > 0) {
          // HTTP header has been send and Server response header has been handled
          Serial.printf("[HTTP] GET... code: %d\n", httpCode);
  
          // file found at server
          if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
            String payload = http.getString();
            Serial.println(payload);
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
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();     
      delay(2000);
  }
 }

  if(type == 2){ 
     if (http.begin(client, "http://jigsaw.w3.org/HTTP/connection.html")) 
     {  // HTTP

        int httpCode = http.GET();

        // httpCode will be negative on error
        if (httpCode > 0) {
          // HTTP header has been send and Server response header has been handled
          Serial.printf("[HTTP] GET... code: %d\n", httpCode);
  
          // file found at server
          if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
            String payload = http.getString();
            Serial.println(payload);
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
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();     
      delay(2000);
   }
  }

  if(type == 3){ 
   if (http.begin(client, "http://jigsaw.w3.org/HTTP/connection.html")) 
     {  // HTTP

        int httpCode = http.GET();

        // httpCode will be negative on error
        if (httpCode > 0) {
          // HTTP header has been send and Server response header has been handled
          Serial.printf("[HTTP] GET... code: %d\n", httpCode);
  
          // file found at server
          if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
            String payload = http.getString();
            Serial.println(payload);
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
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();     
      delay(2000);
   }
  }

}
void loop() {

   if ((WiFiMulti.run() == WL_CONNECTED)) 
   {
      Serial.print("[HTTP] begin...\n");
      ultrasonic(1);
      ultrasonic(2);
      ultrasonic(3);
    
    } else {
      Serial.printf("[HTTP} Unable to connect\n");
    }
 

}
