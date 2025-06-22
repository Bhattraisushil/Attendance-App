<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../pages/admin.php");
  exit;
}

include 'db.php';

if (isset($_POST['user_id'])) {
  $user_id = $_POST['user_id'];

  // Delete related attendance records
  $att = $conn->prepare("DELETE FROM attendance WHERE user_id = ?");
  $att->bind_param("i", $user_id);
  $att->execute();

  // Delete the employee
  $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
}

header("Location: ../pages/admin.php");
exit;
