import kivy
from kivy.app import App
from kivy.uix.label import Label
from kivy.uix.gridlayout import GridLayout
from kivy.uix.button import Button
from kivy.uix.textinput import TextInput
from kivy.uix.anchorlayout import AnchorLayout
import kivy.properties
import kivy.utils
from kivy.core.window import Window
class MyLayout(AnchorLayout):
    def __init__(self, **kwargs):
        super(MyLayout,self).__init__(**kwargs)
        #num columns
        Window.clearcolor = (1,1,1,1)
        self.cols = 1
        self.rows = 2
        alayout = AnchorLayout(anchor_x="right",anchor_y="bottom")
        self.add_widget(alayout)
        
        ####TOP

        Titolo = Label(text="Titolo",color=(0.2,0.2,1,1))
        alayout.add_widget(Titolo)

        RefreshB = Button(text="Refresh",color=(0.2,0.2,1,1), background_color=(0.2,0.5,1,1))
        alayout.add_widget(RefreshB)
     
        alayout.add_widget(Label(text="Profdsif",color=(0.2,0.44,0.99,1)))
        alayout.add_widget(Label(text="porcopi",color=(1,0.4,0.4,1)))

        
       


class MyApp(App):
    def build(self):
        return MyLayout()

if __name__=='__main__':
    MyApp().run()
