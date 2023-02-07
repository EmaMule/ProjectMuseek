import socket
import kivy
import threading
from kivy import uix, app
from kivy.uix.label import Label
from kivy.app import App
import keyboard
import errno
import sys
import time
dizionario = {}


def printDizionario():
    for key in dizionario:
        print("elementi della chiave:"+key)
        print(str(dizionario[key])+"\n")


def importList(list):
    global dizionario
    dizionario.clear()
    i = 0
    while i < len(list):
        dizionario[list[i]] = (list[i+1:i+4])
        i += 4


def RefreshDB(index, sock):
    sock.send(str(index).encode())
    string = ""
    while (True):
        try:
            data = sock.recv(4096)
        except socket.error:
            if errno == errno.EAGAIN or errno == errno.EWOULDBLOCK:
                print('No data available')
                continue
            else:
                # a "real" error occurred
                print(errno)
                sys.exit(1)
        else:
            string += data.decode()  # da rivedere possibilmente
            if string[len(string)-1] == "\n":
                break
    string = string[0:len(string)-2]
    list = string.split(";")
    return list


def wrapper_RefreshDB(sock):
    var = 0
    list = []
    while True:
        if keyboard.is_pressed('ctrl+n'):
            print("#############################")
            var += 1
            list = RefreshDB(var, sock)
            importList(list)
            printDizionario()
            print("#############################")
            time.sleep(0.5)
        elif keyboard.is_pressed('ctrl+b'):
            print("#############################")
            var -= 1
            if var < 0:
                print("sei alla pagina 0, premere n (default: rimani alla pagina )")
                var = 0
            list = RefreshDB(var, sock)
            importList(list)
            printDizionario()
            print("#############################")
            time.sleep(0.5)
        elif keyboard.is_pressed('ctrl+r'):
            print("#############################")
            var = 0
            list = RefreshDB(var, sock)
            importList(list)
            printDizionario()
            print("#############################")
            time.sleep(0.5)


# Front-end
##########################################################################
"""
class MainApp(App):
    def build(self):
        #titolo =Label("Titolo", size_hint=(.5, .5),
            #pos_hint={'center_x': .5, 'center_y': .5})
        return 0
        #return titolo"""

#########################################################################

host = '127.0.0.1'
port = 63222
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect((host, port))
list = RefreshDB(0, sock)
importList(list)
printDizionario()
# deve partire su comando utente
threadRef = threading.Thread(target=wrapper_RefreshDB, args=(sock,))
threadRef.start()


exit()

##########################################################################

"""if __name__ == "__main__":
    MainApp().run()"""
