<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'viewer') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Viewer Dashboard</title>
</head>
<body>
<h2>Welcome <?= $_SESSION['username'] ?></h2>

<ul>
    <li><a href="students_view.php">View Students</a></li>
    <li><a href="attendance_view.php">View Attendance</a></li>
</ul>

<a href="logout.php">Logout</a>
</body>
</html>
