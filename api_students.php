<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', '', 'p', 'attendance_system');

if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT student_id, name, course FROM students ORDER BY name";
$res = $conn->query($sql);

$out = [];

if ($res) {
    while ($row = $res->fetch_assoc()) {
        $out[] = $row;
    }
}

echo json_encode($out);
