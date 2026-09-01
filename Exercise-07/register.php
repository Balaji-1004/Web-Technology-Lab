<?php
require 'db.php';

// Initialize form variables
$error = '';
$success = '';
$name = '';
$email = '';
$phone = '';
$department = '';
$role = '';

// Process registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $role = trim($_POST['role'] ?? '');

    // Validate inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($phone) || empty($department) || empty($role)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } elseif (email_exists($conn, $email)) {
        $error = 'Email already registered. Please use a different email or login.';
    } elseif ($role !== 'employee' && $role !== 'admin') {
        $error = 'Invalid role selected.';
    } else {
        // Register the user
        if (register_user($conn, $name, $email, $password, $phone, $department, $role)) {
            $success = 'Registration successful! Redirecting to login...';
            header("refresh:2;url=login.php");
        } else {
            $error = 'Registration failed. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TechNova Solutions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <span class="logo-icon">🚀</span>
                <span class="logo-text">TechNova Solutions</span>
            </div>
            <ul class="nav-menu">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="login.php" class="nav-link">Login</a></li>
                <li><a href="register.php" class="nav-link active">Register</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Registration Section -->
    <div class="auth-container">
        <div class="auth-card">
            <h1>Create Your Account</h1>
            <p>Join TechNova Solutions and access our management platform</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    ✕ <?php echo e($error); ?>
                    <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    ✓ <?php echo e($success); ?>
                    <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST" class="auth-form" id="registerForm">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required placeholder="John Doe" value="<?php echo e($name); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required placeholder="john@technova.com" value="<?php echo e($email); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required placeholder="At least 6 characters">
                    <small>Must be at least 6 characters</small>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Re-enter your password">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required placeholder="98765 43210" value="<?php echo e($phone); ?>">
                </div>

                <div class="form-group">
                    <label for="department">Department *</label>
                    <select id="department" name="department" required>
                        <option value="">-- Select Department --</option>
                        <option value="Engineering" <?php echo ($department === 'Engineering') ? 'selected' : ''; ?>>Engineering</option>
                        <option value="Human Resources" <?php echo ($department === 'Human Resources') ? 'selected' : ''; ?>>Human Resources</option>
                        <option value="Finance" <?php echo ($department === 'Finance') ? 'selected' : ''; ?>>Finance</option>
                        <option value="Marketing" <?php echo ($department === 'Marketing') ? 'selected' : ''; ?>>Marketing</option>
                        <option value="Sales" <?php echo ($department === 'Sales') ? 'selected' : ''; ?>>Sales</option>
                        <option value="Operations" <?php echo ($department === 'Operations') ? 'selected' : ''; ?>>Operations</option>
                        <option value="Administration" <?php echo ($department === 'Administration') ? 'selected' : ''; ?>>Administration</option>
                        <option value="Management" <?php echo ($department === 'Management') ? 'selected' : ''; ?>>Management</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="role">Role *</label>
                    <select id="role" name="role" required>
                        <option value="">-- Select Role --</option>
                        <option value="employee" <?php echo ($role === 'employee') ? 'selected' : ''; ?>>Employee</option>
                        <option value="admin" <?php echo ($role === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>

            <p class="auth-link">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 TechNova Solutions. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
