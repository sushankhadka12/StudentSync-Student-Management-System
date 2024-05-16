<?php
include 'db_connection.php';

$username = $_POST['username'];
$password = $_POST['password'];
$passwordhash=md5($password);
$role = $_POST['role'];

//$sql = "SELECT * FROM UserAccount WHERE username = '$username' AND password = '$password' AND role = '$role'";
$sql = "SELECT ua.user_id, ua.username, ur.role,ua.photo_path 
        FROM useraccount ua
        INNER JOIN user_roles ur ON ua.user_id = ur.user_id
        WHERE ua.username = '$username' AND ua.password = '$passwordhash' AND ur.role = '$role'";
$result = $conn->query($sql);

//if ($result->num_rows > 0) {
    if (mysqli_num_rows ( $result )> 0) {
    session_start();
    $login=true;
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['photo_path'] = $user['photo_path'];
    $_SESSION['loggedin']=true;

    switch ($role) {
        case 'Admin':
            header("Location: dAdmin.php");
            break;
        case 'Parent':
            header("Location: dParent.php");
            break;
        case 'Teacher':
            header("Location: dTeacher.php");
            break;
        case 'Student':
            header("Location: dStudent.php");
            break;
        
    }
    exit();
} else {
    echo "Invalid username, password, or role. Please try again.";
}

$conn->close();
?>
