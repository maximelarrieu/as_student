#!/usr/bin/python3

from tkinter import *
from random import randint

game = Tk()
game.title('Pong - The Game') 

# Create canvas composants 
composants = Canvas(game, width=1000, height=600) 
composants_img = PhotoImage(file="./ressources/fond-noir.png")
composants.create_image(-420, -300, anchor=NW, image=composants_img)
composants.pack()

# Create the ball
ball = composants.create_oval(477, 277, 503, 303, fill='white')
ball_x = randint(-5, 5)
ball_y = randint(-5, 5)

# Rebonds
def ball_mouv():
    global ball_x, ball_y
    if composants.coords(ball)[3] > 600 or composants.coords(ball)[1] < 0:
        ball_y = -1 * ball_y
    if composants.coords(ball)[0] < 0 or composants.coords(ball)[2] > 1000:
        ball_x = -1 * ball_x
    composants.move(ball, ball_x, ball_y)
    game.after(12, mouvements)

ball_mouv()
game.mainloop()
