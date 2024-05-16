<?php
include 'check_admin.php';
include 'active.php';
include 'db_connection.php';
include 'menu.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
    <link rel="stylesheet" href="addteacher.css">
</head>
<body>

    <form  method="post" enctype="multipart/form-data">
        <div class="form-container">
            <h2>Add Teacher</h2>

            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter first name" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter last name" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <select id="subject" name="subject" required>
                    <?php
                     
                        $subjectQuery = "SELECT subject_id, name FROM subject";
                        $result = $conn->query($subjectQuery);

                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['subject_id'] . "'>" . $row['name'] . "</option>";
                        }

                    ?>
                </select>
            </div>
            <div class="form-group">
                 <label for="teacherPhoto">Teacher's Photo:</label>
                 <input type="file" id="teacherPhoto" name="teacherPhoto" accept="image/*" required>
            </div>

            <button type="submit">Add Teacher</button>
            <br>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $subjectId = $_POST['subject'];

                if (isset($_FILES['teacherPhoto'])) {
                    $teacherPhoto = $_FILES['teacherPhoto'];
                    $teacherPhotoDir = "uploads/teacher/";
                    

                   
                        $getLastTeacherIdSql = "SELECT teacher_id FROM teacher ORDER BY teacher_id DESC LIMIT 1";
                        $result = $conn->query($getLastTeacherIdSql);
                        
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $lastTeacherId = $row["teacher_id"];
                            $numericPart = (int)substr($lastTeacherId, 8);
                            $numericPart++;
                            $newTeacherId = "TEACHER-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
                        } else {
                            $newTeacherId = "TEACHER-001";
                        }

                        $username = $firstName . $newTeacherId;
                        $password = $newTeacherId . $lastName;
                        $passwordhash = md5($password);
                        $teacherPhotoPath = $teacherPhotoDir.$newTeacherId . basename($teacherPhoto['name']);
                        if (move_uploaded_file($teacherPhoto['tmp_name'], $teacherPhotoPath)) {
                        $sql = "INSERT INTO teacher (teacher_id, first_name, last_name, subject_id) VALUES ('$newTeacherId', '$firstName', '$lastName', '$subjectId')";
                        $insertUserSql = "INSERT INTO `useraccount`(`user_id`, `username`, `password`, `photo_path`) VALUES ('$newTeacherId','$username', '$passwordhash', '$teacherPhotoPath')";
                        $insertUserRoleSql = "INSERT INTO user_roles (user_id, role) VALUES ('$newTeacherId', 'teacher')";
                        
                        if ($conn->query($sql) === TRUE && $conn->query($insertUserSql) === TRUE && $conn->query($insertUserRoleSql) === TRUE) {
                            echo "Teacher added successfully";
                            echo "<br>";
                            echo "Teacher UserName: $username";
                            echo "<br>";
                            echo "Teacher Password: $password";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Failed to upload photo.";
                    }
                } else {
                    echo "No photo uploaded.";
                }
            }

            $conn->close();
            ?>
        </div>
    </form>

</body>
</html>
