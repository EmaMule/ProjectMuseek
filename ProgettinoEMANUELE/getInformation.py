import requests
import ssl
import re
from urllib.request import urlopen
from bs4 import BeautifulSoup
context = ssl._create_unverified_context()
url = "https://www.tmz.com/hip-hop/" 
info=""
nomefile_link="ProvaLinkTMZ.txt"

page = urlopen(url,context=context)
html = page.read().decode("utf-8")
soup=BeautifulSoup(html,'html.parser')
links = set()
pattern="https://www.tmz.com/[0-9]{4}/(1[0-2]|0[1-9])/([0-9][0-9]|[0-9])/[\w|-]+"
for link in soup.findAll('a'):
    string=link.get('href')
    if string!=None and 'tmz' in string:
        m=re.search(pattern,string,re.IGNORECASE)
        if m!=None:
            links.add(m.group())
dict={}
for link in links:
    url=link
    page = urlopen(url,context=context)
    html = page.read().decode("utf-8")
    soup=BeautifulSoup(html,'html.parser')
    for title in soup.find_all('h1'):
        dict[str(title.contents[0])]=link
for keys in dict:
    print(keys+"\n"+dict[keys]+"\n")

""" fout=open(nomefile_link,"w",encoding="UTF-8")
print(info,end='',file=fout)
fout.close() """
