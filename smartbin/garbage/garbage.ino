/*
 Basic ESP8266 MQTT example

 This sketch demonstrates the capabilities of the pubsub library in combination
 with the ESP8266 board/library.

 It connects to an MQTT server then:
  - publishes "hello world" to the topic "outTopic" every two seconds
  - subscribes to the topic "inTopic", printing out any messages
    it receives. NB - it assumes the received payloads are strings not binary
  - If the first character of the topic "inTopic" is an 1, switch ON the ESP Led,
    else switch it off

 It will reconnect to the server if the connection is lost using a blocking
 reconnect function. See the 'mqtt_reconnect_nonblocking' example for how to
 achieve the same result without blocking the main loop.

 To install the ESP8266 board, (using Arduino 1.6.4+):
  - Add the following 3rd party board manager under "File -> Preferences -> Additional Boards Manager URLs":
       http://arduino.esp8266.com/stable/package_esp8266com_index.json
  - Open the "Tools -> Board -> Board Manager" and click install for the ESP8266"
  - Select your ESP8266 in "Tools -> Board"

*/
#include<String.h>
#define TRIGGER 5
#define ECHO    4
#define RED 12//D6
#define YELLOW 13//D7 
#define GREEN  15//D8

 String LOCATION= "BNR";
#include <ESP8266WiFi.h>
#include <PubSubClient.h>

// Update these with values suitable for your network.

const char* ssid = "vivo1803";
const char* password = "123456789";
const char* mqtt_server = "broker.mqttdashboard.com";

WiFiClient espClient;
PubSubClient client(espClient);
long lastMsg = 0;
char msg[50];
int value = 0;

void setup() {
  pinMode(RED, OUTPUT);
   pinMode(YELLOW, OUTPUT);
    pinMode(GREEN, OUTPUT);
    digitalWrite(RED,HIGH);
   digitalWrite(YELLOW,HIGH);
    digitalWrite(GREEN,HIGH);
  pinMode(TRIGGER, OUTPUT);
  pinMode(ECHO, INPUT);
  // Initialize the BUILTIN_LED pin as an output
  Serial.begin(115200);
  setup_wifi();
  client.setServer(mqtt_server, 1883);
  //client.setCallback(callback);
}

void setup_wifi() {

  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}


void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Attempt to connect
    if (client.connect("zxcv")) {
      Serial.println("connected");
      // Once connected, publish an announcement...
      client.publish("glsc", "hello world");
      // ... and resubscribe
      client.subscribe("glsc");
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}
void loop() {

  if (!client.connected()) {
    reconnect();
  }
  client.loop();
// client.publish("glsc", dist()+"cm");
dist();
delay(500);
  
}
long dist()
{
  long duration, distance;
  digitalWrite(TRIGGER, LOW);  
  delayMicroseconds(2); 
  
  digitalWrite(TRIGGER, HIGH);
  delayMicroseconds(10); 
  
  digitalWrite(TRIGGER, LOW);
  duration = pulseIn(ECHO, HIGH);
  distance = (duration/2) / 29.1;
  distTolevel(distance);
  
  Serial.println (distance);
  
}
void distTolevel(long dist)
{
  char Topic[]="bin_canara_project";

  if(dist>35)
  return;
  else if(dist>20)
  {
  digitalWrite(RED,LOW);
   digitalWrite(YELLOW,LOW);
    digitalWrite(GREEN,HIGH);
    String buff=LOCATION+("Garbage Empty");
    char pay[20];
    buff.toCharArray(pay,20);
    client.publish(Topic,pay );
  }
  else if(dist>5)
  {
     digitalWrite(RED,LOW);
      digitalWrite(GREEN,LOW);
       digitalWrite(YELLOW,HIGH);
         String buff= LOCATION+"Garbage Medium";
          char pay[20];
    buff.toCharArray(pay,20);
  client.publish(Topic,pay);
  }
  else 
  {
     digitalWrite(RED,HIGH);
     digitalWrite(YELLOW,LOW);
     digitalWrite(GREEN,LOW);
    String buff= LOCATION+"Garbage FULL";
          char pay[20];
    buff.toCharArray(pay,20);
  client.publish(Topic,pay);
  }

}






