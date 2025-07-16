import tkinter as tk
from tkinter import messagebox
from PIL import Image, ImageTk

# Simulated user database
users = {
    "admin": "admin123"
}

# ---------- Core Functions ----------
def login():
    username = username_entry.get()
    password = password_entry.get()
    if username in users and users[username] == password:
        messagebox.showinfo("Login Successful", f"Welcome back, {username}!")
        open_home_page()
    else:
        messagebox.showerror("Login Failed", "Invalid username or password.")

def register():
    new_user = username_entry.get()
    new_pass = password_entry.get()
    if new_user and new_pass:
        if new_user in users:
            messagebox.showwarning("Already Exists", "This username is already registered.")
        else:
            users[new_user] = new_pass
            messagebox.showinfo("Registered", "Account created successfully!")
    else:
        messagebox.showwarning("Missing Info", "Please enter both username and password.")

def open_home_page():
    for widget in window.winfo_children():
        widget.destroy()

    tk.Label(window, text="Welcome to the Student Portal", font=("Segoe UI", 18, "bold"), fg="#2b6777").pack(pady=20)
    tk.Label(window, text="Share your posts and pictures below!", font=("Segoe UI", 12)).pack(pady=10)

    post_frame = tk.Frame(window, bg="#eeeeee", width=450, height=200, highlightbackground="gray", highlightthickness=1)
    post_frame.pack(pady=20)
    tk.Label(post_frame, text="(Post box coming soon)", font=("Segoe UI", 12), bg="#eeeeee").pack(pady=70)

# ---------- GUI Setup ----------
window = tk.Tk()
window.title("Student Login Portal")
window.geometry("500x620")
window.configure(bg="white")

# ---------- Optional: Banner Image ----------
image_path = "lycee_1752377420026.jbg"  # Change to your uploaded image filename

try:
    img = Image.open(image_path)
    img = img.resize((480, 250))
    photo = ImageTk.PhotoImage(img)
    img_label = tk.Label(window, image=photo, bg="white")
    img_label.image = photo
    img_label.pack(pady=10)
except:
    tk.Label(window, text="(Image not found)", font=("Segoe UI", 10), fg="red", bg="white").pack()

# ---------- Login Fields ----------
tk.Label(window, text="Username", font=("Segoe UI", 12), bg="white").pack()
username_entry = tk.Entry(window, font=("Segoe UI", 12), width=30)
username_entry.pack(pady=5)

tk.Label(window, text="Password", font=("Segoe UI", 12), bg="white").pack()
password_entry = tk.Entry(window, show="*", font=("Segoe UI", 12), width=30)
password_entry.pack(pady=5)

# ---------- Buttons ----------
tk.Button(window, text="Login", font=("Segoe UI", 12), bg="#2b6777", fg="white", width=20, command=login).pack(pady=10)
tk.Button(window, text="Register New Account", font=("Segoe UI", 11), bg="white", fg="#2b6777", bd=1, relief="solid", width=20, command=register).pack()

window.mainloop()