#!/usr/bin/python3
from tkinter import *
from game import *

# Create principal window
window = Tk()
window.title('Pong - The Game') 

# [MENU] Create the canvas background
menu = Canvas(window, width=1000, height=600)
menu_img = PhotoImage(file="./ressources/fond-noir.png")
menu.create_image(0, 0, anchor=NW, image=menu_img)
menu.pack()

jouer = Button(window, text='Jouer', command=jeu)
jouer.pack()
quitter = Button(window, text='Quitter', command=window.destroy)
quitter.pack()

window.mainloop()
