<?php
include 'db.php';

$sql = "SELECT u.employee_id, u.name, a.date, a.check_in, a.check_out
        FROM attendance a
        JOIN users u ON a.user_id = u.id
        ORDER BY a.date DESC";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
