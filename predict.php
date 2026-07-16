<?php
$conn = new mysqli("localhost", "root", "pwd123", "attendance_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$students = $conn->query("SELECT * FROM students");

$prediction_result = "";
$rate = 0;

if (isset($_POST['predict'])) {
    $student_id = $_POST['student_id'];

    $records = $conn->query("SELECT * FROM attendance WHERE student_id='$student_id'");
    $total = 0; $present = 0;

    while ($row = $records->fetch_assoc()) {
        $total++;
        if ($row['status'] == "Present") $present++;
    }

    if ($total > 0) $rate = ($present / $total) * 100;
    $prediction_result = ($rate >= 70) ? "Likely to be Present" : "Likely to be Absent";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Prediction</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
.topnav { margin-left: 250px; background: white; padding: 20px; font-size: 22px; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,.1); }
.content { margin-left: 250px; padding: 40px; }
.card-custom { padding: 30px; border-radius: 18px; background: white; box-shadow: 0 6px 20px rgba(0,0,0,.08); }
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

<div class="topnav">Attendance Prediction</div>

<div class="content">
    <div class="card-custom col-md-6">

        <form method="POST">
            <label class="form-label">Select Student</label>
            <select class="form-select mb-3" name="student_id">
                <?php while ($row = $students->fetch_assoc()): ?>
                    <option value="<?= $row['student_id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

            <button name="predict" class="btn btn-primary px-4">Predict</button>
        </form>

        <?php if ($prediction_result): ?>
            <hr>
            <h4>Attendance Rate: <?= round($rate,2) ?>%</h4>
            <h3>Prediction: 
                <span class="badge bg-<?= ($rate >= 70) ? 'success' : 'danger' ?>">
                    <?= $prediction_result ?>
                </span>
            </h3>
        <?php endif; ?>

    </div>
</div>

</body>
</html>