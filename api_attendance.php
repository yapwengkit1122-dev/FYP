<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', '', '', 'attendance_system');

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT student_id, status, date FROM attendance ORDER BY date DESC";
$res = $conn->query($sql);

$out = [];

if ($res) {
    while ($row = $res->fetch_assoc()) {
        $out[] = $row;
    }
}

echo json_encode($out);
