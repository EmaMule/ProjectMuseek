import requests
import ssl
import re
from urllib.request import urlopen
from bs4 import BeautifulSoup
context = ssl._create_unverified_context()
url = "https://www.tmz.com/hip-hop/" 
info=""
nomefile="ProvaLinkTMZ.txt"

page = urlopen(url,context=context)
html = page.read().decode("utf-8")
soup=BeautifulSoup(html,'html.parser')
links = []
pattern="https://www.tmz.com/[0-9]{4}/(1[0-2]|0[1-9])/([0-9][0-9]|[0-9])/[\w|-]+"
for link in soup.findAll('a'):
    string=link.get('href')
    if string!=None and 'tmz' in string:
        print(string)