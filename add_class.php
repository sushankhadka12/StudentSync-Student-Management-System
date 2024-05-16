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
    $className = $_POST['className'];
   // $yearLevel = $_POST['yearLevel'];

    $sql = "INSERT INTO Class (name) VALUES ('$className')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Class added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
