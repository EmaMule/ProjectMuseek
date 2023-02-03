import mysql.connector

db=mysql.connector.connect(
    host="localhost",
    user="root",
    password="password",
    database="progettino" #inizialmente no
)

cursor=db.cursor()
#cursor.execute("CREATE DATABASE progettino")
#cursor.execute("SHOW DATABASES")
#cursor.execute("CREATE TABLE clienti(Titolo varchar(255),Link varchar(255) primary key,LinkFoto varchar(255))")
#cursor.execute("SHOW DATABASES")
#sql="INSERT INTO clienti(Titolo,Link,LinkFoto) VALUES (%s,%s,%s)"
#cursor.execute(sql,values)
#cursor.execute("ALTER TABLE clienti ADD COLUMN Data date;")
cursor.execute("ALTER TABLE clienti ORDER BY Data DESC;")
db.commit()


