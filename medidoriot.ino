#include <user_interface.h>;
os_timer_t tmr0;//Cria o Timer. Maximo de 7 Timer's.
os_timer_t tmr1;//Cria o Timer. Maximo de 7 Timer's.

#include <DS3231.h>
#include <Wire.h>
RTClib RTC;
DS3231 Clock;
String data="";

//#include "EmonLib.h"                        // inclui a biblioteca
//EnergyMonitor emon1;                        // Cria uma instância
//#define   SAMPLING_TIME     0.0001668649    // intervalo de amostragem 166,86us
//#define   LINE_FREQUENCY    60              // frequencia 60Hz Brasil
//#define   VOLTAGE_AC        127.00          // 127 Volts
//#define   ACS_MPY           15.41           // ganho/calibracao da corrente
//double Irms = 0;
//double a2d = 0;
int idamostra = 0;
int idregistro = 0;
int idbackup = 0;
int offset= 0;
int flagb=0;
int flaga=0;
int envia=0;
double Voltage = 0;
double tensaoplaca =0;
double mediat=0;
double mediac=0;
double Current = 0;
double Currente = 0;
int pmode = 1;
int idregbackup=0;
int flag=0;
double backup[650];
String linex={};
 
#include <ESP8266WiFi.h>
const char* ssid  = "Valadao";
const char* password = "valadao01";
const char* host = "192.168.100.4";
const char* passcode = "code";

#include "MCP320X.h"
// (Optional) Define model and SPI pins
#define CS_PIN D4     // ESP8266 default SPI pins
#define CLOCK_PIN D5  // Should work with any other GPIO pins, since the library does not formally
#define MOSI_PIN D7   // use SPI, but rather performs pin bit banging to emulate SPI communication.
#define MISO_PIN D6   //
#define MCP3208 8     // (Generally "#define MCP320X X", where X is the last model digit/number of inputs)
MCP320X adc(MCP3208, CLOCK_PIN, MOSI_PIN, MISO_PIN, CS_PIN);

//1-8 - chan 0-7 -> the 8 levels to be measured
//9 DGND -> GND
//10 CS chip select -> D4
//11 Din MOSI -> D7
//12 Dout MISO -> D6
//13 CLC clock -> D5
//14 AGN -> GND
//15 Vref -> reference voltage (that gives max adc reading)
//16 Vdd -> supply voltage, max 5.5V so Arduino 5V is fine

//1 | u | 16 
//2 |   | 15 
//3 |   | 14 
//4 |   | 13 
//5 |   | 12 
//6 |   | 11 
//7 |   | 10 
//8 |___| 9 



void enviowifi(){
  
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
    
  Serial.print("\n Connecting to ");
  Serial.println(host);

  WiFiClient client;
  if (!client.connect(host, 80)) {
    Serial.println("Connection failed!");
    return;
  }

    
    // Create a URL for the request. Modify YOUR_HOST_DIRECTORY so that you're pointing to the PHP file.
    String url = "http://";
    if(pmode==1){
    url += host;
    url += "/index.php?m=";
    url += pmode;
    url += "&p=";
    url += passcode;
    url += "&i=";
    url += idregistro;//
    url += "&c=";
    url += Currente;
    url += "&v=";
    url += tensaoplaca;
    url += "&d=";
    url += data;
    }
    else if(pmode==3)
    {
    url += host;
    url += "/index.php?m=";
    url += pmode;
    url += "&p=";
    url += passcode;
    url += "&qtdeamostra=";
    url += idregbackup;
    url += "&cmed=";
    for(int i = offset; i <= (idregbackup*2); i=i+2){
        url += backup[i];

        if(offset==0)
        {
          if((i!=((idregbackup*2)-2)))
          {url += ",";}
          if(i==(idregbackup*2)-2)
          {break;}
        }
        else if(i!=(offset-2))
          {url += ",";}
        if((i==(idregbackup*2)-2)&&(offset!=0))
          {i=0;
          flag=1;
          url += backup[i];
          if(i!=offset-2)
          {url+=",";}}
        if((i==offset-2)&&(flag==1))
          {break;}
      }
    flag=0;
    
  url += "&vmed=";
    for(int i = offset+1; i <= (idregbackup*2); i=i+2){
        url+=backup[i];
        if(offset==0)
        {
          if((i!=((idregbackup*2)-1)))
          {url+=",";}
          if(i==(idregbackup*2)-1)
          {break;}
        }
        else if(i!=(offset-1))
          {url+=",";}
        if((i==(idregbackup*2)-1)&&(offset!=0))
          {
          i=1;
          flag=1;
          url+=backup[i];
          if(i!=offset-1)
          {url+=",";}
          }
        if((i==offset-1)&&(flag==1))
          {break;}
      }    
    url += "&d=";
    url += data;
    flag=0;
    pmode=1;
    }

  // This will send the request to the server
  Serial.print("Requesting URL: ");
  Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }

    // Read all the lines of the reply from server and print them to Serial

  while(client.available()){
    linex = client.readStringUntil('\r');
    Serial.print(linex);
  }  
  Serial.print("\n");
  Serial.print(linex.substring((linex.length()-2),(linex.length())));
  Serial.print("\n");
  if(linex.substring(linex.length()-2,linex.length())=="OK")
  {
    Serial.print("foi \n");
    idbackup=0;
    offset=0;
    idregbackup=0;
    flagb=0;
  }

}

void corrente(){
    Voltage=0;
    for(int i = 0; i < 1000; i++) {
    Voltage = (Voltage + (.00122 * adc.readADC(0))); // (5 V / 1024 (Analog) = 0.0049) which converter Measured analog input voltage to 5 V Range
    delay(1);
    }
    Voltage = Voltage /1000;
    Current = (Voltage -2.5)/ 0.185; // Sensed voltage is converter to current
    Currente=Current;
    Serial.print("\t Current (A) = "); // shows the voltage measured
    Serial.print(Currente,2); // the ‘2’ after voltage allows you to display 2 digits after decimal point
    Serial.print("\n");

//    Irms = emon1.calcIrms(1996); //leitura AC do ACS712 
}

void tensao(){
    Voltage=0;
    for(int i = 0; i < 1000; i++) {
    Voltage =(Voltage + (adc.readADC(1)/819.2));
    delay(1);
    }
    Voltage = Voltage /1000;
    tensaoplaca=Voltage*26.3;
    Serial.print("\t tensaum (V) = "); // shows the voltage measured
    Serial.print(tensaoplaca,2); // the ‘2’ after voltage allows you to display 2 digits after decimal point
    Serial.print("\n");
}

void datanow(){
    DateTime now = RTC.now();
    data="";
    data+=now.year();
    data+="/";
    data+=now.month();
    data+="/";
    data+=now.day();
    data+=now.hour();
    data+=":";
    data+=now.minute();
    data+=":";
    data+=now.second();
}


//void amostrar() {
//    tensao();
//    corrente();
//    mediat=mediat+tensaoplaca;
//    mediac=mediac+Currente;
//    idregistro++;
//    if(idregistro>1)
//    { 
//      backup[idbackup]=(mediac/idregistro);
//      backup[idbackup+1]=(mediat/idregistro);
//      idregistro=0;
//      if(idregbackup<3)//nro max de registro de backup, tamanho do vetor backup/2
//        {idregbackup++;}
//      idbackup=idbackup+2;
//      mediat=0;
//      mediac=0;
//      if(flagb==1)
//            { 
//            offset=offset+2;
//            if(offset==6)//tamanho do vetor backup
//              {offset=0;} 
//            }
//      if(idbackup==6)//tamanho do vetor backup
//            {flagb=1;
//            idbackup=0;}
//    }   
//}

void flagamostrar(void*z)
{
  flaga=1;
  }

  void flagenviar(void*z)
{
  envia=1;
  }

void setup() {
  
//  emon1.current(0, ACS_MPY);             // Corrente: pino analógico, calibracao.
  Serial.begin(115200);
  Wire.begin();

//    Clock.setClockMode(false);  // set to 24h
//    //setClockMode(true); // set to 12h
//
//    Clock.setYear(2018-48);
//    Clock.setMonth(8);
//    Clock.setDate(10);
//    Clock.setDoW(6);
//    Clock.setHour(19);
//    Clock.setMinute(3);
//    Clock.setSecond(0);

    datanow();
    Serial.print(data);
  os_timer_setfn(&tmr0, flagamostrar, NULL); //Indica ao Timer qual sera sua Sub rotina.
  os_timer_arm(&tmr0, 60000, true);  //Indica ao Timer seu Tempo em mS e se sera repetido ou apenas uma vez (loop = true)
                                     //Neste caso, queremos que o processo seja repetido, entao usaremos TRUE.
  
  os_timer_setfn(&tmr1, flagenviar, NULL); 
  os_timer_arm(&tmr1, 180000, true);  
}

void loop() {
  tensao();
  corrente();
  mediat=mediat+tensaoplaca;
  mediac=mediac+Currente;
  idregistro++;
  
 if(flaga==1)
  {  
    flaga=0;
    backup[idbackup]=(mediac/idregistro);
    backup[idbackup+1]=(mediat/idregistro);
    Serial.print("idregistro:");
    Serial.print(idregistro);
    Serial.print("\r\n");
    idregistro=0;
    if(idregbackup<300)//nro max de registro de backup, tamanho do vetor backup/2
      {idregbackup++;}
    idbackup=idbackup+2;
    mediat=0;
    mediac=0;
    if(flagb==1)
      { 
      offset=offset+2;
      if(offset==600)//tamanho do vetor backup
        {offset=0;} 
      }
      if(idbackup==600)//tamanho do vetor backup
        {flagb=1;
        idbackup=0;}
      if(idregbackup>2)
        {
          if(envia==1)
          {
          pmode=3;
          datanow();
          enviowifi();
          envia=0;
          }
        }
  
  }

    delay(5000);
}



