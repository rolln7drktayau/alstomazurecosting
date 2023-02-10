import json
import os
from wsgiref import headers
import requests
from eaDataDbCtrl import dbinsert


def clearConsole():  # To clear the console before launching the script
    command = 'clear'
    if os.name in ('nt', 'dos'):  # If Machine is running on Windows, use cls
        command = 'cls'
    os.system(command)


clearConsole()

# python3 api.py
# file = open("dataFetcher.json", "a")
token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6IjEtWkdJdHN5eHZodDlYNkpRM0Y1R3M2Vl9uWSJ9.eyJFbnJvbGxtZW50TnVtYmVyIjoiODg5OTExMDUiLCJJZCI6IjU5MTJhNTExLWZiZWQtNDhhOC1iMmZkLWQ1Y2RhYTVhMTJjZSIsIlJlcG9ydFZpZXciOiJFbnRlcnByaXNlIiwiUGFydG5lcklkIjoiIiwiRGVwYXJ0bWVudElkIjoiIiwiQWNjb3VudElkIjoiIiwiaXNzIjoiZWEubWljcm9zb2Z0YXp1cmUuY29tIiwiYXVkIjoiY2xpZW50LmVhLm1pY3Jvc29mdGF6dXJlLmNvbSIsImV4cCI6MTY3NjAxNzI3MCwibmJmIjoxNjYwMTE5NjcwfQ.OmylQrVdq0i0OYncHuF4w_CN8xsBzVaBCGMXIQriATzcq_aSKSxH6TUbFEnk1WClIYYt1h_plX7UFV_zs-FX6DujPrRHHVDcpIdZTy09WHGqZU23yzC3FKY0fVrLRhqQKGrdTLE0WdBbuITi0eu2qw5JlPX67ssK6KGs2m9OvFQIL3ka6sXV58yYHPmFhI0DKPZN7qQZdc-cVoIbPxNN8A5cwnBbcMJ8ZbcrQE5NWHDl2-mgyPMEvismcd5pm3Gz5AXxgFC0qyNrY22k8iUw2LaAKOPPYHqFc3Sma7kPql9_c7Gc7uonpZ2Q4upuCw6-L4Qkzh8U3TEqFi_Q47rBWw"
header = {"Authorization": "Bearer " + token}
url = 'https://consumption.azure.com/v3/enrollments/88991105/pricesheet'

response = requests.get(url, headers=header)

print(response.status_code)

content = response.json()
size = json.dumps(response.json())
item_dict = json.loads(size)
# print(len(item_dict))
# print(len(content))
# print(content)
# file.write(json.dumps(content, indent=2))
# print len(item_dict['result'][0]['run'])
for i in range(len(content)):
    result = content[i]
    dbinsert(result)