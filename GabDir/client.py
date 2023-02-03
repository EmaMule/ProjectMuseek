import socket



host = '127.0.0.1'
port = 63222
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect((host, port))
while(True):
    data = sock.recv(1024)
    if not data:
        break
    print(data.decode())
    print("\n")

