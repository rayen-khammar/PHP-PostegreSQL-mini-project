# 🎓 Students Management System

A web-based student management system built with PHP and PostgreSQL, featuring role-based access control, DataTables integration, and full CRUD operations.

## 📋 Features

- **Authentication** — Login system with session management
- **Role-based access** — Admin and normal user roles
  - Admin: can add, edit, and delete students
  - Normal user: can only view
- **Students management** — View, add, edit, delete students with photo upload
- **Sections management** — View all sections and filter students by section
- **DataTables** — Search, pagination, sorting, and export to Copy/Excel/CSV/PDF

## 🛠️ Tech Stack

- **Backend** — PHP 8
- **Database** — PostgreSQL
- **Frontend** — Bootstrap 5, DataTables, Bootstrap Icons
- **Architecture** — Repository pattern with OOP

## 📁 Project Structure
```
├── classes/
│   ├── IRepository.php        # Repository interface
│   ├── Repository.php         # Abstract base repository
│   ├── StudentsRepository.php # Students CRUD operations
│   ├── SectionsRepository.php # Sections CRUD operations
│   └── ConnexionBD.php        # Database connection (singleton)
├── img/                       # Student photos
├── index.php                  # Login page
├── home.php                   # Home page
├── students.php               # Students list page
├── sections.php               # Sections list page
├── studentsAction.php         # Handles add/edit/delete for students
├── navbar.php                 # Shared navbar component
├── logout.php                 # Session destroy
├── autoload.php               # Class autoloader
└── sql.sql                    # Database schema and seed data
```

## ⚙️ Installation

### 1. Clone the repository
```bash
git clone https://github.com/rayen-khammar/PHP-PostegreSQL-mini-project.git
cd PHP-PostegreSQL-mini-project
```

### 2. Install Bootstrap via npm
```bash
npm install
```

### 3. Set up the database
- Create a PostgreSQL database
- Run the SQL file:
```bash
psql -U your_user -d your_database -f sql.sql
```

### 4. Configure the database connection
Edit `classes/ConnexionBD.php` and update your credentials:
```php
$host = 'localhost';
$db   = 'your_database';
$user = 'your_user';
$pass = 'your_password';
```

### 5. Run the project
Use a local PHP server:
```bash
php -S localhost:8000
```
Then open `http://localhost:8000/index.php`

## 🔐 Default Login

| Username | Password | Role  |
|----------|----------|-------|
| admin    | admin    | admin |
| user     | user     | user  |

> Make sure these users exist in your `users` table.

## 📸 Screenshots

> Coming soon

## 📄 License

This project is for educational purposes.
