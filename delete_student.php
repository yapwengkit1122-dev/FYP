<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

session_start();
require "config.php"; 

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit;
}

$student_id = $_GET['id'];

$sql = "DELETE FROM students WHERE student_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $student_id);

if ($stmt->execute()) {
    header("Location: students.php?deleted=1");
    exit;
} else {
    echo "Delete failed: " . $stmt->error;
}
?>