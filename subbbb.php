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
    $subjectName = $_POST['subjectName'];

    $sql = "INSERT INTO Subject (name) VALUES ('$subjectName')";

    if ($conn->query($sql) === TRUE) {
        echo "Subject added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
