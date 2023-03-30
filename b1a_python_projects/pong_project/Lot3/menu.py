#!/usr/bin/python3
from tkinter import *
from game import jeu
from param import options

# Create principal window
window = Tk()
window.title('Pong - Menu') 

# [MENU] Create the canvas background
menu = Canvas(window, width=1000, height=600)
menu_img = PhotoImage(file="./ressources/fond-noir.png")
menu.create_image(0, 0, anchor=NW, image=menu_img)
menu.pack()

jouer = Button(window, text='Play', command=jeu)
jouer.pack()
options = Button(window, text='Options', command=options)
options.pack()
quitter = Button(window, text='Quit', command=window.destroy)
quitter.pack()

window.mainloop()
