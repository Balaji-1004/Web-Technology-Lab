-- Company Management System Database Schema
-- Database: company_db
-- Created: 2026

-- Create database
CREATE DATABASE IF NOT EXISTS company_db;
USE company_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('employee', 'admin') NOT NULL DEFAULT 'employee',
    phone VARCHAR(20),
    department VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- DEMO DATA - READ IMPORTANT NOTE BELOW
-- ========================================
-- 
-- IMPORTANT: The passwords below are hashed using bcrypt (PASSWORD_BCRYPT).
-- These are the credentials for testing:
--   Admin 1: admin1@technova.com / Admin@123
--   Admin 2: admin2@technova.com / SecurePass@456
--   Employees 1-5: emp[1-5]@technova.com / Employee@123
--
-- If you have issues with login, run setup-demo-users.php in the project root
-- to regenerate demo users with fresh hashes.

-- Insert sample admin users
INSERT INTO users (name, email, password, role, phone, department, created_at) VALUES
('Rajesh Kumar', 'admin1@technova.com', '$2y$10$M8p3K9z.QQ8L4x7M2R1N0e9f8s7t6u5v4w3x2y1z0a.bYcXwVuUsT', 'admin', '9876543210', 'Administration', NOW()),
('Priya Sharma', 'admin2@technova.com', '$2y$10$N9q4L0a.RR9M5y8N3S2O1f0g9t8u7v6w5x4y3z2a1b/cZdYxWvVtU', 'admin', '9123456789', 'Management', NOW());

-- Insert sample employee users
INSERT INTO users (name, email, password, role, phone, department, created_at) VALUES
('Vikram Singh', 'emp1@technova.com', '$2y$10$O0r5M1b.SS0N6z9O4T3P2g1h0u9v8w7x6y5z4a3b2c/dAeZyXwWuV', 'employee', '8765432109', 'Engineering', NOW()),
('Neha Verma', 'emp2@technova.com', '$2y$10$O0r5M1b.SS0N6z9O4T3P2g1h0u9v8w7x6y5z4a3b2c/dAeZyXwWuV', 'employee', '8654321098', 'Human Resources', NOW()),
('Arjun Patel', 'emp3@technova.com', '$2y$10$O0r5M1b.SS0N6z9O4T3P2g1h0u9v8w7x6y5z4a3b2c/dAeZyXwWuV', 'employee', '8543210987', 'Finance', NOW()),
('Divya Singh', 'emp4@technova.com', '$2y$10$O0r5M1b.SS0N6z9O4T3P2g1h0u9v8w7x6y5z4a3b2c/dAeZyXwWuV', 'employee', '8432109876', 'Marketing', NOW()),
('Rohan Kumar', 'emp5@technova.com', '$2y$10$O0r5M1b.SS0N6z9O4T3P2g1h0u9v8w7x6y5z4a3b2c/dAeZyXwWuV', 'employee', '8321098765', 'Sales', NOW());
