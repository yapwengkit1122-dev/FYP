<?php
session_start();
require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    height:100vh;display:flex;justify-content:center;align-items:center;
    background:linear-gradient(135deg,#0d6efd,#6610f2);
}
.card{
    width:420px;padding:40px;border-radius:20px;
    background:#fff;box-shadow:0 15px 40px rgba(0,0,0,.2);
}
</style>
</head>
<body>

<div class="card">
    <h3 class="text-center mb-4">AI Attendance System</h3>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input name="username" class="form-control mb-3" placeholder="Username" required>
        <input name="password" type="password" class="form-control mb-4" placeholder="Password" required>
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>