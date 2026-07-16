<?php
require "auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

.main-content {
    margin-left: 280px;
    padding: 30px;
}

.card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.card h6 {
    font-weight: 600;
}

.welcome-card {
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: #fff;
}

.badge-role {
    font-size: 0.9rem;
    padding: 6px 12px;
    border-radius: 20px;
}

.btn-sm {
    border-radius: 20px;
    padding: 6px 18px;
}
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

<div class="main-content">

    <div class="card welcome-card mb-4">
        <div class="card-body">
            <h4>👋 Welcome, <?= $_SESSION['username'] ?></h4>
            <p class="mb-0">
                Role:
                <span class="badge bg-light text-dark badge-role">
                    <?= $_SESSION['role'] ?>
                </span>
            </p>
        </div>
    </div>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>➕ Add Student</h6>
                        <p class="text-muted small">Register new students</p>
                        <a href="add_student.php" class="btn btn-primary btn-sm">Open</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h6>📝 Add Attendance</h6>
                        <p class="text-muted small">Mark daily attendance</p>
                        <a href="add_attendance.php" class="btn btn-warning btn-sm">Open</a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-3">
            👁 You are a <b>View Only</b> user. Editing is disabled.
        </div>
    <?php endif; ?>

</div>

</body>
</html>