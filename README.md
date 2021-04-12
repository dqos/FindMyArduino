# FindMyArduino
FindMyArduino example inspired by Apple's Find My iPhone, locate your Arduino by using GPS. The best way to find back your Arduino if it walks away or gets stolen.

### Introduction
During my minor Smart Industry we had to build something for the *Smart Room*. This something is based on the Arduino knock off ESP32, which is a nice IoT hardware platform compatible with the Arduino IDE. In the end it will be a room full of smart IoT devices connected to eachother.


![fma_ui](https://raw.githubusercontent.com/dqos/FindMyArduino/main/img/fma_ui.jpg)

### Features
- **Realtime** location using Google Maps
- Remembers last known location 
- Shows last update date
- Shows Arduino connection status
- Comes with a simple API

### Hardware
The hardware is based on the ESP32 and a GY-GPS6MV2 GPS module. These components are Arduino compatible.

![fma_hardware](https://raw.githubusercontent.com/dqos/FindMyArduino/main/img/fma_hardware.jpg)

![fma_circuit](https://raw.githubusercontent.com/dqos/FindMyArduino/main/img/fma_circuit.jpg)

![fma_esp32](https://raw.githubusercontent.com/dqos/FindMyArduino/main/img/fma_esp32.jpg)

![fma_gps](https://raw.githubusercontent.com/dqos/FindMyArduino/main/img/fma_gps.jpg)

### Software
The software is based on the DemoProgram by Franz. If you don't have access to this code I refer you to the following links:

[http://arduinostuff.blogspot.nl/2014/05/neo6mv2-gps-module-with-arduino-uno-how.html](http://arduinostuff.blogspot.nl/2014/05/neo6mv2-gps-module-with-arduino-uno-how.html)

[http://www.ayomaonline.com/iot/gy-gps6mv2-neo6mv2-neo-6m-gps-module-with-arduino-usb-ttl/](http://www.ayomaonline.com/iot/gy-gps6mv2-neo6mv2-neo-6m-gps-module-with-arduino-usb-ttl/)

[https://github.com/mikalhart/TinyGPS](https://github.com/mikalhart/TinyGPS)

This project is build using PHP and Javascript. Powered by the Google Maps API. If you have access to DemoProgram, you can patch it by following the steps in ESP32-DemoProgram.patch.

*The Arduino ONLINE/OFFLINE status is fetched by comparing the last timestamp with the current timestamp minus the buffer of 10 seconds. Getting a timestamp in PHP is done using:*
```
strtotime(date("H:i:s d-m-Y")); // returns timestamp in SECONDS
```

*And in Javascript this is done using:*
```
curTime = new Date();
curTime.getTime(); // returns timestamp in MILLISECONDS
```

*Remember to devide the JS timestamp by 1000 like in the final example below:*
```
if ((JAVASCRIPTTIME/1000-PHPLASTTIME) > 10) { // offline
```

### Interoperability
One of the assignments is to make your project interact with other projects for the *Smart Room*. In this case FindMyArduino is just a sensor, it can't do anything else than pulsing GPS coordinates. This project includes a very simple API to get the current coordinates. Other students and their project are able to use this information in their systems.

The API can be accessed using two methods: RAW and JSON. The URL is currently accessible without authentication:
http://www.yoururl.com/gps.php?api=json
```
["2.94178","55.98296",1506511059]
```
http://www.yoururl.com/gps.php?api=raw
```
56.98821-3.92278
```

It will return the latest lattitude, longtitude and timestamp.

### Configuration
There isn't really much to configure, the only thing to remember is to change YOURLINK.COM to your website URL. YOURLINK.COM can be found in index.html and in the DemoProgram patch.

### License
MIT License
