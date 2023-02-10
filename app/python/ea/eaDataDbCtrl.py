import mysql.connector
conn = mysql.connector.connect(host="localhost",
                               user="root", password="Admin_PMA_33",
                               database="alstom_costing_calculator",
                               auth_plugin='mysql_native_password')
cursor = conn.cursor()
# Opérations à réaliser sur la base ...


def clearTable():
    cursor.execute("""TRUNCATE TABLE eadata""")

def dbinsert(data):
    reference = (data['offerId'], 
                 data['id'], 
                 data['billingPeriodId'], 
                 data['meterId'],
                 data['meterName'],
                 data['unitOfMeasure'],
                 data['includedQuantity'],
                 data['partNumber'],
                 data['unitPrice'],
                 data['currencyCode'])
    cursor.execute("""INSERT INTO eadata (`offerId`, `id`, `billingPeriodId`, `meterId`, `meterName`, `unitOfMeasure`, `includedQuantity`, `partNumber`, `unitPrice`, `currencyCode`)
                    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)""", reference)
    conn.commit()
    # print("===> Done !!!")
# conn.close()