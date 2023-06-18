# uni-fyp-project
UTeM Final Year Project Child Monitoring Alert System
Raspberry Pi Configuration Setup
Raspberry Pi configuration steps involves setting up the network and VNC server on Raspberry Pi to allow for Virtual Network Computing. 
Steps:
1.	Install VNC server on the Raspberry Pi with command “sudo apt install realvnc-vnc-server realvnc-vnc-viewer”.
 
Figure 5.12 Install VNC server
2.	Enable VNC server on Raspberry Pi using “sudo raspi-config”. Next, navigate to interfacing options and select VNC and select Yes.
 
Figure 5.13 Configure Raspberry Pi

 
Figure 5.14 Selecting Interface Options
 
Figure 5.15 Selecting VNC 
 
Figure 5.16 Enabling VNC Server
3.	Open VNC Server on Raspberry Pi and make sure Server is working.
 
Figure 5.17 Confirming VNC Server on Raspberry Pi
4.	Install VNC Viewer on laptop and connect to Raspberry Pi using VNC Viewer and establish connection using Raspberry Pi IP address or hostname.
 
Figure 5.18 Remote Control Raspberry Pi using Laptop

Sensors Configuration Setup
Sensor configuration setup will discuss the configuration on DHT-22 temperature sensor and MQ-7 carbon monoxide sensor for this project. Both sensors will be able to send data to the Raspberry Pi. 
DHT-22 Configuration setup
DHT-22 is a digital sensor that can measure temperature level. To integrate DHT-22 sensor with Raspberry Pi, the use of jumper wire through GPIO pins is needed. To run the DHT-22 sensor, execute python script called “fullproject.py”.
Steps:
1.	Download Adafruit DHT library code from GitHub for easier calibration. Run command “git clone https://github.com/adafruit/Adafruit_Python_DHT.git”.
 
Figure 5.19 Download library code from GitHub
2.	Change Directory to Adafruit_Python_DHT. Next, install Adafruit python DHT library.
 
Figure 5.20 Change directory and install DHT library
3.	Install Adafruit Library to Python
 
Figure 5.21 Install Adafruit on Python
4.	In “fullreport.py” add the following script. “import Adafruit_DHT as dht” to import Adafruit library. Line 3 in the code snippet will import the library. Line 11 in the code is to declare the DHT-22 GPIO Pin to 23. Line 104 is used to execute DHT code to read the value from the sensor.
 
Figure 5.22 Import Adafruit library 
 : Import Adafruit library
 : Set DHT GPIO Pin
 
Figure 5.23 Execute DHT code
	: DHT code execution to read value from sensor
MQ-7 Configuration setup
MQ-7 is an analogue sensor however, using an analogue to digital converter (ADC) will help with integrating the sensor with Raspberry Pi. The ADC use is the MCP3008. The MQ-7 sensor will send the data signal to the MC3008 and it will convert the signal to digital and send to Raspberry Pi. Figure below shows the python script for the sensor.
Steps:
1.	Assign variables with corresponding GPIO pin on the Raspberry Pi. “mq7_apin” is the channel number for the analogue pin. In this project, the CH0 is used therefore the assign value is 0.
 
Figure 5.24 Declaring MQ-7 Variables
2.	Init function is created to set up and initialize GPIO interface pins. The function is also used to clean up GPIO at the end of the script.
 
Figure 5.25 Initialize GPIO pin MQ-7
3.	Function readadc is to convert analogue signal received from sensor and converting it to digital signal that is readable. The function will return the digital value of the signal send from the sensor
 
Figure 5.26 Convert Analogue Signal MQ-7
4.	In main function, init function is called to initialize the GPIO pins and clean up GPIO pins. Next, readadc function is called to get the value from the sensor. Density and voltage value can be obtained. Line 103 will call the init () function to initialize GPIO pin. Line 120 will call readadc function to read value from sensor. Line 121 assigned voltage value and line 122 assigned density percentage of carbon monoxide.
 
Figure 5.27 Obtain MQ-7 Value
: Call init function to initialize GPIO pin
: Call readadc function with variables initialized on figure 5.20 and assign voltage value and density value 

Telegram Configuration Setup
Telegram is used to send an alert message to the user when a dangerous level is reached for either temperature or carbon monoxide level. Python script on Raspberry Pi will analyze the value received from the sensor and will send alert message to the user through Telegram bot. A Telegram group with multiple users will be created therefore the alert will also be received by other people.

Steps:
1.	Install telepot for python to enable Telegram bot to be used.
 
Figure 5.28 Install telepot for python
2.	On Telegram application on mobile, create a Telegram bot and save the unique token
 
Figure 5.29 Telegram bot token
3.	 Declare the telegram bot token to connect the python coding with the telegram bot. Next, the handle function is to handle the start of program when receive start order from user.
 
Figure 5.30 Telegram bot handle function
4.	Send Notification function to send alert message to user when threshold exceeds acceptable value.
 
Figure 5.31 Send Notification Function Telegram
5.	From line 107 to line 112 will check if the temperature exceeded 40 Celsius. If exceeded, send notification function for temperature is called. From line 126 to line 131 will check if carbon monoxide density exceeded 15%. If exceeded, send notification function for carbon monoxide is called.
 
Figure 5.32 Sending alert message on Telegram
: Send alert notification when Temperature exceeded 40 Celsius.
: Send alert notification when carbon monoxide exceeded 15% density.
Web Service Configuration Setup
Web service is installed on the Raspberry Pi to enable monitoring to the user. To enable web service, several services needed to be installed such as apache server, php, phpMyAdmin and MySQL. This web service allows user to monitor the data from the sensor. The data will also be stored in a database to allow user to check on previous data.
Steps:
1.	Configuring apache server on Raspberry Pi and verify that it works by typing IP address of Raspberry Pi on web browser
 
Figure 5.33 Configuring apache on Raspberry Pi
2.	Configuring php on Raspberry Pi and verifying that it works. After this, Raspberry Pi can execute php files.
 
Figure 5.34 Configuring php on Raspberry Pi
3.	Configuring MySQL on Raspberry Pi and configure the username and password to allow user to access the databases. Restart apache after installing MySQl.by default, the username is root and password is password.

 
Figure 5.35 Configuring MySQL on Raspberry Pi
4.	Installing and configuring PhpMyAdmin on Raspberry Pi and enable php mysqli extension with “sudo phpenmod mysqli”. Next, change directory for phpMyAdmin.
 
Figure 5.36 Configuring phpMyAdmin 
 
Figure 5.37 Change phpMyAdmin directory
5.	Create database named childmonitor on phpMyAdmin for the project. A table with the name monitoring is created with attributes in figure below
 
Figure 5.38 Create Database and Table in phpMyAdmin
6.	Configure Php web to monitor data that was sent from the sensor to the MySQL database. 
 
Figure 5.39 Connection to MySQL on php file
 
Figure 5.40 Select Data from MySQL database to View in php web
 
Figure 5.41 Import MySQL Connecter in python
 
Figure 5.42 Insert Data from Sensor to MySQL Database

Implementation Status
Implementation status will explain about the status of implementations for each environment and configuration setup. The estimated time to complete the construction as mentioned in chapter 3 is 56 days. In this project, the actual completed time is 49 days. The actual completed time is 7 days earlier than estimated time. This faster time is due to less error occurred thus requires less troubleshooting. The extra 7 days is focused more on testing of the project.
Table 5.3 Implementation status
No	Component	Description	Duration to Complete
1	Assemble Hardware	Connecting all hardware components to Raspberry Pi GPIO pins	9 days
2	Raspberry Pi Configuration	Setting up Raspberry Pi and installing VNC Server on Pi and connecting with Laptop through Virtual Network Computing	5 days
3	MQ-7 Configuration	Configuring python script to MQ-7 sensor to measure carbon monoxide level	10 days
4	DHT-22 Configuration	Configuring python script for DHT-22 sensor to measure temperature level 	11 days
5	Telegram Configuration	Configuring telegram bot and sending alert message through Telegram	4 days
6	Web Service Configuration	Creating web service using apache web server and phpMyAdmin to integrate web with MySQL database	10 days
