<?php
include 'check_admin.php';
include 'active.php';
include 'db_connection.php';
include 'menu.php';

$sql_subjects = "SELECT * FROM subject";
$result_subjects = $conn->query($sql_subjects);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class</title>
    <link rel="stylesheet" href="addclass.css">
</head>
<body>

<form method="post">
    <div class="form-container">
        <h2>Add Class</h2>

        <div class="form-group">
           <label for="classID">Class ID:</label>
            <input type="text" id="classID" name="classID" placeholder="Enter class ID" required>
            <label for="className">Class Name:</label>
            <input type="text" id="className" name="className" placeholder="Enter class name" required>
            <label for="classYear">Class Year:</label>
            <input type="Date" id="classYear" name="classYear" placeholder="Enter class Year" required>
            <label for="subjects">Select Subjects:</label>
            <select multiple name="subjects[]" id="subjects" required>
                <?php
                if ($result_subjects->num_rows > 0) {
                    while ($row = $result_subjects->fetch_assoc()) {
                        echo "<option value='" . $row['subject_id'] . "'>" . $row['name'] . "</option>"; 
                    }
                }
                ?>
            </select>
        </div>

        <button type="submit">Add Class</button>
        <br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a = $_POST['classID'];
            $b = $_POST['className'];
            $c = $_POST['classYear'];
            $selectedSubjects = $_POST['subjects'];

            $sql = "INSERT INTO `class`(`class_id`, `name`, `year_level`) VALUES('$a','$b','$c')";
            
        
        
        
            if ($conn->query($sql) === TRUE ) {
                
                echo "Class added successfully";
                echo "<br>";
                echo "Class Id: $a";
                echo "<br>";
                echo "Class Name: $b";
                echo "<br>";
                echo "Class Year: $c";
                echo "<br>";
                echo "Selected Subjects: ";
                foreach ($selectedSubjects as $subject) {
                    $sql1 = "INSERT INTO `class_subject`(`class_id`, `subject_id`) VALUES ('$a','$subject')";
                    if( $conn->query($sql1) === TRUE)
                    {
                        echo $subject . ", ";

                    }
                    else
                    {
                        echo "Error: " . $sql1 . "<br>" . $conn->error;

                    }

                }
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
