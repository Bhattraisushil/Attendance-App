<?php
session_start();
include '../php/db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Use same hashing used in DB

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $adminResult = $stmt->get_result();

    if ($adminResult->num_rows === 1) {
        $_SESSION['admin'] = $username;
    } else {
        $login_error = "Invalid admin credentials.";
    }
}
?>

<?php if (!isset($_SESSION['admin'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #141e30, #243b55);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .admin-box {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 350px;
    }

    .admin-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .admin-box input {
      width: 100%;
      padding: 10px 15px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .admin-box button {
      width: 100%;
      padding: 10px;
      background-color: #343a40;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .admin-box button:hover {
      background-color: #23272b;
    }

    .error-message {
      text-align: center;
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="admin-box">
  <h2>Admin Login</h2>
  <?php if (isset($login_error)): ?>
    <div class="error-message"><?= $login_error ?></div>
  <?php endif; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Admin Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</div>

</body>
</html>

<?php else: ?>

<!-- ✅ Show Admin Dashboard (from previous step) -->
<?php
$query = $conn->query("
    SELECT u.name, u.employee_id, a.date, a.check_in, a.check_out
    FROM users u
    LEFT JOIN attendance a ON u.id = a.user_id
    ORDER BY a.date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    h2, h3 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #343a40;
      color: white;
    }
    .logout-btn {
      background: #dc3545;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 6px;
      float: right;
      cursor: pointer;
      text-decoration: none;
    }
    .export-btn {
      background: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 6px;
      float: left;
      cursor: pointer;
      text-decoration: none;
    }
  </style>
</head>
<body>

<h2>Welcome, Admin</h2>
<p>
  <a href="../php/export.php" class="export-btn">Download CSV</a>
  <a href="../php/logout.php?admin=1" class="logout-btn">Logout</a>
</p>

<h3>All Employee Attendance Records</h3>

<table>
  <tr>
    <th>Name</th>
    <th>Employee ID</th>
    <th>Date</th>
    <th>Check In</th>
    <th>Check Out</th>
  </tr>
  <?php while ($row = $query->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['employee_id']) ?></td>
      <td>
  <?= $row['date'] ? date('M d, Y', strtotime($row['date'])) : '-' ?>
</td>

      <td><?= $row['check_in'] ?? '-' ?></td>
      <td><?= $row['check_out'] ?? '-' ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<h4>Registered Employees</h4>

<table>
  <tr>
    <th>Name</th>
    <th>Employee ID</th>
    <th>Action</th>
  </tr>
  <?php
  $employees = $conn->query("SELECT * FROM users");
  while ($emp = $employees->fetch_assoc()):
  ?>
    <tr>
      <td><?= htmlspecialchars($emp['name']) ?></td>
      <td><?= htmlspecialchars($emp['employee_id']) ?></td>
      <td>
        <form method="POST" action="../php/delete_user.php" onsubmit="return confirm('Are you sure?');">
          <input type="hidden" name="user_id" value="<?= $emp['id'] ?>">
          <button type="submit" style="background:red;color:white;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;">
            Delete
          </button>
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
</table>


</body>
</html>
<?php endif; ?>
