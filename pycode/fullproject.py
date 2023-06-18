#Libraries
import RPi.GPIO as GPIO
import Adafruit_DHT as dht
from time import sleep
import telepot
import datetime
from telepot.loop import MessageLoop
import mysql.connector
import socket


#Set variable
DHT = 23
ctime=0
SPICLK = 11
SPIMISO = 9
SPIMOSI = 10
SPICS = 8
mq7_apin = 0

def init():
         GPIO.setwarnings(False)
         GPIO.cleanup()         #clean up at the end of your script
         GPIO.setmode(GPIO.BCM)     #to specify whilch pin numbering system
         # set up the SPI interface pins
         GPIO.setup(SPIMOSI, GPIO.OUT)
         GPIO.setup(SPIMISO, GPIO.IN)
         GPIO.setup(SPICLK, GPIO.OUT)
         GPIO.setup(SPICS, GPIO.OUT)

def readadc(adcnum, clockpin, mosipin, misopin, cspin):
        if ((adcnum > 7) or (adcnum < 0)):
                return -1
        GPIO.output(cspin, True)

        GPIO.output(clockpin, False)  # start clock low
        GPIO.output(cspin, False)     # bring CS low

        commandout = adcnum
        commandout |= 0x18  # start bit + single-ended bit
        commandout <<= 3    # we only need to send 5 bits here
        for i in range(5):
                if (commandout & 0x80):
                        GPIO.output(mosipin, True)
                else:
                        GPIO.output(mosipin, False)
                commandout <<= 1
                GPIO.output(clockpin, True)
                GPIO.output(clockpin, False)

        adcout = 0
        # read in one empty bit, one null bit and 10 ADC bits
        for i in range(12):
                GPIO.output(clockpin, True)
                GPIO.output(clockpin, False)
                adcout <<= 1
                if (GPIO.input(misopin)):
                        adcout |= 0x1

        GPIO.output(cspin, True)

        adcout >>= 1       # first bit is 'null' so drop it
        return adcout

def handle(msg):
    global telegramText
    global chat_id
    hostname = socket.gethostname()
    ip_address = socket.gethostbyname(hostname+ ".local")

    chat_id = msg['chat']['id']
    telegramText = msg['text']

    print('Message received from ' + str(chat_id))

    if telegramText == '/start':
        bot.sendMessage(chat_id, 'Welcome to Child Alert System in Vehicle')
        bot.sendMessage(chat_id, 'Link to Monitor ->'+ ip_address)
    while True:
        main()

bot = telepot.Bot('1241939415:AAGsFjqeIIuBK33x8ld2vndqOtIU7bgzDvg')
bot.message_loop(handle)

def sendTNotification(t):
    now = datetime.datetime.now()
    global chat_id
    bot.sendMessage(chat_id, 'ALERT!!! YOUR CHILD IS IN DANGER, THE TEMPERATURE INSIDE THE CAR IS: ''{0:0.1f}*C'.format(t))
    bot.sendMessage(chat_id, now.strftime("%Y-%m-%d %H:%M:%S"))

def sendCONotification(density):
    now = datetime.datetime.now()
    global chat_id
    bot.sendMessage(chat_id, 'ALERT!!! YOUR CHILD IS IN DANGER, THE CARBON MONOXIDE DENSITY INSIDE THE CAR IS: ''{0:0.2f}%'.format(density))
    bot.sendMessage(chat_id, now.strftime("%Y-%m-%d %H:%M:%S"))

    
def main():
    init()
    h,t = dht.read_retry(dht.DHT22, DHT)
    print('Temp={0:0.1f}*C'.format(t))

    if t>40:
        print("Temperature Alert")
        sendTNotification(t)
    
    print(" ")

    COlevel=readadc(mq7_apin, SPICLK, SPIMOSI, SPIMISO, SPICS)
    voltage = "%.2f"%((COlevel/1024.)*5)
    density = "%.2f"%((COlevel/1024.)*100)
    print("Current CO AD vaule = " +str(voltage)+" V")
    print("Current CO density is:" +str(density)+" %")

    if (float(density)) > 15:
        print("CO leakage Alert")
        sendCONotification(float(density))

    
    print(" ")

    current_time = datetime.datetime.now()
    mydb = mysql.connector.connect(host="localhost",user="root",password="password",database="childmonitor")
    mycursor = mydb.cursor()
    sql = "INSERT INTO monitoring (date_time, temperature, co_volt, co_density) VALUES (%s, %s, %s, %s)"
    val = (str(current_time), float(t), float(voltage), float(density) )
    mycursor.execute(sql, val)
    mydb.commit()
    print(mycursor.rowcount, "record inserted.")
    sleep(600)

def mainmain():
    print("Hello")
    sleep(60)


while True:
    mainmain()