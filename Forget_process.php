<?php
include 'db_connection.php';

$username = $_POST['username'];
$password = $_POST['Password'];

$sql = "SELECT * FROM useraccount WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql1 = "UPDATE useraccount SET password = '$password' WHERE username = '$username'";
    $result1 = $conn->query($sql1);
    if ($result1) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "Username '$username' not found.";
}

?>
