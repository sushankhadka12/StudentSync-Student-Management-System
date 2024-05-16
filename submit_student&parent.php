<?php
include 'db_connection.php';
include 'check_teacher.php';
include 'active.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    //$department = $_POST['department'];
    $class_id = $_POST['class_id'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $fatherFirstName = $_POST['fatherFirstName'];
    $fatherLastName = $_POST['fatherLastName'];
    $fatherAddress = $_POST['fatherAddress'];
    $fatherEmail = $_POST['fatherEmail'];
    $fatherPhone = $_POST['fatherPhone'];

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
            $insertUserSql = "INSERT INTO `useraccount`(`user_id`, `username`, `password`) VALUES ('$parent_id','$pusername', '$ppassword')";
            $insertUserRoleSql = "INSERT INTO user_roles (user_id, role) VALUES ('$parent_id', 'parent')";
            $insertUserSql1 = "INSERT INTO `useraccount`(`user_id`, `username`, `password`) VALUES ('$student_id','$username', '$password')";
            $insertUserRoleSql1 = "INSERT INTO user_roles (user_id, role) VALUES ('$student_id', 'student')";
        
            if ($conn->query($insertUserSql) === TRUE && $conn->query($insertUserRoleSql) === TRUE&&  $conn->query($insertUserSql1) === TRUE && $conn->query($insertUserRoleSql1) === TRUE) {
                echo "Parent added successfully";
                echo "<br>";
                echo "Parent UserName:$pusername";
                echo "<br>";
                echo "Parent UserName:$ppassword";
                echo "<br>";
                echo "Student UserName:$username";
                echo "<br>";
                echo "Student UserName:$password";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error inserting student data: " . $conn->error;
        }
    } else {
        echo "Error inserting parent data: " . $conn->error;
    }
}

$conn->close();
?>
