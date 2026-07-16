<?php
$conn = new mysqli("localhost", "root", "pwd123", "attendance_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$students = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - AI Attendance System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
        font-family: "Segoe UI", sans-serif;
    }

    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: linear-gradient(180deg, #0d6efd, #084298);
        padding: 20px;
    }

    .sidebar h4 {
        font-weight: 600;
        text-align: center;
    }

    .sidebar a {
        color: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 15px;
        border-radius: 12px;
        text-decoration: none;
        margin-bottom: 6px;
        transition: all 0.3s;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,0.15);
        transform: translateX(5px);
    }

    .sidebar .logout {
        background: rgba(255,255,255,0.15);
        margin-top: 15px;
    }

        .topnav {
            margin-left: 250px;
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            padding: 0 25px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
            font-size: 20px;
            font-weight: 600;
        }

        .content {
            margin-left: 250px;
            padding: 40px;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .card-title {
            font-weight: 600; 
            font-size: 22px;
        }

        .btn-main {
            background: #0d6efd;
            color: white;
            padding: 10px 25px;
            border-radius: 12px;
            transition: .3s;
            border: none;
            font-weight: 600;
        }

        .btn-main:hover { transform: scale(1.05); }
    </style>
</head>

<body>

<div class="sidebar">
    <h4 class="text-white mb-4">📌 Navigation</h4>

    <a href="index.php"><i class="bi bi-house"></i> Home</a>
    <a href="dashboard.php"><i class="bi bi-bar-chart"></i> Dashboard</a>
    <a href="students.php"><i class="bi bi-mortarboard"></i> Students</a>
    <a href="attendance.php"><i class="bi bi-calendar-check"></i> Attendance</a>
    <a href="add_student.php"><i class="bi bi-person-plus"></i> Add Student</a>
    <a href="add_attendance.php"><i class="bi bi-pencil-square"></i> Add Attendance</a>
    <a href="search.php"><i class="bi bi-search"></i> Search</a>
    <a href="predict.php"><i class="bi bi-robot"></i> Prediction (AI)</a>

    <hr class="border-light">
    <a class="logout" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="topnav">
    Dashboard
</div>

<div class="content">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="feature-card">
                <h4 class="card-title">Add Student</h4>
                <p>Add new students into the system database.</p>
                <a href="add_student.php" class="btn-main">Open</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card">
                <h4 class="card-title">Add Attendance</h4>
                <p>Record daily attendance for all students.</p>
                <a href="add_attendance.php" class="btn-main">Open</a>
            </div>
        </div>


        <div class="col-md-4">
            <div class="feature-card">
                <h4 class="card-title">Attendance Prediction</h4>
                <p>Predict attendance using AI/ML algorithm.</p>
                <a href="predict.php" class="btn-main">Open</a>
            </div>
        </div>

    </div>
</div>

</body>
</html>