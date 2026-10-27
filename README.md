# Web Technology Lab

A collection of web technology lab exercises, from static HTML/CSS/JavaScript pages to PHP and MySQL applications.

## GitHub and local development

GitHub stores and showcases this project's source code. GitHub Pages can serve the static exercises, but it cannot run PHP or connect to MySQL. The PHP exercises are intended to run locally on your machine with XAMPP.

## Run the PHP exercises with XAMPP

1. Clone or copy this repository into XAMPP's `htdocs` folder. For example: `C:\xampp\htdocs\Web-Technology-Lab`.
2. Start **Apache** and **MySQL** in the XAMPP Control Panel.
3. In phpMyAdmin (`http://localhost/phpmyadmin`), import the SQL file for the exercise you want to run:

   | Exercise | SQL file |
   | --- | --- |
   | 05 | `Exercise-05/database.sql` |
   | 06 | `Exercise-06/department_db.sql` |
   | 07 | `Exercise-07/database/company.sql` |
   | 08 | `Exercise-08/database.sql` |

4. Open the exercise at `http://localhost/Web-Technology-Lab/Exercise-05/` (replace `Exercise-05` with the folder for the exercise).

The database settings use the default XAMPP MySQL account (`root` with an empty password). If your local MySQL credentials differ, update the connection settings in that exercise's PHP configuration file.

Exercises 09 and 10 use local JSON files with AJAX; serve the repository through Apache or another local web server so the browser can request those files. Other static exercises can be opened directly in a browser.
