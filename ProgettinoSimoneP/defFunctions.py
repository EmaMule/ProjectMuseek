import mysql.connector
def collegamento():
    db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="password",
    database="progettino" #inizialmente no
    )
    return db
def aggiungiTupla(Titolo,Link,LinkFoto):
    db=collegamento()
    cursor=db.cursor()
    sql="INSERT INTO clienti(Titolo,Link,LinkFoto) VALUES (%s,%s,%s)"
    values=(Titolo,Link,LinkFoto)
    cursor.execute(sql,values)
    db.commit()
def mostraTuple():
    db=collegamento()
    cursor=db.cursor()
    sql="SELECT * FROM clienti"
    cursor.execute(sql)
    result=cursor.fetchall()
    for riga in result:
        print(riga)
