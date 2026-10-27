<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$address = trim($_POST["address"] ?? "");

if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $phone === "" || $address === "") {
    header("Location: index.php?status=invalid");
    exit();
}

$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, address) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $address);

if ($stmt->execute()) {
    $status = "added";
} else {
    $status = "error";
}

$stmt->close();
$conn->close();
header("Location: index.php?status=" . $status);
exit();
?>