<?php
include 'db.php';

date_default_timezone_set('Asia/Kathmandu');

$user_id = $_POST['user_id'];
$date = date('Y-m-d');
$time = date('H:i:s');

// Update check-out time
$update = $conn->prepare("UPDATE attendance SET check_out = ? WHERE user_id = ? AND date = ?");
$update->bind_param("sis", $time, $user_id, $date);
$update->execute();

echo json_encode(['status' => 'success', 'message' => 'Checked out']);
?>
