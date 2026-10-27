<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if (!$id) {
    $conn->close();
    header("Location: index.php?status=not_found");
    exit();
}

$stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$deleted = $stmt->affected_rows > 0;
$stmt->close();
$conn->close();

header("Location: index.php?status=" . ($deleted ? "deleted" : "not_found"));
exit();
?>