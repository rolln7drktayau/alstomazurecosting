import mysql.connector
conn = mysql.connector.connect(host="localhost",
                               user="root", password="Admin_PMA_33",
                               database="alstom_costing_calculator",
                               auth_plugin='mysql_native_password')
cursor = conn.cursor()
# Opérations à réaliser sur la base ...

cursor.execute("""TRUNCATE TABLE rezdata""")

def dbinsert(data):
    reference = (data['currencyCode'], 
                 data['tierMinimumUnits'], 
                 data['reservationTerm'], 
                 data['retailPrice'], 
                 data['unitPrice'], 
                 data['armRegionName'], 
                 data['location'], 
                 data['effectiveStartDate'], 
                 data['meterId'], 
                 data['meterName'], 
                 data['productId'],
                 data['skuId'], 
                 data['productName'], 
                 data['skuName'], 
                 data['serviceName'], 
                 data['serviceId'], 
                 data['serviceFamily'], 
                 data['unitOfMeasure'], 
                 data['type'], 
                 data['isPrimaryMeterRegion'], 
                 data['armSkuName'])
    cursor.execute("""INSERT INTO rezdata (currencyCode, tierMinimumUnits, reservationTerm, retailPrice, unitPrice, armRegionName, location, effectiveStartDate, meterId, meterName, productId, skuId, productName, skuName, serviceName, serviceId, serviceFamily, unitOfMeasure, type, isPrimaryMeterRegion, armSkuName) 
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""", reference)


conn.commit()

print("===> Done !!!")
# conn.close()
