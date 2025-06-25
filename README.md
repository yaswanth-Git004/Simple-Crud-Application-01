
# Simple PHP CRUD Application

A blog-style CRUD (Create, Read, Update, Delete) web application built using **PHP**, **MySQL**, and **HTML/CSS**, featuring **role-based authentication**, an **admin panel**, and secure session management.



## ✨ Features

- ✅ User Registration & Login
- ✅ Role-Based Access (Admin / Editor / User)
- ✅ Create / Edit / Delete Posts
- ✅ View All Posts or Own Posts
- ✅ Search & Pagination
- ✅ Admin Dashboard (User & Post Management)
- ✅ Client-side & Server-side Validation


## 🚀 Getting Started


## 🛠 Tech Stack

- **Frontend:** HTML, CSS

- **Backend:** PHP 8.0.30

- **Database:** MySQL

- **Local Server:** XAMPP

## 🗄️ Database Schema
**Database Name :- blog**

**Table :- users**
| Column     | Type          | Constraints                 | Description            |
|------------|---------------|-----------------------------|------------------------|
| id         | INT(10)       | PRIMARY KEY, AUTO_INCREMENT | Unique user ID         |
| username   | VARCHAR(30)   | UNIQUE, NOT NULL            | User's username        |
| password   | VARCHAR(255)  | NOT NULL                    | Hashed password        |
| role   |VARCHAR(20)  | NOT NULL DEFAULT 'user'                  | Role (admin/editor/user)    |

**Table :- posts**
| Column     | Type          | Constraints                 | Description            |
|------------|---------------|-----------------------------|------------------------|
| id         | INT(10)       | PRIMARY KEY, AUTO_INCREMENT | Unique post ID         |
| title      | VARCHAR(100)  | NOT NULL                    | Post title             |
| content    | VARCHAR(500)  | NOT NULL                    | Post content           |
| created_at | DATETIME      | DEFAULT CURRENT_TIMESTAMP   | Post creation time     |
| user_id	 | INT(10)      | FOREIGN KEY (users.id)   | ID of the post creator|



## 👤Role-Based Access Matrix
|Role	  	| Admin Dashboard   	| Manage Users 	| Manage All Posts	|Own Posts Only	|View Others' Posts|
|---------------|-----------------------|---------------|-----------------------|---------------|------------------|
|Admin		|✅			|✅	   	|✅			|✅		|✅		   |
|Editor		|✅			|❌		|✅			|✅		|✅		   |
|User		|❌			|❌		|❌			|✅		|✅		   |

## 🔐 Security Highlights

- ✅ Password hashing with password_hash() and verification using password_verify()
- ✅ Session-based login & logout
- ✅ Input validation (client + server)
- ✅ Prepared statements (PDO) to prevent SQL injection
- ✅ Role checks for page access
- ✅ Length-limited input:
    - Username: max 20 chars
    - Password: max 12 chars

## 📂 Folder Structure
```
CRUD_Application/
│
├── backend/
│   ├── dbConnection.php
│   ├── blog.sql
│   ├── logout.php
│   ├── errorHandler.php
│   └── utilities.php
│
├── dashboard/
│   ├── adminPanel.php
│   ├── admin_nav.php
│   ├── profile-management.php
│   ├── user-management.php
│   └── userform.php
│
├── styles/
│   └── style.css
│
├── assets/
│   └── images/
│
├── createPost.php
├── delete.php
├── edit.php
├── index.php
├── login.php
├── register.php
├── nav.php
├── search.php
├── pagination.php
├── myPosts.php
├── README.md
└── SECURITY.md

```

## 📥 Installation


1. **Clone the repo**
   ```
   git clone https://gh repo clone yaswanth-Git004/Simple-Crud-Application-01
     ```

2. **download and Start your local server** (e.g., using XAMPP or WAMP)
In my case i'm using xampp here is the link for xampp
https://www.apachefriends.org/download.html

- Open XAMPP or WAMP

- Start Apache and MySQL

3. **Import the Database**

- Open http://localhost/phpmyadmin

- Create a database named blog

- Import the SQL file from:
    ```bash
    /backend/blog.sql
    ```
4. **Set Up the Database Connection**
```php
$dsn = 'mysql:host=localhost;dbname=blog';
$user = 'root'; // your MySQL username
$pass = '';
```

5. **Run the Application**
```
http://localhost/CRUD_Application/index.php
```
    
