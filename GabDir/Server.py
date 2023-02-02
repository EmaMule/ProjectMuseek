import socket
import defFunctions
def send_to_client(conn):
    db = defFunctions.collegamento()
    cursor=db.cursor()
    sql="SELECT * FROM clienti"
    cursor.execute(sql)
    result=cursor.fetchall()
    nibbio = ";"
    for riga in result:
        conn.send(riga[0].encode())
        conn.send(nibbio.encode())
        conn.send(riga[1].encode())
        conn.send(nibbio.encode())
        conn.send(riga[2].encode())
        conn.send(nibbio.encode())
   
    


port = 63222
host = '127.0.0.1'

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.bind((host,port))
sock.listen()
while(True):
    conn, addr = sock.accept()
    #while True:
        #data = conn.recv(1024)
        #if not data:
        #    break
    send_to_client(conn)
        
        