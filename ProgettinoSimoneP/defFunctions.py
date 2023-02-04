import mysql.connector
def collegamento():
    db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="password",
    database="progettino" #inizialmente no
    )
    return db
def aggiungiTupla(Titolo,Link,LinkFoto,Data):
    db=collegamento()
    cursor=db.cursor()
    sql="INSERT IGNORE INTO clienti(Titolo,Link,LinkFoto,Data) VALUES (%s,%s,%s,%s)"
    values=(Titolo,Link,LinkFoto,Data)
    cursor.execute(sql,values)
    db.commit()

def cascade():
    db=collegamento()
    cursor=db.cursor()
    sql="DELETE FROM clienti WHERE true"
    cursor.execute(sql)
    db.commit()

def mostraTuple():
    db=collegamento()
    cursor=db.cursor()
    sql="SELECT * FROM clienti"
    cursor.execute(sql)
    result=cursor.fetchall()
    for riga in result:
        print(riga)
def isLinkHere(link):
    db=collegamento()
    cursor=db.cursor()
    sql="SELECT Link FROM clienti WHERE Link = '"
    sql_used=sql+link+"'"
    cursor.execute(sql_used)
    result=cursor.fetchall()
    if result==[]:
        return False
    else:
        return True

def setupDB():
    db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="password"
    )
    cursor=db.cursor()
    sql="CREATE DATABASE progettino;"
    cursor.execute(sql)
    db.commit()

def setupTable():
    setupDB()
    db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="password",
    database="progettino"
    )
    cursor=db.cursor()
    sql="CREATE TABLE clienti(Titolo varchar(255),Link varchar(255) primary key,LinkFoto varchar(255), Data date);"
    cursor.execute(sql)
    db.commit()

