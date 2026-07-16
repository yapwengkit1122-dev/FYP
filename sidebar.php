<div class="sidebar">
    <h4 class="text-white text-center py-3">📌 Navigation</h4>
    <a href="dashboard.php">🏠 Home</a>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="students.php">👨‍🎓 Students</a>
    <a href="attendance.php">🗓 Attendance</a>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="add_student.php">➕ Add Student</a>
        <a href="add_attendance.php">✍ Add Attendance</a>
    <?php endif; ?>

    <a href="search.php">🔍 Search</a>
    <a href="prediction.php">🤖 Prediction (AI)</a>

    <hr class="text-white">
    <a href="logout.php">🚪 Logout</a>
</div>