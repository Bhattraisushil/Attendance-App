<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');
$time_now = date('H:i:s');
$action = $_POST['action'];

if ($action === "checkin") {
    // Check if already checked in
    $stmt = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? AND date = ?");
    $stmt->bind_param("is", $user_id, $today);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $insert = $conn->prepare("INSERT INTO attendance (user_id, date, check_in) VALUES (?, ?, ?)");
        $insert->bind_param("iss", $user_id, $today, $time_now);
        $insert->execute();
        $_SESSION['message'] = "Checked in successfully.";
    } else {
        $_SESSION['message'] = "Already checked in today.";
    }
} elseif ($action === "checkout") {
    $update = $conn->prepare("UPDATE attendance SET check_out = ? WHERE user_id = ? AND date = ? AND check_out IS NULL");
    $update->bind_param("sis", $time_now, $user_id, $today);
    $update->execute();

    if ($update->affected_rows > 0) {
        $_SESSION['message'] = "Checked out successfully.";
    } else {
        $_SESSION['message'] = "You must check in first or have already checked out.";
    }
} elseif ($action === "logout") {
    session_destroy();
    header("Location: ../pages/login.php");
    exit;
}

header("Location: ../pages/dashboard.php");
exit;
?>
