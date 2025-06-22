<?php
include 'db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendance_report.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['Name', 'Employee ID', 'Date', 'Check In', 'Check Out']);

$query = $conn->query("
    SELECT u.name, u.employee_id, a.date, a.check_in, a.check_out
    FROM users u
    LEFT JOIN attendance a ON u.id = a.user_id
    ORDER BY a.date DESC
");

while ($row = $query->fetch_assoc()) {
    fputcsv($output, [$row['name'], $row['employee_id'], $row['date'], $row['check_in'], $row['check_out']]);
}
fclose($output);
?>
