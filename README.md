# 🗂️ Task Manager App (AngularJS + PHP + MySQL)

A simple full-stack CRUD application built using **AngularJS (1.x)** for frontend, **PHP + MySQL (XAMPP)** for backend, and REST API integration.  
This app allows users to **add, view, edit, delete, and search users** based on their details.

---

## 🚀 Features

✅ Add new users  
✅ View all users  
✅ Edit existing users  
✅ Delete users  
✅ Search users by name or phone number  
✅ Responsive UI using AngularJS  
✅ RESTful PHP backend with MySQL database  

---

## 🏗️ Tech Stack

| Layer | Technology |
|--------|-------------|
| Frontend | AngularJS 1.x |
| Backend | PHP 8 (XAMPP) |
| Database | MySQL |
| Server | Apache (from XAMPP) |

---

## 📁 Folder Structure

taskmanager/
│
├── api/ # Backend PHP files (API)
│ ├── config.php # Database connection + CORS setup
│ ├── create.php # Create user API
│ ├── read.php # Get all users API
│ ├── read_one.php # Get single user by ID
│ ├── update.php # Update user data
│ ├── delete.php # Delete user by ID
│ └── search.php # Search users by name or phone
│
└── frontend/ # AngularJS frontend files
├── index.html # Main app entry point
├── app.js # AngularJS app & routing setup
├── services/
│ └── apiService.js # Handles all API calls
├── controllers/
│ └── mainController.js # Main controller logic
└── templates/
├── form.html # Add/Edit user form
└── list.html # User list + search page

yaml
Copy code

---

## ⚙️ Setup Instructions

### 🧩 Step 1 — Install XAMPP
- Download and install from [https://www.apachefriends.org](https://www.apachefriends.org)
- Start **Apache** and **MySQL** from the XAMPP Control Panel

### 🧩 Step 2 — Setup Project Folder
Copy the entire `taskmanager` folder into:
C:\xampp\htdocs\

yaml
Copy code

You should now have:
C:\xampp\htdocs\taskmanager\

yaml
Copy code

---

### 🧩 Step 3 — Create Database

1. Open [phpMyAdmin](http://localhost/phpmyadmin)
2. Create a new database named:
task_manager

sql
Copy code
3. Run this SQL command in the SQL tab:
```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
🧩 Step 4 — Verify Backend
Visit each backend API file from browser to ensure it works:

API	URL
Check connection	http://localhost/taskmanager/api/config.php
Get all users	http://localhost/taskmanager/api/read.php
Search user	http://localhost/taskmanager/api/search.php?query=test

✅ If you see JSON data or “Connected OK”, backend is running fine.

🧩 Step 5 — Run Frontend
Open this in browser:

ruby
Copy code
http://localhost/taskmanager/frontend/index.html
You’ll see options to Add User or View Users.

Use the form to add, edit, delete, or search users.

🧠 How It Works
Backend Flow (PHP)
config.php: creates DB connection ($conn) and allows cross-origin (CORS)

create.php: inserts user data into MySQL

read.php: returns all user records as JSON

read_one.php: returns single user by ID

update.php: updates user by ID

delete.php: deletes user by ID

search.php: finds user by name or phone using LIKE query

Frontend Flow (AngularJS)
apiService.js: handles all HTTP requests to PHP APIs

mainController.js: controls Add/Edit/List logic using $scope

form.html: binds form input to user object and sends data

list.html: displays user list with edit/delete/search buttons
