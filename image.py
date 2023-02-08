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
import datetime

class ImageButton(ButtonBehavior,AsyncImage):
    def __init__(self,link, **kwargs):
        super(ImageButton, self).__init__(**kwargs)
        self.link_touse=link
        self.size=(500,500)
    def on_press(self):
        webbrowser.open(self.link_touse, new=0, autoraise=True)
class MyButton(Button):
    def __init__(self,text, link,**kwargs):
        super(MyButton, self).__init__(**kwargs)
        self.text=text
        self.height=10
        self.link_touse=link
    def on_press(self):
        webbrowser.open(self.link_touse, new=0, autoraise=True)
class Title(GridLayout):
        def __init__(self,text, link,**kwargs):
            super(Title, self).__init__(**kwargs)
            self.text=text
            self.link_touse=link
            self.cols=1
            self.add_widget(MyButton(text=self.text,link=self.link_touse))
class SiteData(GridLayout):
    def __init__(self,data,sito,link, **kwargs):
       super(SiteData, self).__init__(**kwargs)
       self.data=str(data)
       self.sito=sito
       self.link=link
       self.cols=2
       self.add_widget(MyButton(text=self.data,link=self.link))
       self.add_widget(MyButton(text=self.sito,link=self.link))
       
class News(BoxLayout):
    def __init__(self,link,image,data,title,sito, **kwargs):
        super(News,self).__init__(**kwargs)
        self.orientation='vertical'
        self.image=image
        self.link=link
        self.title=title
        self.data=data
        self.sito=sito
        self.cols=1
        image=ImageButton(source=image,link=self.link)
        image.size=(500,500) #non funziona porcodio
        self.add_widget(image)
        self.add_widget(Title(text=self.title,link=self.link))
        self.add_widget(SiteData(data=self.data,sito=self.sito,link=self.link))

class MyLayout(GridLayout):
    def __init__(self, **kwargs):
        super(MyLayout,self).__init__(**kwargs)
        self.cols=1
        self.add_widget(News(image="https://imagez.tmz.com/image/eb/4by3/2023/02/03/ebf5e037b83f42ecada0bf25a5bde8a5_md.jpg",
                            title="Beyoncé Fans Use GoFundMe to Raise Money for 'Renaissance' Tour Tickets",
                            sito="TMZ",data=datetime.date(2023, 2, 4),
                            link="https://www.tmz.com/2023/02/04/beyonce-renaissance-tour-gofundme-tickets-sale-raise-funds-beyhive/")) 

class MyApp(App):
    def build(self):
        return MyLayout()

if __name__=='__main__':
    MyApp().run()
