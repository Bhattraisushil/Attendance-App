<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include '../php/db.php';

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];

// Fetch attendance for this user
$query = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? ORDER BY date DESC");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f0f4f8;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    h2 {
      margin-bottom: 10px;
    }
    button {
      padding: 10px 20px;
      margin: 5px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button.logout {
      background-color: #dc3545;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Welcome, <?php echo htmlspecialchars($name); ?></h2>
  <form action="../php/attendance_handler.php" method="POST" style="margin-bottom: 20px;">
    <form method="POST" action="../php/checkin.php" style="display:inline;">
  <button type="submit">Check In</button>
</form>

<form method="POST" action="../php/checkout.php" style="display:inline; margin-left:10px;">
  <button type="submit">Check Out</button>
</form>

    <button type="submit" name="action" value="logout" class="logout">Logout</button>
  </form>

  <h3>Your Attendance Report</h3>
  <table>
    <tr>
      <th>Date</th>
      <th>Check In</th>
      <th>Check Out</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td>
  <?= $row['date'] ? date('M d, Y', strtotime($row['date'])) : '-' ?>
</td>

        <td><?php echo $row['check_in'] ?? '-'; ?></td>
        <td><?php echo $row['check_out'] ?? '-'; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
