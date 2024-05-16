<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form">
<form  class="formr" method="post">
    <h2>Login</h2>
    <p>Username: <input type="text" name="username" required></p>
    <p>New Password: <input type="Password" name="Password" required></p>
    <input type="submit" class="submit" value="Change"><br>
    
    <?php
        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['Password'];
            $p =md5($password);

            $sql = "SELECT * FROM useraccount WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $sql1 = "UPDATE useraccount SET password = '$p' WHERE username = '$username'";
                $result1 = $conn->query($sql1);
                if ($result1) {
                    echo "Password updated successfully.";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "Username '$username' not found.";
            }
        }
    ?>

   
</form>
</div>

</body>
</html>
