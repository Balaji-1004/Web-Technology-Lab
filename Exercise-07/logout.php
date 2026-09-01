<?php
require 'db.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('login.php');
}

// Destroy session completely
session_destroy();
$_SESSION = [];

// Redirect to login page
redirect('login.php');
?>
