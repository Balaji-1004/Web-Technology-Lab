-- Department Portal - Database Setup
-- Import this file in phpMyAdmin before using the PHP pages.

CREATE DATABASE IF NOT EXISTS department_db;
USE department_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
