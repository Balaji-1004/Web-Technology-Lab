<?php
// Database Connection & Configuration
// For XAMPP: default credentials are localhost, root (no password)

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "company_db";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8mb4");

// ========== UTILITY FUNCTIONS ==========

/**
 * Safely escape and output strings to prevent XSS attacks
 */
function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
}

/**
 * Check if user has a specific role
 */
function has_role($role) {
    return is_logged_in() && $_SESSION['user_role'] === $role;
}

/**
 * Redirect user to a page
 */
function redirect($page) {
    header("Location: " . $page);
    exit();
}

/**
 * Get all users by role
 */
function get_users_by_role($conn, $role) {
    $query = "SELECT id, name, email, phone, department FROM users WHERE role = ? ORDER BY name ASC";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        return [];
    }
    
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    
    $stmt->close();
    return $users;
}

/**
 * Get user by email
 */
function get_user_by_email($conn, $email) {
    $query = "SELECT id, name, email, password, role, phone, department FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        return null;
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $user = $result->fetch_assoc();
    
    $stmt->close();
    return $user;
}

/**
 * Check if email already exists
 */
function email_exists($conn, $email) {
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        return false;
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $exists = $result->num_rows > 0;
    
    $stmt->close();
    return $exists;
}

/**
 * Register a new user
 */
function register_user($conn, $name, $email, $password, $phone, $department, $role) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $created_at = date('Y-m-d H:i:s');
    
    $query = "INSERT INTO users (name, email, password, phone, department, role, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        return false;
    }
    
    $stmt->bind_param("sssssss", $name, $email, $hashed_password, $phone, $department, $role, $created_at);
    $result = $stmt->execute();
    
    $stmt->close();
    return $result;
}
?>
