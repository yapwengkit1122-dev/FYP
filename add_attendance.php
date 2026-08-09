<?php
session_start();
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

$conn = new mysqli("localhost", "abc", "abc", "attendance_system");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$students = $conn->query("SELECT * FROM students");
$success = "";

if ($isAdmin && isset($_POST['add_attendance'])) {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];
    $date = date("Y-m-d");

    $conn->query("INSERT INTO attendance (student_id, date, status) VALUES ('$student_id', '$date', '$status')");
    $success = "Attendance Recorded!";
}
?>

<?php if (!$isAdmin): ?>
<div class="modal fade" id="accessDeniedModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">⛔ Access Denied</h5>
      </div>
      <div class="modal-body text-center">
        <p>You do not have permission to add students.</p>
        <small class="text-muted">Admin role required</small>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var modal = new bootstrap.Modal(
        document.getElementById('accessDeniedModal'),
        { backdrop: 'static', keyboard: false }
    );
    modal.show();
});
</script>
<?php endif; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Attendance</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
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

<div class="topnav">Add Attendance</div>

<div class="content">
    <div class="card-custom col-md-6">

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="form-label">Select Student</label>
            <select name="student_id" class="form-select mb-3">
                <?php while ($row = $students->fetch_assoc()): ?>
                    <option value="<?= $row['student_id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

            <label class="form-label">Status</label>
            <select class="form-select mb-3" name="status">
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>

            <button name="add_attendance" class="btn btn-primary px-4">Record Attendance</button>
        </form>
    </div>
</div>

</body>
</html>
