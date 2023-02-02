import mysql.connector

db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="password",
    database="progettino" #inizialmente no
)

cursor=db.cursor()
#cursor.execute("CREATE DATABASE progettino") solo una volta
#cursor.execute("SHOW DATABASES")
#cursor.execute("CREATE TABLE clienti(Titolo varchar(255),Link varchar(255) primary key,LinkFoto varchar(255))")
cursor.execute("SHOW TABLES")
sql="INSERT INTO clienti(Titolo,Link,LinkFoto) VALUES (%s,%s,%s)"
values=
cursor.execute(sql,values)
db.commit()
for x in cursor:
    print(x)
