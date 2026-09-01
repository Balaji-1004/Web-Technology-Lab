# TechNova Solutions - Company Management System
## Exercise 7: Web Technology Lab

A complete company employee management system with role-based access control (Employee/Admin), built with PHP, MySQL, HTML5, CSS3, and Vanilla JavaScript.

---

## 📋 Features

✅ **User Authentication**
- Secure login system with email and password
- Password hashing using bcrypt (password_hash/password_verify)
- Session-based authentication

✅ **Role-Based Access Control**
- Employee role: View all administrators
- Admin role: View all employees
- Automatic redirect based on user role

✅ **Database Management**
- MySQL database with users table
- ENUM role field (employee/admin)
- Prepared statements for SQL injection prevention

✅ **User Registration**
- Self-service registration for employees and admins
- Email validation and uniqueness check
- Password confirmation and minimum length requirement
- Form validation on both client and server side

✅ **Dashboards**
- Role-specific dashboard displays
- Data tables showing users by role
- User profile display with logout option

✅ **Security Features**
- Password hashing with bcrypt
- HTML escaping with htmlspecialchars() to prevent XSS
- Prepared statements to prevent SQL injection
- Session-based authorization checks
- CSRF-safe form handling

✅ **Responsive Design**
- Mobile-friendly interface
- Hamburger menu for mobile navigation
- Responsive tables and layouts

---

## 📁 Project Structure

```
company-management/
├── index.php                    # Home/Landing page
├── register.php                 # User registration
├── login.php                    # Login form
├── logout.php                   # Logout handler
├── employee_dashboard.php       # Employee view (admins)
├── admin_dashboard.php          # Admin view (employees)
├── db.php                       # Database connection & utilities
├── style.css                    # Styling
├── script.js                    # Frontend JavaScript
└── database/
    └── company.sql              # Database schema and sample data
```

---

## 🔧 Installation & Setup

### Step 1: Install XAMPP
1. Download XAMPP from https://www.apachefriends.org/
2. Install XAMPP in the default location (C:\xampp or /Applications/XAMPP)
3. Launch XAMPP Control Panel

### Step 2: Start Services
1. Click **Start** next to **Apache** module
2. Click **Start** next to **MySQL** module
3. Wait for both services to show as running (green indicators)

### Step 3: Copy Project Files
1. Navigate to XAMPP htdocs directory:
   - **Windows**: `C:\xampp\htdocs\`
   - **Mac**: `/Applications/XAMPP/htdocs/`
   - **Linux**: `/opt/lampp/htdocs/`

2. Create a new folder: `company-management`
3. Copy all project files into this folder

```
C:\xampp\htdocs\company-management\
  ├── index.php
  ├── register.php
  ├── login.php
  ├── ...all other files...
  └── database/
      └── company.sql
```

### Step 4: Create Database
1. Open your browser and go to: **http://localhost/phpmyadmin**
2. Click **Databases** tab (top left)
3. Look for the "Create database" section
4. Enter database name: `company_db`
5. Click **Create**

### Step 5: Import Database Schema

**Method A: Using phpMyAdmin UI**
1. In phpMyAdmin, click on **company_db** database (left sidebar)
2. Click **Import** tab
3. Click **Choose File** button
4. Browse to `company-management/database/company.sql`
5. Click **Import** button
6. You should see success message

**Method B: Using phpMyAdmin SQL Query**
1. In phpMyAdmin, select **company_db**
2. Click **SQL** tab
3. Copy entire contents of `database/company.sql`
4. Paste into the SQL query editor
5. Click **Go** button

### Step 6: Verify Database
1. In phpMyAdmin, expand **company_db** in left sidebar
2. You should see a **users** table
3. Click on **users** table and select **Browse** tab
4. You should see 7 sample users (2 admins, 5 employees)

### Step 7 (OPTIONAL): Setup Demo Users
If the demo credentials don't work or you want to refresh the demo users:

1. Go to: **http://localhost/company-management/setup-demo-users.php**
2. Click the **Create Demo Users** button
3. The script will generate 7 demo users with valid bcrypt password hashes
4. The demo credentials will be displayed on the page

This script is useful if:
- The hardcoded SQL hashes don't work properly
- You want to refresh/reset the demo users
- You want to test user creation with valid passwords

---

## 🚀 Launch Application

1. Open your web browser
2. Go to: **http://localhost/company-management/**
3. You should see the TechNova Solutions home page

---

## 🧪 Testing Credentials

### Admin Accounts

**Admin 1:**
- Email: `admin1@technova.com`
- Password: `Admin@123`

**Admin 2:**
- Email: `admin2@technova.com`
- Password: `SecurePass@456`

### Employee Accounts

**Employee 1-5:**
- Emails: `emp1@technova.com`, `emp2@technova.com`, `emp3@technova.com`, `emp4@technova.com`, `emp5@technova.com`
- Password (all): `Employee@123`

---

## ✅ Testing Guide

### Test 1: Home Page
1. Navigate to http://localhost/company-management/
2. **Expected**: Professional landing page loads with company information
3. **Verify**: Navigation bar displays, Services/About/Contact sections visible

### Test 2: Registration
1. Click **Register** in navigation
2. Fill all fields:
   - Name: `Test User`
   - Email: `test@technova.com`
   - Password: `Test@123`
   - Phone: `9999999999`
   - Department: `Engineering`
   - Role: `Employee`
3. Click **Register**
4. **Expected**: Success message → Redirects to login after 2 seconds

### Test 3: Employee Login
1. Go to **Login** page
2. Enter: `emp1@technova.com` / `Employee@123`
3. Click **Login**
4. **Expected**: 
   - Redirects to employee_dashboard.php
   - Shows "Welcome" message with employee name
   - Displays table of all administrators (2 rows)

### Test 4: Admin Login
1. Go to **Login** page
2. Enter: `admin1@technova.com` / `Admin@123`
3. Click **Login**
4. **Expected**: 
   - Redirects to admin_dashboard.php
   - Shows "Welcome" message with admin name
   - Displays table of all employees (5+ rows including test user)

### Test 5: Invalid Login
1. Go to **Login** page
2. Enter wrong credentials: `test@test.com` / `wrongpassword`
3. Click **Login**
4. **Expected**: Error message displays, no redirect

### Test 6: Logout
1. While logged in as any user, click **Logout**
2. **Expected**: Session destroyed, redirects to login page
3. Verify: Can't access dashboard directly by typing URL

### Test 7: Authorization
1. Try accessing admin dashboard without login:
   - Type: `http://localhost/company-management/admin_dashboard.php`
2. **Expected**: Redirects to login page
3. Login as employee and try accessing admin_dashboard.php
4. **Expected**: Redirected to login (authorization denied)

### Test 8: SQL Injection Prevention
1. Go to **Login** page
2. In email field, enter: `' OR '1'='1' --`
3. In password field, enter: anything
4. Click **Login**
5. **Expected**: "Invalid email or password" error (injection blocked)

### Test 9: Password Visibility Toggle
1. Go to Login or Register page
2. Click **Show** button on password field
3. **Expected**: Password text becomes visible
4. Click **Hide**
5. **Expected**: Password is masked again

### Test 10: Form Validation
1. Go to **Register** page
2. Try submitting with empty fields
3. **Expected**: Browser prevents submission (HTML5 validation)
4. Enter invalid email: `notanemail`
5. **Expected**: Browser shows email validation error
6. Enter password: `123`, Confirm: `456`
7. Click Register
8. **Expected**: Error message "Passwords do not match"

### Test 11: Responsive Design
1. Open application on desktop browser
2. Right-click → **Inspect** (or F12)
3. Click device toggle (mobile icon)
4. Test on various screen sizes (iPhone, iPad, Desktop)
5. **Expected**: Layout adapts, hamburger menu appears on mobile

### Test 12: Database Security
1. Login and navigate to employee/admin dashboard
2. View page source (Right-click → View Page Source)
3. **Verify**: 
   - Passwords are NOT visible in HTML
   - Session data not exposed in client code
   - Email addresses are shown but properly escaped

---

## 🔐 Security Review

✅ **Password Security**
- Passwords are hashed using bcrypt (password_hash with PASSWORD_BCRYPT)
- Verification uses constant-time password_verify function
- Passwords never stored in plain text

✅ **SQL Injection Prevention**
- All database queries use prepared statements
- Parameters bound using bind_param()
- No string concatenation in SQL queries

✅ **XSS Prevention**
- All user input output is escaped with htmlspecialchars()
- UTF-8 encoding explicitly set
- No eval() or dynamic code execution

✅ **Session Security**
- Session started only once (checked with session_status)
- User ID, name, and role stored in session
- Session checked before accessing protected pages
- Session destroyed on logout

✅ **Authorization**
- Role validation on each protected page
- Users can only see data relevant to their role
- Employees cannot access admin dashboard
- Admins cannot be impersonated without login

---

## 📊 Database Schema

### users Table

| Column | Type | Details |
|--------|------|---------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT |
| name | VARCHAR(100) | Required |
| email | VARCHAR(120) | UNIQUE, Required |
| password | VARCHAR(255) | Hashed with bcrypt |
| role | ENUM | 'employee' or 'admin' |
| phone | VARCHAR(20) | Optional |
| department | VARCHAR(100) | Optional |
| created_at | TIMESTAMP | Auto-set to current time |

**Indexes:**
- Primary Key: id
- Unique: email
- Regular: role (for filtering)

---

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+ (MySQLi)
- **Database**: MySQL 5.7+ / MariaDB
- **Frontend**: HTML5, CSS3, Vanilla JavaScript (ES6+)
- **Security**: password_hash/password_verify, prepared statements
- **Server**: Apache (via XAMPP)

---

## 📝 Important Notes

### File Paths
- All files must be in: `C:\xampp\htdocs\company-management\`
- Database folder should be: `C:\xampp\htdocs\company-management\database\`
- Database file: `C:\xampp\htdocs\company-management\database\company.sql`

### Database Credentials
The application uses XAMPP default credentials:
- **Host**: localhost
- **User**: root
- **Password**: (empty/blank)
- **Database**: company_db

If you changed XAMPP credentials, edit `db.php` line 11-14:
```php
$db_host = "localhost";
$db_user = "root";        // Change this
$db_pass = "";            // Change this
$db_name = "company_db";
```

### Common Issues

**Issue: "Database Connection Failed"**
- Solution: Ensure MySQL is running in XAMPP Control Panel
- Check database credentials in db.php

**Issue: "Page not found" when accessing localhost/company-management/**
- Solution: Ensure folder is in C:\xampp\htdocs\company-management\
- Restart Apache in XAMPP

**Issue: "Table not found" error**
- Solution: Ensure database/company.sql was imported correctly
- Verify users table exists in phpMyAdmin

**Issue: Login fails with correct credentials**
- Solution: Verify password in database is hashed (should start with $2y$)
- Check PHP version supports password_verify()

---

## 🎯 Implementation Summary

This project demonstrates:
- ✅ User authentication and authorization
- ✅ Role-based access control (RBAC)
- ✅ Secure password handling
- ✅ SQL injection prevention
- ✅ XSS prevention
- ✅ Session management
- ✅ Database design
- ✅ Form validation (client & server)
- ✅ Responsive web design
- ✅ Professional UI/UX

Perfect for learning web development fundamentals and best practices!

---

## 📞 Support

For issues or questions:
1. Check the "Common Issues" section above
2. Review the HTML/PHP comments in source files
3. Verify XAMPP is running (Apache + MySQL green)
4. Check database exists with correct table structure
5. Test with provided demo credentials

---

**Created**: 2026
**Department**: Computer Science
**Lab**: Web Technology Lab - Exercise 07
