# sdk-v2
sdk-v2


import requests
import hashlib
url = 'https://api.fondy.eu/api/reports/request/'
params = {'merchant_id': '1396424', 'date_from': '15.04.2018 12:00:00', 'date_to': '15.04.2018 14:00:00'}
data = []
data.extend([unicode(params[key]) for key in sorted(params.iterkeys())
                 if params[key] != '' and not params[key] is None])
params['signature'] = hashlib.sha1('test|' + '|'.join(data).encode('utf-8')).hexdigest()    
res = requests.post(url, json={'request':params})    
print res.text