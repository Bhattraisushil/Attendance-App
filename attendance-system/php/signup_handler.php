<?php
include 'db.php';

$name = $_POST['name'];
$emp_id = $_POST['employee_id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if already exists
$check = $conn->prepare("SELECT * FROM users WHERE employee_id = ?");
$check->bind_param("s", $emp_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    header("Location: ../pages/signup.php?error=Employee ID already exists");
    exit;
}

$stmt = $conn->prepare("INSERT INTO users (name, employee_id, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $emp_id, $password);

if ($stmt->execute()) {
    header("Location: ../pages/login.php?msg=Registration successful");
    exit;
} else {
    header("Location: ../pages/signup.php?error=Something went wrong");
    exit;
}
