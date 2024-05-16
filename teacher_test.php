<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "StudentSync";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $subjectId = $_POST['subject']; // Updated from 'subjectId'
    
    // Retrieve the last teacher ID
    $getLastTeacherIdSql = "SELECT teacher_id FROM Teacher ORDER BY teacher_id DESC LIMIT 1";
    $result = $conn->query($getLastTeacherIdSql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastTeacherId = $row["teacher_id"];
        // Extract the numeric part
        $numericPart = (int)substr($lastTeacherId, 8); // Extract numeric part after 'TEACHER-'
        // Increment the numeric part
        $numericPart++;
        // Generate the new teacher ID
        $newTeacherId = "TEACHER-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
    } else {
        // If no teacher exists, start from TEACHER-001
        $newTeacherId = "TEACHER-001";
    }

    // Insert the new teacher record into the database
    $sql = "INSERT INTO Teacher (teacher_id, first_name, last_name, subject_id) VALUES ('$newTeacherId', '$firstName', '$lastName', '$subjectId')";

    if ($conn->query($sql) === TRUE) {
        echo "Teacher added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
