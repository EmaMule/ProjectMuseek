import kivy
from kivy.app import App
from kivy.uix.label import Label
from kivy.uix.gridlayout import GridLayout
from kivy.uix.button import Button
from kivy.uix.textinput import TextInput
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.image import Image
from kivy.uix.behaviors import ButtonBehavior
from kivy.uix.image import AsyncImage
import webbrowser  
class MyGridLayout(GridLayout):
    def __init__(self, **kwargs):
        super(MyGridLayout,self).__init__(**kwargs)
        #num columns
        self.cols=1
        top_grid=GridLayout()
        top_grid.cols=2
        top_grid.rows=1
        top_grid.add_widget(Label(text="Titolo"))
        self.add_widget(top_grid)
        #add widget
        ''' self.add_widget(Label(text="Name: "))
        #add input box
        self.name=TextInput(multiline=True)
        self.add_widget(self.name)

        self.add_widget(Label(text="Name1: "))
        #add input box
        self.pizza=TextInput(multiline=False)
        self.add_widget(self.pizza)

        #create a submit button
        self.submit=Button(text="Submit",size_hint_y=None,height=50)
        #bind the button
        self.submit.bind(on_press=self.press)
        self.add_widget(self.submit)

    def press(self,instance):
        name=self.name.text
        pizza=self.pizza.text
        self.add_widget(Label(text=f'Hello {name}, you like {pizza}'))'''

class ImageButton(ButtonBehavior,AsyncImage):
    def __init__(self, **kwargs):
        super(ImageButton, self).__init__(**kwargs)
    def on_press(self):
        webbrowser.open("https://www.tmz.com/2023/02/04/lil-pump-25k-teeth-veneers-dentist-miami-rapper-5-star-smiles/", new=0, autoraise=True) 

class MyLayout(BoxLayout):
    def __init__(self, **kwargs):
        super(MyLayout,self).__init__(**kwargs) 
        icon="https://imagez.tmz.com/image/ca/4by3/2023/02/02/ca12af3a3f0d4088b5f0e51460d0ac94_md.jpg"
        self.add_widget(ImageButton(source=icon))

class MyApp(App):
    def build(self):
        return MyLayout()

if __name__=='__main__':
    MyApp().run()
