<?php
require "db.php";

$result = $conn->query("SELECT id, name, email, phone, address FROM contacts ORDER BY id DESC");
$status = $_GET["status"] ?? "";
$messages = [
    "added" => "Contact added successfully.",
    "updated" => "Contact updated successfully.",
    "deleted" => "Contact deleted successfully.",
    "not_found" => "That contact could not be found.",
    "invalid" => "Please enter valid contact details.",
    "error" => "The contact could not be saved. Please try again."
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <main class="page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Web Technology Lab · Exercise 8</p>
                <h1>Contact Management</h1>
            </div>
            <p class="record-count"><?php echo $result->num_rows; ?> contacts</p>
        </header>

        <?php if (isset($messages[$status])): ?>
            <p class="notice" role="status"><?php echo htmlspecialchars($messages[$status], ENT_QUOTES, "UTF-8"); ?></p>
        <?php endif; ?>

        <section class="panel" aria-labelledby="add-heading">
            <div class="section-heading">
                <h2 id="add-heading">Add a contact</h2>
                <p>Enter the contact details below.</p>
            </div>
            <form action="add.php" method="post" class="contact-form">
                <div class="form-field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" maxlength="100" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" maxlength="150" required>
                </div>
                <div class="form-field">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" maxlength="30" required>
                </div>
                <div class="form-field form-field-wide">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="3" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="button button-primary">Add contact</button>
                </div>
            </form>
        </section>

        <section class="contacts-section" aria-labelledby="contacts-heading">
            <div class="section-heading">
                <h2 id="contacts-heading">All contacts</h2>
                <p>View, edit, or remove saved contact details.</p>
            </div>
            <?php if ($result->num_rows > 0): ?>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($contact = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="contact-id"><?php echo (int) $contact["id"]; ?></td>
                                    <td><?php echo htmlspecialchars($contact["name"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td><?php echo htmlspecialchars($contact["email"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td><?php echo htmlspecialchars($contact["phone"], ENT_QUOTES, "UTF-8"); ?></td>
                                    <td class="address-cell"><?php echo nl2br(htmlspecialchars($contact["address"], ENT_QUOTES, "UTF-8")); ?></td>
                                    <td>
                                        <div class="row-actions">
                                            <a class="button button-secondary" href="edit.php?id=<?php echo (int) $contact["id"]; ?>">Edit</a>
                                            <form action="delete.php" method="post" class="delete-form">
                                                <input type="hidden" name="id" value="<?php echo (int) $contact["id"]; ?>">
                                                <button type="submit" class="button button-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h3>No contacts yet</h3>
                    <p>Use the form above to add your first contact.</p>
                </div>
            <?php endif; ?>
        </section>
        <footer>Contact Management System · Web Technology Lab</footer>
    </main>
</body>
</html>
<?php
$result->free();
$conn->close();
?>