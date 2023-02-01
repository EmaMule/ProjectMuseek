import requests
import ssl
import re
from urllib.request import urlopen
from bs4 import BeautifulSoup
import urllib.request
context = ssl._create_unverified_context()
url = "https://www.tmz.com/2023/01/31/lil-wayne-welcome-to-tha-carter-vi-album-release-date"
info=""
nomefile="ProvaLinkTMZ.txt"

page = urlopen(url,context=context)
html = page.read().decode("utf-8")
soup=BeautifulSoup(html,'html.parser')
links = set()
regex='https://imagez.tmz.com/image/[\w|-|/]+.jpg'
for title in soup.find_all('div',class_='img-wrapper'):
    m=re.search(regex,str(title.contents[3]),re.IGNORECASE)
    if m!=None:
        urllib.request.urlretrieve(m.group(), r"C:\Users\emimu\OneDrive\Desktop\thaCarter.jpg")

