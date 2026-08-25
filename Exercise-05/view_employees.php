<?php
require "db_connect.php";
$result = $conn->query("SELECT * FROM employees ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Registry — All Records</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">

  <div class="masthead">
    <h1>Employee Registry</h1>
    <span class="stamp"><?php echo $result->num_rows; ?> ON FILE</span>
  </div>
  <p class="subhead">All employee records currently stored in the database.</p>

  <nav class="tabs">
    <a href="index.php">Add Employee</a>
    <a href="view_employees.php" class="active">View All Records</a>
  </nav>

  <div class="card">
    <?php if ($result->num_rows > 0): ?>
    <table class="registry">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Department</th>
        <th>Designation</th>
        <th>Joined</th>
        <th>Salary</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td class="id">#<?php echo str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?></td>
        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['phone']); ?></td>
        <td><?php echo htmlspecialchars($row['department']); ?></td>
        <td><?php echo htmlspecialchars($row['designation']); ?></td>
        <td><?php echo htmlspecialchars($row['date_of_joining']); ?></td>
        <td>₹<?php echo number_format($row['salary'], 2); ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
    <?php else: ?>
      <div class="empty">No employee records yet. Add one from the "Add Employee" tab.</div>
    <?php endif; ?>
  </div>

  <footer class="note">Employee Management System · Web Technology Lab Exercise</footer>
</div>
</body>
</html>
<?php $conn->close(); ?>
