<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "department_db";

mysqli_report(MYSQLI_REPORT_OFF);
$conn = @new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed. Import department_db.sql and check your MySQL service.");
}

$conn->set_charset("utf8mb4");

function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}

function is_logged_in() {
    return isset($_SESSION["user_id"]);
}

function redirect($location) {
    header("Location: " . $location);
    exit();
}
