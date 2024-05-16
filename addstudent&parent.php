<?php
include 'check_admin.php';
include 'active.php';
include 'db_connection.php';
include 'Header.php';
include 'menu.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details Form</title>
    <link rel="stylesheet" href="addstudent&teacher.css">
</head>
<body>

    <form  method="post" enctype="multipart/form-data">
        <div class="form-container">
            <h2>Student Details</h2>
            <div class="form-group">
              <label for="studentPhoto">Student's Photo:</label>
              <input type="file" id="studentPhoto" name="studentPhoto" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter first name" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter last name" required>
            </div>

            <div class="form-group">
                <label for="dateOfBirth">Date of Birth:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" required>
            </div>

            <div class="form-group">
                <label for="subjectDropdown">Class:</label>
                <select id="subjectDropdown" name="class_id" required>
                    <?php
                        
                        $classQuery = "SELECT class_id, name FROM class";
                        $result = $conn->query($classQuery);

                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['class_id'] . "'>" . $row['name'] . "</option>";
                        }

                        
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter address" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required>
            </div>
           

            <h2>Parent Details (Father)</h2>
            <div class="form-group">
                 <label for="parentPhoto">Parent's Photo:</label>
                 <input type="file" id="parentPhoto" name="parentPhoto" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="fatherFirstName">Father's First Name:</label>
                <input type="text" id="fatherFirstName" name="fatherFirstName" placeholder="Enter father's first name" required>
            </div>

            <div class="form-group">
                <label for="fatherLastName">Father's Last Name:</label>
                <input type="text" id="fatherLastName" name="fatherLastName" placeholder="Enter father's last name" required>
            </div>

            <div class="form-group">
                <label for="fatherAddress">Father's Address:</label>
                <input type="text" id="fatherAddress" name="fatherAddress" placeholder="Enter father's address" required>
            </div>

            <div class="form-group">
                <label for="fatherEmail">Father's Email:</label>
                <input type="email" id="fatherEmail" name="fatherEmail" placeholder="Enter father's email" required>
            </div>

            <div class="form-group">
                <label for="fatherPhone">Father's Phone Number:</label>
                <input type="tel" id="fatherPhone" name="fatherPhone" placeholder="Enter father's phone number" required>
            </div>
           
            

            <button type="submit">Submit</button>
            <br>

            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $class_id = $_POST['class_id'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $fatherFirstName = $_POST['fatherFirstName'];
    $fatherLastName = $_POST['fatherLastName'];
    $fatherAddress = $_POST['fatherAddress'];
    $fatherEmail = $_POST['fatherEmail'];
    $fatherPhone = $_POST['fatherPhone'];

    if (isset($_FILES['parentPhoto']) && isset($_FILES['studentPhoto'])) {
        $parentPhoto = $_FILES['parentPhoto'];
        $studentPhoto = $_FILES['studentPhoto'];

        $studentSql = "SELECT student_id FROM student ORDER BY student_id DESC LIMIT 1";
        $result = $conn->query($studentSql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastStudentId = $row["student_id"];
            $numericPart = (int)substr($lastStudentId, 8);
            $numericPart++;
            $student_id = "Student-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
        } else {
            $student_id = "Student-001";
        }

        $parentSql = "SELECT parent_id FROM parent ORDER BY parent_id DESC LIMIT 1";
        $result1 = $conn->query($parentSql);
        if ($result1->num_rows > 0) {
            $row = $result1->fetch_assoc();
            $lastParentId = $row["parent_id"];
            $numericPart = (int)substr($lastParentId, 8);
            $numericPart++;
            $parent_id = "Parent-" . str_pad($numericPart, 3, '0', STR_PAD_LEFT);
        } else {
            $parent_id = "Parent-001";
        }

        $sqlParent = "INSERT INTO `parent`(`parent_id`, `first_name`, `last_name`, `phone_number`, `email_address`)
                      VALUES ('$parent_id','$fatherFirstName', '$fatherLastName', '$fatherPhone', '$fatherEmail')";

        if ($conn->query($sqlParent) === TRUE) {
            $sqlStudent = "INSERT INTO `student`(`student_id`, `first_name`, `last_name`, `date_of_birth`, `address`, `phone_number`, `email_address`, `parent_id`, `class_id`)
            VALUES ('$student_id','$firstName', '$lastName', '$dateOfBirth', '$address', '$email', '$phone', '$parent_id', '$class_id')";

            if ($conn->query($sqlStudent) === TRUE) {
                echo "Successfully added student and parent data.";
                $pusername = $fatherFirstName . $parent_id;
                $ppassword = $parent_id . $fatherLastName;
                $username = $firstName . $student_id;
                $password = $student_id . $lastName;
                $parentPhotoDir = "uploads/parent/";
                $studentPhotoDir = "uploads/student/";
                $parentPhotoPath = $parentPhotoDir . $parent_id . "_" . basename($parentPhoto['name']);
                $studentPhotoPath = $studentPhotoDir . $student_id . "_" . basename($studentPhoto['name']);

                $ppasswordhash = md5($ppassword);
                $passwordhash = md5($password);
                
                if (move_uploaded_file($parentPhoto['tmp_name'], $parentPhotoPath) && move_uploaded_file($studentPhoto['tmp_name'], $studentPhotoPath)) {
                    echo "Photos uploaded successfully.";
                    $insertUserSql = "INSERT INTO `useraccount`(`user_id`, `username`, `password`,`photo_path`) VALUES ('$parent_id','$pusername', '$ppasswordhash','$parentPhotoPath')";
                    $insertUserRoleSql = "INSERT INTO user_roles (user_id, role) VALUES ('$parent_id', 'parent')";
                    $insertUserSql1 = "INSERT INTO `useraccount`(`user_id`, `username`, `password`,`photo_path`) VALUES ('$student_id','$username', '$passwordhash','$studentPhotoPath')";
                    $insertUserRoleSql1 = "INSERT INTO user_roles (user_id, role) VALUES ('$student_id', 'student')";

                    if ($conn->query($insertUserSql) === TRUE && $conn->query($insertUserRoleSql) === TRUE && $conn->query($insertUserSql1) === TRUE && $conn->query($insertUserRoleSql1) === TRUE) {
                        echo "Parent added successfully";
                        echo "<br>";
                        echo "Parent UserName:$pusername";
                        echo "<br>";
                        echo "Parent Password:$ppassword";
                        echo "<br>";
                        echo "Student UserName:$username";
                        echo "<br>";
                        echo "Student UserName:$password";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error uploading photos.";
                }
            } else {
                echo "Error inserting student data: " . $conn->error;
            }
        } else {
            echo "Error inserting parent data: " . $conn->error;
        }
    } else {
        echo "Error: File uploads not found.";
    }
}

$conn->close();
?>
            
        </div>
    </form>

</body>
</html>
