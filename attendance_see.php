<?php
include 'check.php';
include 'active.php';
include 'db_connection.php';
include 'Header.php';
include 'menu.php';

$classId = $_GET['classid'];
$subjectId = $_GET['studentid'];
$date = $_GET['date'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Details</title>
    <style>
    </style>
</head>
<body>
    <h1>Attendance Details</h1>
    
    <div>
        <p>Class ID: <?php echo $classId; ?></p>
        <p>Subject ID: <?php echo $subjectId; ?></p>
        <p>Date: <?php echo $date; ?></p>
    </div>

</body>
</html>
