<?php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNova Solutions - Home</title>
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
                <li><a href="index.php" class="nav-link active">Home</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#about" class="nav-link">About Us</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <?php if (is_logged_in()): ?>
                    <li><span class="nav-user">Welcome, <?php echo e(explode(" ", $_SESSION['user_name'])[0]); ?></span></li>
                    <?php if (has_role('employee')): ?>
                        <li><a href="employee_dashboard.php" class="nav-link btn-primary">Dashboard</a></li>
                    <?php elseif (has_role('admin')): ?>
                        <li><a href="admin_dashboard.php" class="nav-link btn-primary">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php" class="nav-link btn-danger">Logout</a></li>
                <?php else: ?>
                    <li><a href="register.php" class="nav-link">Register</a></li>
                    <li><a href="login.php" class="nav-link btn-primary">Login</a></li>
                <?php endif; ?>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to TechNova Solutions</h1>
            <p>Empowering businesses with innovative technology solutions and expert talent management.</p>
            <?php if (!is_logged_in()): ?>
                <div class="hero-buttons">
                    <a href="register.php" class="btn btn-primary">Get Started</a>
                    <a href="login.php" class="btn btn-secondary">Login</a>
                </div>
            <?php else: ?>
                <div class="hero-buttons">
                    <?php if (has_role('employee')): ?>
                        <a href="employee_dashboard.php" class="btn btn-primary">Go to Dashboard</a>
                    <?php else: ?>
                        <a href="admin_dashboard.php" class="btn btn-primary">Go to Dashboard</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="hero-image">
            <div class="hero-icon">💼</div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2>Our Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🔧</div>
                    <h3>Employee Management</h3>
                    <p>Streamlined systems to manage employee information, roles, and departmental assignments efficiently.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📊</div>
                    <h3>Data Analytics</h3>
                    <p>Comprehensive insights into workforce metrics and organizational performance indicators.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🔐</div>
                    <h3>Secure Access</h3>
                    <p>Role-based authentication and secure login systems protecting sensitive company information.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">👥</div>
                    <h3>Team Collaboration</h3>
                    <p>Tools and systems enabling seamless communication and collaboration across departments.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2>About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>TechNova Solutions is a forward-thinking technology company dedicated to helping organizations manage their workforce efficiently and securely. With a focus on innovation and reliability, we provide comprehensive solutions for employee management, authentication, and data management.</p>
                    <p>Our platform is built with security, scalability, and user experience in mind. We serve businesses of all sizes, from startups to enterprises, enabling them to streamline their operations and focus on growth.</p>
                </div>
                <div class="about-stats">
                    <div class="stat">
                        <h4>500+</h4>
                        <p>Active Users</p>
                    </div>
                    <div class="stat">
                        <h4>50+</h4>
                        <p>Companies</p>
                    </div>
                    <div class="stat">
                        <h4>10+</h4>
                        <p>Years Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">📧</div>
                    <h3>Email</h3>
                    <p><a href="mailto:info@technova.com">info@technova.com</a></p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">📞</div>
                    <h3>Phone</h3>
                    <p><a href="tel:+919876543210">+91 98765 43210</a></p>
                </div>
                <div class="contact-card">
                    <div class="contact-icon">📍</div>
                    <h3>Address</h3>
                    <p>Tech Park, Building A<br>Bangalore, India - 560001</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 TechNova Solutions. All rights reserved.</p>
            <p>A Web Technology Lab Exercise - Department of Computer Science</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
