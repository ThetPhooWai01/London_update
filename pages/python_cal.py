import tkinter as tk
import re

window = tk.Tk()
window.geometry("400x500")

display_var = tk.StringVar()

display = tk.Entry(window,width=20,font=("Helvetica", 30),textvariable=display_var)
display.grid(row=0,column=0,columnspan=4)

button_frame = tk.Frame(window)
button_frame.grid(row=1,column=0)

def one():
    display.insert(tk.INSERT, "1")

def two():
    display.insert(tk.INSERT, "2")

def plus():
    display.insert(tk.INSERT, "+")

def minus():
    display.insert(tk.INSERT, "-")

def equal():
    display_data = display_var.get()
    # numbers = [int(i) for i in re.findall(r'\d+', display_data)]
    # result = sum(numbers)
    result = eval(display_data)
    display_var.set(result)


button_1 = tk.Button(button_frame,width=10,height=4,text='1',font=("Helvetica", 10),bg='gray40',command=one)
button_1.grid(row=0,column=0)


button_2 = tk.Button(button_frame,width=10,height=4,text='2',font=("Helvetica", 10),bg='gray40',command=two)
button_2.grid(row=0,column=1)

button_3 = tk.Button(button_frame,width=10,height=4,text='3',font=("Helvetica", 10),bg='gray40')
button_3.grid(row=0,column=2)

button_4 = tk.Button(button_frame,width=10,height=4,text='4',font=("Helvetica", 10),bg='gray40')
button_4.grid(row=0,column=3)

button_5 = tk.Button(button_frame,width=10,height=4,text='5',font=("Helvetica", 10),bg='gray40')
button_5.grid(row=1,column=0)

button_6 = tk.Button(button_frame,width=10,height=4,text='6',font=("Helvetica", 10),bg='gray40')
button_6.grid(row=1,column=1)

button_7 = tk.Button(button_frame,width=10,height=4,text='7',font=("Helvetica", 10),bg='gray40')
button_7.grid(row=1,column=2)

button_8 = tk.Button(button_frame,width=10,height=4,text='8',font=("Helvetica", 10),bg='gray40')
button_8.grid(row=1,column=3)

button_9 = tk.Button(button_frame,width=10,height=4,text='9',font=("Helvetica", 10),bg='gray40')
button_9.grid(row=2,column=0)

button_0 = tk.Button(button_frame,width=10,height=4,text='0',font=("Helvetica", 10),bg='gray40')
button_0.grid(row=2,column=1)

button_0 = tk.Button(button_frame,width=10,height=4,text='00',font=("Helvetica", 10),bg='gray40')
button_0.grid(row=2,column=2)

button_0 = tk.Button(button_frame,width=10,height=4,text='000',font=("Helvetica", 10),bg='gray40')
button_0.grid(row=2,column=3)

button_plus = tk.Button(button_frame,width=10,height=4,text='+',font=("Helvetica", 10),bg='gray40',command=plus)
button_plus.grid(row=3,column=0)

button_minus = tk.Button(button_frame,width=10,height=4,text='-',font=("Helvetica", 10),bg='gray40',command=minus)
button_minus.grid(row=3,column=1)

button_multiple = tk.Button(button_frame,width=10,height=4,text='x',font=("Helvetica", 10),bg='gray40')
button_multiple.grid(row=3,column=2)

button_divison = tk.Button(button_frame,width=10,height=4,text='/',font=("Helvetica", 10),bg='gray40')
button_divison.grid(row=3,column=3)

button_equal = tk.Button(button_frame,width=45,height=4,text='=',font=("Helvetica", 10),bg='gray40',command=equal)
button_equal.grid(row=4,column=0,columnspan=4)




window.mainloop()

