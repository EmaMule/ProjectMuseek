import socket
import threading
import time
import defFunctions
import getInformation

wsem=threading.Semaphore(1)
y=threading.Semaphore(1)
readcount=0
def send_to_client(conn):
    global wsem,y,readcount
    db = defFunctions.collegamento()
    cursor=db.cursor()
    sql="SELECT * FROM clienti"
    y.acquire()
    readcount+=1
    if readcount==1:
        wsem.acquire()
    y.release()
    cursor.execute(sql)
    result=cursor.fetchall()
    y.acquire()
    readcount-=1
    if readcount==0:
        wsem.release()
    y.release()
    separator = ";"
    for riga in result:
        conn.send(riga[0].encode())
        conn.send(separator.encode())
        conn.send(riga[1].encode())
        conn.send(separator.encode())
        conn.send(riga[2].encode())
        conn.send(separator.encode())
        conn.send(str(riga[3]).encode())
        conn.send(separator.encode())
    conn.close()
def informationWrapper():
    global wsem
    while(True):
        wsem.acquire()
        print("Sto aggiornando")
        getInformation.getInf()
        wsem.release()
        print("Ho finito di aggiornare")
        time.sleep(3600)

thread_inf=threading.Thread(target=informationWrapper)
thread_inf.start()
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
    
        
        