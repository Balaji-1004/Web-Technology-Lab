<?php
require 'db.php';

$error = '';

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = 'Email and password are required.';
    } else {
        // Get user from database
        $user = get_user_by_email($conn, $email);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            // Login successful - set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'employee') {
                redirect('employee_dashboard.php');
            } elseif ($user['role'] === 'admin') {
                redirect('admin_dashboard.php');
            }
        } else {
            $error = 'Invalid email or password. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechNova Solutions</title>
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
                <li><a href="login.php" class="nav-link active">Login</a></li>
                <li><a href="register.php" class="nav-link">Register</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="auth-container">
        <div class="auth-card">
            <h1>Welcome Back</h1>
            <p>Login to your TechNova Solutions account</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error">
                    ✕ <?php echo e($error); ?>
                    <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required placeholder="your@email.com" value="<?php echo e($_POST['email'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password *</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                        <button type="button" class="password-toggle" data-target="password">Show</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <hr class="form-divider">

            <div class="demo-credentials">
                <h4>Demo Credentials</h4>
                <p><strong>Employee Login:</strong><br>
                   Email: emp1@technova.com<br>
                   Password: Employee@123</p>
                <p><strong>Admin Login:</strong><br>
                   Email: admin1@technova.com<br>
                   Password: Admin@123</p>
            </div>

            <p class="auth-link">
                Don't have an account? <a href="register.php">Register here</a>
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
