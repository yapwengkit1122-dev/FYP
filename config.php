<?php
$host = "localhost";
$port = "3306";
$dbname = "attendance_system";
$dbuser = "YOUR_DB_USER";
$dbpass = "YOUR_DB_PASSWORD";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$conn = new mysqli("localhost", "root", "pwd123", "attendance_system");
if ($conn->connect_error) {
    die("DB Connection failed");
}
?>
