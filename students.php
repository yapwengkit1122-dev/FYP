<?php
require "auth.php";
$isAdmin = ($_SESSION['role'] === 'admin');
?>
<?php
session_start();
require "config.php";

$result = $conn->query("SELECT * FROM students ORDER BY student_id DESC");
$students = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="modal fade" id="deniedModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">⛔ Access Denied</h5>
      </div>
      <div class="modal-body text-center">
        <p>You do not have permission to edit or delete students.</p>
        <small class="text-muted">Admin role required</small>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
function showDenied() {
    var modal = new bootstrap.Modal(document.getElementById('deniedModal'));
    modal.show();
}
</script>

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

<div style="margin-left:260px" class="p-4">
    <div class="card p-4">
        <h3 class="mb-3">Student List</h3>

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th style="width:150px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $s): ?>
                <tr>
                    <td><?= $s['student_id']; ?></td>
                    <td><?= $s['name']; ?></td>
                    <td><?= $s['course']; ?></td>
                    <td>
                    <?php if ($isAdmin): ?>
                        <a href="edit_student.php?id=<?= $s['student_id']; ?>" 
                        class="btn btn-warning btn-sm">Edit</a>

                        <a href="delete_student.php?id=<?= $s['student_id']; ?>" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Confirm delete this student?');">
                        Delete
                        </a>
                    <?php else: ?>
                        <button class="btn btn-warning btn-sm" onclick="showDenied()">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="showDenied()">Delete</button>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (count($students) == 0): ?>
            <div class="alert alert-warning">No students found.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>