import json
import os
import requests
from resDataDbCtrl import dbinsert

def clearConsole():  # To clear the console before launching the script
    command = 'clear'
    if os.name in ('nt', 'dos'):  # If Machine is running on Windows, use cls
        command = 'cls'
    os.system(command)

clearConsole()

# python3 api.py
# file = open("apiData.json", "a")
# url = 'https://prices.azure.com/api/retail/prices?api-version=2021-10-01-preview&currencyCode=%27EUR%27'
# url = 'https://prices.azure.com/api/retail/prices?api-version=2021-10-01-preview&meterRegion=%27primary%27&currencyCode=%27EUR%27'
# url = 'https://prices.azure.com/api/retail/prices?$filter=priceType%20eq%20%27Reservation%27%20and%20serviceName%20eq%20%27Virtual%20Machines%27%20and%20location%20eq%20%27EU%20West%27'
url = 'https://prices.azure.com/api/retail/prices?currencyCode=%27EUR%27&$filter=priceType%20eq%20%27Reservation%27%20and%20serviceName%20eq%20%27Virtual%20Machines%27'

while True:
    response = requests.get(url)
    content = response.json()
    for i in range(100):
        result = content['Items'][i]
        dbinsert(result)
    # file.write(json.dumps(content, indent=2))
    url = content['NextPageLink']
    # print(content['NextPageLink'])
    if(content['NextPageLink'] is None):
        break

# file.close()

# dbfile = open("./resDataDbCtrl.py")
# exec(dbfile.read)
# dbfile.close