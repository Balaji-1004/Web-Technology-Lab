<?php
require 'db.php';

// Check if user is logged in and is an employee
if (!is_logged_in() || !has_role('employee')) {
    redirect('login.php');
}

// Get all admin users
$admins = get_users_by_role($conn, 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - TechNova Solutions</title>
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
                <li><span class="nav-user">👤 <?php echo e($_SESSION['user_name']); ?></span></li>
                <li><a href="logout.php" class="nav-link btn-danger">Logout</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1>Employee Dashboard</h1>
            <p class="welcome-message">Welcome, <strong><?php echo e($_SESSION['user_name']); ?></strong>!</p>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <h2>👥 Administrator Directory</h2>
                <p>View all administrators in the system</p>
            </div>

            <?php if (empty($admins)): ?>
                <div class="empty-state">
                    <p>No administrators found in the system.</p>
                </div>
            <?php else: ?>
                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $admin): ?>
                                <tr>
                                    <td class="id-column"><?php echo e($admin['id']); ?></td>
                                    <td><?php echo e($admin['name']); ?></td>
                                    <td><?php echo e($admin['email']); ?></td>
                                    <td><?php echo e($admin['phone']); ?></td>
                                    <td><?php echo e($admin['department']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="card-footer">
                <p class="info-text">Total Administrators: <strong><?php echo count($admins); ?></strong></p>
            </div>
        </div>

        <div class="dashboard-actions">
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
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
