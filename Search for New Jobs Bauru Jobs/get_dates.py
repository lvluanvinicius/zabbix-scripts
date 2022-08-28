import requests
from datetime import datetime

http = requests.Session()

def get_dates():
    datesList=[]
    with http.get("https://www.bauruempregos.com.br/home/vagas") as req:
        for itensClass in req.text.split('div'):
            if "data-vagas" in itensClass:
                datesList.append(itensClass[20:][:10])

    return datesList



new_date=get_dates()

if new_date[0] == datetime.today().strftime('%d/%m/%Y'):
    print(0)
else:
    print(1)