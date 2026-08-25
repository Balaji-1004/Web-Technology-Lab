<?php
// ============================================
// Database connection settings
// Edit these if your MySQL setup is different
// ============================================
$host = "localhost";
$username = "root";
$password = "";       // default XAMPP/WAMP password is empty
$database = "employee_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
