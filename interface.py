import kivy
from kivy.app import App
from kivy.uix.label import Label
from kivy.uix.gridlayout import GridLayout
from kivy.uix.button import Button
from kivy.uix.textinput import TextInput

class MyGridLayout(GridLayout):
    def __init__(self, **kwargs):
        super(MyGridLayout,self).__init__(**kwargs)
        #num columns
        self.cols=2
        
        #add widget
        self.add_widget(Label(text="Name: "))
        #add input box
        self.name=TextInput(multiline=False)
        self.add_widget(self.name)

        self.add_widget(Label(text="Name1: "))
        #add input box
        self.pizza=TextInput(multiline=False)
        self.add_widget(self.pizza)

class MyApp(App):
    def build(self):
        return MyGridLayout()

if __name__=='__main__':
    MyApp().run()
