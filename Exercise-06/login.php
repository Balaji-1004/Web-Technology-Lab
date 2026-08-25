<?php
$page_title = "Login";
require "config.php";
$errors = [];
$email = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = strtolower(trim($_POST["email"] ?? ""));
    $password_value = $_POST["password"] ?? "";
    $stmt = $conn->prepare("SELECT id, full_name, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $full_name, $password_hash);
        $stmt->fetch();
        if (password_verify($password_value, $password_hash)) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_name"] = $full_name;
            redirect("index.php");
        }
    }
    $errors[] = "Email or password is incorrect.";
    $stmt->close();
}
require "header.php";
?>
<section class="auth-layout shell"><div class="auth-aside"><p class="eyebrow">WELCOME BACK</p><h1>Keep<br><em>building.</em></h1><p>Pick up where your next idea begins.</p></div><div class="form-card"><p class="eyebrow">MEMBER ACCESS</p><h2>Login</h2><?php if (isset($_GET["registered"])): ?><div class="message success">Account created. You can log in now.</div><?php endif; ?><?php if ($errors): ?><div class="message error"><?= e(implode(" ", $errors)) ?></div><?php endif; ?><form method="post" id="login-form"><label for="email">Email address<input type="email" id="email" name="email" value="<?= e($email) ?>" required></label><label for="password">Password<div class="password-field"><input type="password" id="password" name="password" required><button type="button" class="password-toggle" data-target="password">Show</button></div></label><button class="button button-dark form-submit" type="submit">Log in <span>-></span></button></form><p class="form-note">New to the department? <a href="register.php">Create an account.</a></p></div></section>
<?php require "footer.php"; ?>
