<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

session_start();
require "config.php";

if (!isset($_GET['student_id']) || !isset($_GET['date'])) {
    header("Location: attendance.php");
    exit();
}

$student_id = $_GET['student_id'];
$date = $_GET['date'];

$stmt = $conn->prepare("SELECT * FROM attendance WHERE student_id = ? AND date = ?");
$stmt->bind_param("ss", $student_id, $date);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();

if (!$record) {
    die("Record not found!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status = $_POST['status'];
    $new_date = $_POST['date'];

    $update = $conn->prepare("UPDATE attendance SET status = ?, date = ? WHERE student_id = ? AND date = ?");
    $update->bind_param("ssss", $new_status, $new_date, $student_id, $date);
    $update->execute();

    header("Location: attendance.php?updated=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <div class="card p-4" style="max-width:600px; margin:auto;">
        <h3>Edit Attendance</h3>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($student_id); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control"
                       value="<?= htmlspecialchars($record['date']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Present" <?= $record['status']=="Present"?"selected":""; ?>>Present</option>
                    <option value="Absent" <?= $record['status']=="Absent"?"selected":""; ?>>Absent</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="attendance.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>