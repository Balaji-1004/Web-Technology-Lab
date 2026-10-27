# Contact Management System

A simple PHP and MySQL lab exercise for adding, viewing, editing, and deleting contacts.

## Files

| File | Purpose |
|---|---|
| `index.php` | Add form and contacts table |
| `add.php` | Inserts a contact |
| `edit.php` | Displays and saves contact changes |
| `delete.php` | Deletes a contact |
| `db.php` | Connects to MySQL with `mysqli` |
| `database.sql` | Creates the `contact_db` database and `contacts` table |
| `style.css` | Page styling |
| `script.js` | Confirms before deleting a contact |

## Database Setup

1. Start **MySQL** from the XAMPP Control Panel.
2. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
3. Select the **Import** tab.
4. Choose `database.sql` from this folder and click **Import** or **Go**.
5. Confirm that the `contact_db` database and its `contacts` table appear in phpMyAdmin.

The SQL file creates these columns: `id` (auto-increment), `name`, `email`, `phone`, and `address`.

## Run with XAMPP

1. Install XAMPP if it is not already installed.
2. Copy the complete `Exercise-08` folder into the XAMPP `htdocs` directory. For example:
   `C:\xampp\htdocs\Exercise-08`
3. Start **Apache** and **MySQL** in the XAMPP Control Panel.
4. Import `database.sql` into phpMyAdmin as described above.
5. Open [http://localhost/Exercise-08/](http://localhost/Exercise-08/) in your browser.

The default XAMPP MySQL settings in `db.php` are host `localhost`, username `root`, and an empty password. Change them there if your local MySQL credentials differ.

## Test the Operations

1. **Add:** Fill in the name, email, phone, and address, then click **Add contact**. The new row should appear in the table.
2. **View:** The main page lists saved contacts with their IDs and details. Refresh the page to confirm records persist in MySQL.
3. **Edit:** Click **Edit** beside a contact, change one or more fields, and click **Save changes**. The updated values should appear in the list.
4. **Delete:** Click **Delete** and confirm the browser prompt. The contact should disappear. Choose **Cancel** in the prompt to keep it.