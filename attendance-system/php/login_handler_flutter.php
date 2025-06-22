<?php
include 'db.php';

$employee_id = $_POST['employee_id'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT * FROM users WHERE employee_id = ?");
$query->bind_param("s", $employee_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        'status' => 'success',
        'user_id' => $user['id']
    ]);
} else {
    echo json_encode([
        'status' => 'fail',
        'message' => 'Invalid ID or password'
    ]);
}
?>
