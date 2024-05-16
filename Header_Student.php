<?php
include 'check_student.php';
include 'active.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="header.css">
</head>
<body>

<header>
    <div class="profile-picture">
        
    </div>
    <div class=p>
        <h1 class="header-logo">STUDENTSYNC</h1>
        <p class="header-title">Efficiently Manage Students' Data</p>
        <p class="header-subtitle">Empowering Educational Institutions</p>
    </div>
    <div class="user-info">
        <?php 
         $photo=$_SESSION['photo_path'];
         echo "<img src='$photo' alt='Profile Picture'>";
        $username=$_SESSION['username'];
        echo "<span class='welcome-message'>Welcome, $username</span>";
        ?>
    </div>
</header>
