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
    <title>Add Subject</title>
    <link rel="stylesheet" href="addsub.css">
</head>
<body>

    <form method="post">
        <div class="form-container">
            <h2>Add Subject</h2>

            <div class="form-group">
                <label for="subjectName">Subject Name:</label>
                <input type="text" id="subjectName" name="subjectName" placeholder="Enter subject name" required>
                <input type="text" id="subjectCode" name="subjectCode" placeholder="Enter subject Code" required>

            </div>

            <button type="submit">Add Subject</button>
            <br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subjectName = $_POST['subjectName'];
    $subjectCode = $_POST['subjectCode'];


    $sql = "INSERT INTO `subject`(`subject_id`, `name`) VALUES ('$subjectCode','$subjectName')";

    if ($conn->query($sql) === TRUE) {
        echo "Subject added successfully";
        echo "<br>";
        echo "Subject Name:$subjectName ";
        echo "<br>";
        echo "Subject Code:$subjectCode ";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
        </div>
    </form>

</body>
</html>
