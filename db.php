<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'budget_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("連線失敗：" . $conn->connect_error);
}
?>
