<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");

    if (!$id || $name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $phone === "" || $address === "") {
        $conn->close();
        header("Location: index.php?status=invalid");
        exit();
    }

    $check = $conn->prepare("SELECT id FROM contacts WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $contact_exists = $check->get_result()->num_rows > 0;
    $check->close();

    if (!$contact_exists) {
        $conn->close();
        header("Location: index.php?status=not_found");
        exit();
    }

    $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
    $updated = $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php?status=" . ($updated ? "updated" : "error"));
    exit();
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) {
    $conn->close();
    header("Location: index.php?status=not_found");
    exit();
}

$stmt = $conn->prepare("SELECT id, name, email, phone, address FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$contact = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$contact) {
    header("Location: index.php?status=not_found");
    exit();
}

function escape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page page-narrow">
        <header class="page-header">
            <div>
                <p class="eyebrow">Web Technology Lab · Exercise 8</p>
                <h1>Edit contact</h1>
            </div>
            <a class="button button-secondary" href="index.php">Back to contacts</a>
        </header>

        <section class="panel" aria-label="Edit contact details">
            <form action="edit.php" method="post" class="contact-form">
                <input type="hidden" name="id" value="<?php echo (int) $contact["id"]; ?>">
                <div class="form-field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" maxlength="100" value="<?php echo escape($contact["name"]); ?>" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" maxlength="150" value="<?php echo escape($contact["email"]); ?>" required>
                </div>
                <div class="form-field">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" maxlength="30" value="<?php echo escape($contact["phone"]); ?>" required>
                </div>
                <div class="form-field form-field-wide">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="4" required><?php echo escape($contact["address"]); ?></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="button button-primary">Save changes</button>
                    <a class="text-link" href="index.php">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>