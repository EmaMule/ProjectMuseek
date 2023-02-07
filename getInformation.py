import requests
import defFunctions
import ssl
import re
import urllib.request
from urllib.request import urlopen
from bs4 import BeautifulSoup
def getInf():
    dict_best={}
    context = ssl._create_unverified_context()
    url = "https://www.tmz.com/hip-hop/" 
    page = urlopen(url,context=context)
    html = page.read().decode("utf-8")
    page.close()
    soup=BeautifulSoup(html,'html.parser')
    links = set()
    pattern="https://www.tmz.com/[0-9]{4}/([0-9][0-9])/([0-9][0-9])/[\w|-]+/$"
    for link in soup.findAll('a'):
        string=link.get('href')
        if string!=None and 'tmz' in string:
            m=re.search(pattern,string,re.IGNORECASE)
            if m!=None and not defFunctions.isLinkHere(m.group()):
                links.add(m.group()) 
    for link in links:
        url=link
        page = urlopen(url,context=context)
        html = page.read().decode("utf-8")
        page.close()
        soup=BeautifulSoup(html,'html.parser')
        title=str(soup.find_all('h1')[0].contents[0])
        regex='(https://imagez.tmz.com/image/[\w|-|/]+.((jpg)|(png)))'
        #soup=BeautifulSoup(html,'html.parser')
        findAll=soup.find_all('div',class_='img-wrapper')
        if (findAll==[]):
            dict_best[link]=(title,None)
        else:
            m=re.search(regex,str(findAll[0].contents[3]),re.IGNORECASE)
            if m!=None:
                #urllib.request.urlretrieve(m.group(), r""+keys+".jpg")
                dict_best[link]=(title,m.group())
    for keys in dict_best:
        reg ='([0-9]{4}/[0-9]{2}/[0-9]{2})'
        m=re.search(reg,keys,re.IGNORECASE)
        #print(dict_best[keys][0]+" "+keys,dict_best[keys][1]+" "+m.group())
        defFunctions.aggiungiTupla(dict_best[keys][0],keys,dict_best[keys][1],m.group())
    defFunctions.mostraTuple()
def downloadInf():
    dict_best={}
    links=set()
    context = ssl._create_unverified_context()
    for pagina in range(15):
        url = "https://www.tmz.com/hip-hop/?page="+str(pagina) 
        page = urlopen(url,context=context)
        html = page.read().decode("utf-8")
        page.close()
        soup=BeautifulSoup(html,'html.parser')
        pattern="https://www.tmz.com/[0-9]{4}/([0-9][0-9])/([0-9][0-9])/[\w|-]+/$"
        for link in soup.findAll('a'):
            string=link.get('href')
            if string!=None and 'tmz' in string:
                m=re.search(pattern,string,re.IGNORECASE)
                if m!=None:
                    links.add(m.group()) 
    for link in links:
        url=link
        page = urlopen(url,context=context)
        html = page.read().decode("utf-8")
        page.close()
        soup=BeautifulSoup(html,'html.parser')
        title=str(soup.find_all('h1')[0].contents[0])
        regex='(https://imagez.tmz.com/image/[\w|-|/]+.((jpg)|(png)))'
        #soup=BeautifulSoup(html,'html.parser')
        findAll=soup.find_all('div',class_='img-wrapper')
        if (findAll==[]):
            dict_best[link]=(title,None)
        else:
            m=re.search(regex,str(findAll[0].contents[3]),re.IGNORECASE)
            if m!=None:
                #urllib.request.urlretrieve(m.group(), r""+keys+".jpg")
                dict_best[link]=(title,m.group())
    for keys in dict_best:
        reg ='([0-9]{4}/[0-9]{2}/[0-9]{2})'
        m=re.search(reg,keys,re.IGNORECASE)
        #print(dict_best[keys][0]+" "+keys,dict_best[keys][1]+" "+m.group())
        defFunctions.aggiungiTupla(dict_best[keys][0],keys,dict_best[keys][1],m.group())
    defFunctions.mostraTuple()