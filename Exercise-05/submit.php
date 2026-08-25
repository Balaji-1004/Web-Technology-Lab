<?php
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect and sanitize form input
    $full_name       = trim($_POST['full_name']);
    $email           = trim($_POST['email']);
    $phone           = trim($_POST['phone']);
    $department      = trim($_POST['department']);
    $designation     = trim($_POST['designation']);
    $date_of_joining = trim($_POST['date_of_joining']);
    $salary          = trim($_POST['salary']);

    // Basic validation
    if ($full_name === "" || $email === "" || $phone === "" ||
        $department === "" || $designation === "" ||
        $date_of_joining === "" || $salary === "") {
        header("Location: index.php?status=error");
        exit();
    }

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare(
        "INSERT INTO employees (full_name, email, phone, department, designation, date_of_joining, salary)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $full_name, $email, $phone, $department, $designation, $date_of_joining, $salary);

    if ($stmt->execute()) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }

    $stmt->close();
    $conn->close();
    exit();

} else {
    header("Location: index.php");
    exit();
}
?>
