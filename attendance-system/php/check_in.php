<?php
include 'db.php';

date_default_timezone_set('Asia/Kathmandu');

$user_id = $_POST['user_id'];
$date = date('Y-m-d');
$time = date('H:i:s');

// Check if already checked in
$stmt = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? AND date = ?");
$stmt->bind_param("is", $user_id, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $insert = $conn->prepare("INSERT INTO attendance (user_id, date, check_in) VALUES (?, ?, ?)");
    $insert->bind_param("iss", $user_id, $date, $time);
    $insert->execute();
    echo json_encode(['status' => 'success', 'message' => 'Checked in']);
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Already checked in']);
}
?>
