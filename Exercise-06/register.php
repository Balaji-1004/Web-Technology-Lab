<?php
$page_title = "Registration";
require "config.php";
$errors = [];
$full_name = "";
$email = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $email = strtolower(trim($_POST["email"] ?? ""));
    $password_value = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";
    if (strlen($full_name) < 2) $errors[] = "Please enter your full name.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address.";
    if (strlen($password_value) < 8) $errors[] = "Password must be at least 8 characters.";
    if ($password_value !== $confirm_password) $errors[] = "Passwords do not match.";
    if (!$errors) {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        if ($check->num_rows > 0) {
            $errors[] = "An account with this email already exists.";
        } else {
            $hash = password_hash($password_value, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $full_name, $email, $hash);
            if ($stmt->execute()) {
                redirect("login.php?registered=1");
            }
            $errors[] = "Registration could not be completed. Please try again.";
            $stmt->close();
        }
        $check->close();
    }
}
require "header.php";
?>
<section class="auth-layout shell"><div class="auth-aside"><p class="eyebrow">START HERE</p><h1>Make your<br><em>mark.</em></h1><p>Create your department account to access the learning community.</p></div><div class="form-card"><p class="eyebrow">NEW ACCOUNT</p><h2>Registration</h2><?php if ($errors): ?><div class="message error"><?= e(implode(" ", $errors)) ?></div><?php endif; ?><form method="post" id="register-form" novalidate><label for="full_name">Full name<input type="text" id="full_name" name="full_name" value="<?= e($full_name) ?>" required></label><label for="email">Email address<input type="email" id="email" name="email" value="<?= e($email) ?>" required></label><label for="password">Password<div class="password-field"><input type="password" id="password" name="password" required minlength="8"><button type="button" class="password-toggle" data-target="password">Show</button></div></label><label for="confirm_password">Confirm password<input type="password" id="confirm_password" name="confirm_password" required minlength="8"></label><button class="button button-dark form-submit" type="submit">Create account <span>-></span></button></form><p class="form-note">Already registered? <a href="login.php">Log in here.</a></p></div></section>
<?php require "footer.php"; ?>
