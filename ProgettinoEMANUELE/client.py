import socket



host = '127.0.0.1'
port = 63222
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect((host, port))
string=""
while(True):
    data=sock.recv(4096)#problema con le receive, se troppo piccole sembrano intervallarsi in maniera strana i dati 
    if not data:
        break
    string+=data.decode()
string=string[0:len(string)-1]
list=string.split(";")
print(list)
dizionario={}
i=0
while i<len(list):
    dizionario[list[i]]=(list[i+1:i+4])
    i+=4
for key in dizionario:
    print("elementi della chiave:"+key)
    print(str(dizionario[key])+"\n")
exit()
