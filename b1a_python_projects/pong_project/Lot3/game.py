#!/usr/bin/python3

from tkinter import *
from random import randint
#from menu import menutest

ball_x = randint(1, 5)
ball_y = randint(1 ,5)


def jeu():
    game = Toplevel()
    game.title('Pong - The Game') 
    
    # Create canvas composants 
    composants = Canvas(game, width=1000, height=600) 
    composants_img = PhotoImage(file="./ressources/fond-noir.png")
    composants.create_image(-420, -300, anchor=NW, image=composants_img)
    composants.create_line(500, 0, 500, 600, fill='white', dash=(7, 7, 7, 7))
    composants.pack()

    # Create players and the ball
    player_one=composants.create_rectangle(20, 230, 40, 380, fill='white')
    player_two=composants.create_rectangle(960, 230, 980, 380, fill='white')
    ball = composants.create_oval(477, 277, 503, 303, fill='white')

    # Rebonds
    def mouvements():
        global ball_x, ball_y
        if composants.coords(ball)[3] > 600 or composants.coords(ball)[1] < 0:
            ball_y = -1 * ball_y
        if composants.coords(ball)[0] < 0 or composants.coords(ball)[2] > 1000:
            ball_x = -1 * ball_x
            game.stop = True
        if composants.coords(ball)[0] < composants.coords(player_one)[2] and composants.coords(ball)[1] < composants.coords(player_one)[3] and composants.coords(ball)[3] > composants.coords(player_one)[1]:
            ball_x = -1 * ball_x
        if composants.coords(ball)[2] > composants.coords(player_two)[0] and composants.coords(ball)[1] < composants.coords(player_two)[3] and composants.coords(ball)[3] > composants.coords(player_two)[1]:
            ball_x = -1 * ball_x
        composants.move(ball, ball_x, ball_y)
        game.after(12, mouvements)

        
        def up_pone(event):
            composants.move(player_one, 0, -20)
        def down_pone(event):
            composants.move(player_one, 0, 20)
        def up_ptwo(event):
            composants.move(player_two, 0, -20)
        def down_ptwo(event):
            composants.move(player_two, 0, 20)

        
        composants.bind_all('z', up_pone)
        composants.bind_all('s', down_pone)
        composants.bind_all('<Up>', up_ptwo)
        composants.bind_all('<Down>', down_ptwo)
            
    mouvements()
    game.mainloop()
