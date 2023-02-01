import requests
import ssl
import re
from urllib.request import urlopen
from bs4 import BeautifulSoup
context = ssl._create_unverified_context()
url = "https://www.tmz.com/2023/01/31/lil-wayne-welcome-to-tha-carter-vi-album-release-date"
info=""
nomefile="ProvaLinkTMZ.txt"

page = urlopen(url,context=context)
html = page.read().decode("utf-8")
soup=BeautifulSoup(html,'html.parser')
links = set()
for title in soup.find_all('h1'):
    print(title.contents)
