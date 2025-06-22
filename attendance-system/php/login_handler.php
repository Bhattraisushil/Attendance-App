<?php
session_start();
include 'db.php';

$emp_id = $_POST['employee_id'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE employee_id = ?");
$stmt->bind_param("s", $emp_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: ../pages/dashboard.php");
        exit;
    } else {
        header("Location: ../pages/login.php?error=Invalid password");
        exit;
    }
} else {
    header("Location: ../pages/login.php?error=User not found");
    exit;
}
?>
