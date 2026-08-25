<?php
// Grab status flags from the redirect after submit.php runs
$status = $_GET['status'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Registry — Add Employee</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">

  <div class="masthead">
    <h1>Employee Registry</h1>
    <span class="stamp">FORM 01</span>
  </div>
  <p class="subhead">Enter new employee details below. Fields marked are required.</p>

  <nav class="tabs">
    <a href="index.php" class="active">Add Employee</a>
    <a href="view_employees.php">View All Records</a>
  </nav>

  <div class="card">

    <?php if ($status === 'success'): ?>
      <div class="msg ok">✓ Employee record saved successfully.</div>
    <?php elseif ($status === 'error'): ?>
      <div class="msg err">✕ Could not save the record. Please check the details and try again.</div>
    <?php endif; ?>

    <form action="submit.php" method="POST">

      <div class="field-line">
        <span class="num">01</span>
        <div class="field-body">
          <label for="full_name">Full Name</label>
          <input type="text" id="full_name" name="full_name" required placeholder="e.g. Priya Raman">
        </div>
      </div>

      <div class="field-line">
        <span class="num">02</span>
        <div class="row2 field-body">
          <div class="field-body">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="priya@company.com">
          </div>
          <div class="field-body">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required placeholder="98765 43210">
          </div>
        </div>
      </div>

      <div class="field-line">
        <span class="num">03</span>
        <div class="row2 field-body">
          <div class="field-body">
            <label for="department">Department</label>
            <select id="department" name="department" required>
              <option value="" disabled selected>Select department</option>
              <option>Engineering</option>
              <option>Human Resources</option>
              <option>Finance</option>
              <option>Marketing</option>
              <option>Sales</option>
              <option>Operations</option>
            </select>
          </div>
          <div class="field-body">
            <label for="designation">Designation</label>
            <input type="text" id="designation" name="designation" required placeholder="e.g. Software Engineer">
          </div>
        </div>
      </div>

      <div class="field-line">
        <span class="num">04</span>
        <div class="row2 field-body">
          <div class="field-body">
            <label for="date_of_joining">Date of Joining</label>
            <input type="date" id="date_of_joining" name="date_of_joining" required>
          </div>
          <div class="field-body">
            <label for="salary">Salary (₹)</label>
            <input type="number" id="salary" name="salary" step="0.01" min="0" required placeholder="e.g. 45000">
          </div>
        </div>
      </div>

      <div class="actions">
        <button type="submit" class="submit">SAVE RECORD →</button>
      </div>

    </form>
  </div>

  <footer class="note">Employee Management System · Web Technology Lab Exercise</footer>
</div>
</body>
</html>
