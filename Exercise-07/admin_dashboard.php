<?php
require 'db.php';

// Check if user is logged in and is an admin
if (!is_logged_in() || !has_role('admin')) {
    redirect('login.php');
}

// Get all employee users
$employees = get_users_by_role($conn, 'employee');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TechNova Solutions</title>
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
                <li><span class="nav-user">👤 <?php echo e($_SESSION['user_name']); ?> (Admin)</span></li>
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
            <h1>Admin Dashboard</h1>
            <p class="welcome-message">Welcome, <strong><?php echo e($_SESSION['user_name']); ?></strong>! You have administrative privileges.</p>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <h2>👨‍💼 Employee Directory</h2>
                <p>Manage and view all employees in the system</p>
            </div>

            <?php if (empty($employees)): ?>
                <div class="empty-state">
                    <p>No employees found in the system.</p>
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
                            <?php foreach ($employees as $employee): ?>
                                <tr>
                                    <td class="id-column"><?php echo e($employee['id']); ?></td>
                                    <td><?php echo e($employee['name']); ?></td>
                                    <td><?php echo e($employee['email']); ?></td>
                                    <td><?php echo e($employee['phone']); ?></td>
                                    <td><?php echo e($employee['department']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <div class="card-footer">
                <p class="info-text">Total Employees: <strong><?php echo count($employees); ?></strong></p>
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
