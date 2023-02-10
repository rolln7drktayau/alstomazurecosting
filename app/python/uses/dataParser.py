import csv 
import json 
import os

# dirPath = './BuildLogs/'
file = 'pricelist.csv'

def clearConsole():  # To clear the console before launching the script
    command = 'clear'
    if os.name in ('nt', 'dos'):  # If Machine is running on Windows, use cls
        command = 'cls'
    os.system(command)

def csv_to_json(csvFilePath, jsonFilePath):
    jsonArray = []
      
    #read csv file
    with open(csvFilePath, encoding='utf-8-sig') as csvf: 
        #load csv file data using csv library's dictionary reader
        csvReader = csv.DictReader(csvf) 

        #convert each csv row into python dict
        for row in csvReader: 
            #add this python dict to json array
            jsonArray.append(row)
  
    #convert python jsonArray to JSON String and write to file
    with open(jsonFilePath, 'w', encoding='utf-8-sig') as jsonf: 
        jsonString = json.dumps(jsonArray, indent=4, sort_keys=False, ensure_ascii=False, separators=None, default=None)
        jsonf.write(jsonString)