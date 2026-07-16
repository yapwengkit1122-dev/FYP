<?php
session_start();
require "config.php";

if (!isset($_GET['student_id']) || !isset($_GET['date'])) {
    header("Location: attendance.php");
    exit;
}

$student_id = $_GET['student_id'];
$date = $_GET['date'];

$sql = "DELETE FROM attendance WHERE student_id = ? AND date = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ss", $student_id, $date);

if ($stmt->execute()) {
    header("Location: attendance.php?deleted=1");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}
?>