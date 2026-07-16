<?php
$conn = new mysqli("localhost", "root", "pwd123", "attendance_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$search = "";
$student = null;
$attendance = [];

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ? OR name LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("ss", $search, $like);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        $sid = $student['student_id'];
        $a = $conn->prepare("SELECT * FROM attendance WHERE student_id=? ORDER BY date DESC");
        $a->bind_param("s", $sid);
        $a->execute();
        $attendance = $a->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Search Student</title>
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
.container-box {
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.1);
}
.search-bar input {
    height:50px;
    border-radius:12px;
}
.table thead {
    background:#0d6efd;
    color:white;
}
.content { margin-left:260px; padding:35px; }
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

<div class="content">
    <div class="container-box col-md-8">

        <h3 class="mb-4">🔍 Search Student Attendance</h3>

        <form method="GET" class="search-bar mb-4 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Enter Student ID or Name"
                   value="<?php echo $search; ?>" required>
            <button class="btn btn-primary px-4">Search</button>
        </form>

        <?php if ($search && !$student): ?>
            <div class="alert alert-danger">❌ No student found.</div>
        <?php endif; ?>

        <?php if ($student): ?>
            <div class="alert alert-info"><strong>Student Found:</strong> <?= $student['name']; ?> (<?= $student['student_id']; ?>)</div>

            <h5 class="mt-4 mb-2">Student Details</h5>
            <table class="table table-bordered">
                <tr><th>Student ID</th><td><?= $student['student_id']; ?></td></tr>
                <tr><th>Name</th><td><?= $student['name']; ?></td></tr>
                <tr><th>Course</th><td><?= $student['course']; ?></td></tr>
            </table>

            <!-- Attendance Table -->
            <h5 class="mt-4 mb-2">Attendance Records</h5>

            <?php if (count($attendance) == 0): ?>
                <div class="alert alert-warning">No attendance record for this student.</div>
            <?php else: ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attendance as $a): ?>
                        <tr>
                            <td><?= $a['date']; ?></td>
                            <td><?= $a['status']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>

</body>
</html>