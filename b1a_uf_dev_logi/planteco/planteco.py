#!/usr/bin/env python3
# -*- coding:utf-8 -*-

import smbus
import time
import mysql.connector as mariadb

addresse = 0x48
entree_capt_humidite = 0x40
entree_capt_luminosite = 0x41
entree_capt_temperature = 0x42

bus = smbus.SMBus(1)

mariadb_connection = mariadb.connect(user='root', password='root',host='127.0.0.1', database='planteco')
cursor = mariadb_connection.cursor()

while 1:
	#bus.write_byte(addresse,entree_capt_humidite)
	value_humidite = bus.read_byte_data(addresse,entree_capt_humidite) 
	humidite = ( value_humidite / 1.77 )
	print("%1.0f  dhumidite" %(humidite))
	
	#bus.write_byte(addresse,entree_capt_luminosite)
	valeur_luminosite = bus.read_byte_data(addresse,entree_capt_luminosite)
	luminosite = valeur_luminosite
	print("%1.0f Lux" %(luminosite))
	
	bus.write_byte(addresse,entree_capt_temperature)
	valeur_temperature = bus.read_byte(addresse)
	temperature = (115 - (valeur_temperature) ) / 2.575 + 30
	print("%1.0f °C" %(temperature))
	
	cursor.execute("INSERT INTO planteco.rasplants (`DATE`,`Humidity`,`Luminosity`,`Temperature`)" "VALUES (NOW(), %s, %s, %s)", (humidite, luminosite, temperature))
	mariadb_connection.commit()
	time.sleep(3.0) 

mariadb_connection.close()
