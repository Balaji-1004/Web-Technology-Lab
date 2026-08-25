<?php
require_once "config.php";
$page_title = $page_title ?? "Department of Computer Science";
$current_page = basename($_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?> | DCS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
  <div class="shell nav-wrap">
    <a class="brand" href="index.php"><span class="brand-mark">CS</span><span>Department of<br><strong>Computer Science</strong></span></a>
    <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false">MENU</button>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="index.php" class="<?= $current_page === "index.php" ? "active" : "" ?>">Home</a>
      <a href="about.php" class="<?= $current_page === "about.php" ? "active" : "" ?>">About us</a>
      <?php if (is_logged_in()): ?>
        <span class="welcome">Hi, <?= e(explode(" ", $_SESSION["user_name"])[0]) ?></span>
        <a href="logout.php" class="nav-action">Log out</a>
      <?php else: ?>
        <a href="login.php" class="<?= $current_page === "login.php" ? "active" : "" ?>">Login</a>
        <a href="register.php" class="nav-action <?= $current_page === "register.php" ? "active" : "" ?>">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main>
