<?php
$servername = "localhost";
$username = "shikshy1_sushan";
$password = "Backup9841";
$dbname = "shikshy1_sk";

$conn = new mysqli($servername, $username, $password, $dbname);
date_default_timezone_set('Asia/Kathmandu');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>