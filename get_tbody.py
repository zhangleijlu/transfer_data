import urllib
import urllib2
import pyquery
import sys
import MySQLdb

enable_proxy = True
proxy_handler = urllib2.ProxyHandler({"http" : '68.57.167.6:65309'})
null_proxy_handler = urllib2.ProxyHandler({})
if enable_proxy:
    opener = urllib2.build_opener(proxy_handler)
else:
    opener = urllib2.build_opener(null_proxy_handler)
urllib2.install_opener(opener)
url = "https://www.us-proxy.org/"
user_agent = 'Mozilla/4.0 (compatible; MSIE 7.5; Windows NT)'
headers = { 'User-Agent' : user_agent }
request = urllib2.Request(url, headers=headers)
response = urllib2.urlopen(request)
page = response.read()
from pyquery import PyQuery as pq
doc = pq(page)
tr_list = str(doc("tbody")).split("</tr>")
for tr in tr_list:
    td_list = tr.split("</td>")
    i=0
    for td in td_list:
        if i==0:
            IP = td.split("</td>")[1]
        if i==1:
            PORT = td.split("</td>")[1]

    print td_list
    sys.exit()
