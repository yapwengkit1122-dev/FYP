<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

session_start();
require "config.php";

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit();
}
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $course = trim($_POST['course']);

    $update = $conn->prepare("UPDATE students SET name = ?, course = ? WHERE student_id = ?");
    $update->bind_param("sss", $name, $course, $id);
    $update->execute();

    header("Location: students.php?updated=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Student</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <div class="card p-4" style="max-width:600px; margin:auto;">
        <h3>Edit Student</h3>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Student Name</label>
                <input type="text" name="name" class="form-control" 
                       value="<?= htmlspecialchars($student['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text" name="course" class="form-control"
                       value="<?= htmlspecialchars($student['course']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="students.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>