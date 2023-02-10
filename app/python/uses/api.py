import json
from turtle import clear
from scripts.python.brain.dataParser import clearConsole, csv_to_json
from scripts.python.ea.eaDataDbCtrl import clearTable, dbinsert


csvFilePath = r'../../assets/pricelist/pricelist.csv'
jsonFilePath = r'../../database/data.json'

clearConsole()
# formatter(file)
# csv_to_json(csvFilePath, jsonFilePath)


fileObject = open("../../database/data.json", "r", encoding='utf-8-sig')
jsonContent = fileObject.read()
obj_python = json.loads(jsonContent)

clearTable()

for data in obj_python:
    # print(data['Unit Price'])
    data['Unit Price'] = data['Unit Price'].replace(',', '.')
    # print(data['Unit Price'])
    data['Unit Price'] = data['Unit Price'].replace(' €', '')
    # print(data['Unit Price'])
    data['Unit Price'] = data['Unit Price'].replace(' ', '')
    # print(data['Unit Price'])
    dbinsert(data)
# print(len(obj_python))
# test = obj_python[0]['Unit Price'].replace(',', '.')
# print(test)
# result = test.replace(' €', '')
# print(result)

print(type(obj_python))