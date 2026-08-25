# Employee Management System (PHP + MySQL)

A simple lab exercise: an HTML/PHP form that collects employee details and stores them in a MySQL database, plus a page to view all saved records.

## Files

| File | Purpose |
|---|---|
| `database.sql` | Creates the `employee_db` database and `employees` table |
| `db_connect.php` | MySQL connection settings |
| `index.php` | The employee entry form |
| `submit.php` | Handles the form submission and inserts into the database |
| `view_employees.php` | Displays all stored employee records |
| `style.css` | Styling shared by both pages |

## 1. Run it locally with XAMPP

1. Install [XAMPP](https://www.apachefriends.org/) if you don't already have it.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Copy the whole `employee-management` folder into your XAMPP `htdocs` directory, e.g.:
   - Windows: `C:\xampp\htdocs\employee-management`
   - Mac: `/Applications/XAMPP/htdocs/employee-management`
4. Open **phpMyAdmin** ([http://localhost/phpmyadmin](http://localhost/phpmyadmin)), click **Import**, and run `database.sql` (this creates the database and table for you).
5. Open the app in your browser: [http://localhost/employee-management/index.php](http://localhost/employee-management/index.php)
6. Fill the form and submit — you'll be redirected back with a success message. Click **View All Records** to see the saved data straight from the `employees` table.

If your MySQL has a username/password other than the XAMPP default (`root` / empty password), update `db_connect.php`.

## 2. Push the project to GitHub

GitHub Pages can only serve static files — it **cannot run PHP or MySQL**. So for a PHP + MySQL project, GitHub is used to **store and showcase your source code**, while you actually run the app locally (via XAMPP) or on a PHP-capable server for a live demo.

Steps to push to GitHub:

```bash
cd employee-management
git init
git add .
git commit -m "Employee Management System - PHP & MySQL"
git branch -M main
git remote add origin https://github.com/<your-username>/<your-repo-name>.git
git push -u origin main
```

Then on your GitHub repo page, add this README (already included) so anyone opening the repo knows how to run it with XAMPP.

### Want a live, clickable demo link too?
If your lab wants an actual working link (not just source code on GitHub), you'd need a host that supports PHP + MySQL, such as **000webhost**, **InfinityFree**, or **Railway**. That's a separate, optional step from submitting your code to GitHub — let me know if you'd like help with that.
