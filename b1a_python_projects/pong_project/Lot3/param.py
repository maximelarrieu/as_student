#!/usr/bin/python3
from tkinter import *

def options():
    window = Toplevel()
    window.title('Pong - Options')

    frame1 = Frame(window, borderwidth=2, relief=GROOVE)
    frame1.pack(side=LEFT, padx=10, pady=2)
    frame2 = Frame(window, borderwidth=2, relief=GROOVE)
    frame2.pack(side=BOTTOM, padx=10, pady=50)
    
    Label(frame1, text="Winning Points").pack(side=LEFT, padx=10, pady=4)
    win_pts = Spinbox(frame1, from_=1, to=10, width=10)
    win_pts.pack(side=LEFT, pady=15)
    Label(frame2, text="Ball Speed").pack(padx=10, pady=4)
    ball_speed = Spinbox(frame2, from_=2, to=5, increment=0.5, width=10)
    ball_speed.pack(pady=30)

    window.mainloop()
