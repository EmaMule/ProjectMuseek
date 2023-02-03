import socket
import threading
import time
import defFunctions

def send_to_client(conn):
    db = defFunctions.collegamento()
    cursor=db.cursor()
    sql="SELECT * FROM clienti"
    cursor.execute(sql)
    result=cursor.fetchall()
    nibbio = ";"
    for riga in result:
        time.sleep(2)
        conn.send(riga[0].encode())
        conn.send(nibbio.encode())
        conn.send(riga[1].encode())
        conn.send(nibbio.encode())
        conn.send(riga[2].encode())
        conn.send(nibbio.encode())
    conn.close()
  
    


port = 63222
host = '127.0.0.1'

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.bind((host,port))
sock.listen(5)
print("socket is listening")
while(True):
    conn, addr = sock.accept()
    print(conn)
    x=threading.Thread(target=send_to_client,args=(conn,))
    x.start()
    
        
        