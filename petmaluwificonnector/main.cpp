#define DATA_LENGTH 255

#include "SerialPort.h"
#include <iostream>

char* portName = "\\\\.\\COM4";

//Declare a global object
SerialPort *arduino;

//Here '\n' is a delimiter 
char receivedString[DATA_LENGTH];

int main(void)
{
  arduino = new SerialPort(portName);
  if (arduino->isConnected()){
    int hasRead = arduino->readSerialPort(receivedString, DATA_LENGTH);
    if (hasRead) printf("%s", receivedString);
    else printf("Error occured reading data");
  }
}