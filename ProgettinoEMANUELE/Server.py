import socket
import threading
import time
import defFunctions
import getInformation
#VERSIONE COSTOSA DEL PROGRAMMA PORCODDIO STAMMERDA
wsem=threading.Semaphore(1)
y=threading.Semaphore(1)
readcount=0
def send_to_client(conn):
    global wsem,y,readcount
    while(True):
        page = 10
        index= int(str(conn.recv(4).decode()))
        db = defFunctions.collegamento()
        cursor=db.cursor()
        sql="SELECT * FROM clienti ORDER BY Data DESC" 
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
        print(index)
        for riga in result[index*page:(index+1)*page]:
            string="" 
            for i in riga:
                string+=str(i)+";"
            conn.send(string.encode())
        conn.send("\n".encode())
    #conn.close()
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
    
        
        
