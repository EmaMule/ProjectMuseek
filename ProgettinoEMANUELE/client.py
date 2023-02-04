import socket



host = '127.0.0.1'
port = 63222
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect((host, port))
while(True):
    data = sock.recv(50000) #problema con le receive, se troppo piccole sembrano intervallarsi in maniera strana i dati 
    if not data:
        break
    list=data.decode().split(";")
    print(list[0],list[1],list[2],list[3])

