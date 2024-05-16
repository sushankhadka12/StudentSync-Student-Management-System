<?php
include 'db_connection.php';
include 'check_teacher.php';
include 'active.php';
include 'Header_Teacher.php';
include 'menu_teacher.php';

$currentDateTime = date('Y-m-d H:i:s');
$timee = date('Y-m-d');
$teacher_id = $_SESSION['user_id'];

function determinePeriod($conn, $timee) {
    $sql_check = "SELECT MAX(period) AS max_period FROM at WHERE date(date_time) = '$timee'";
    $result_check = $conn->query($sql_check);
    
    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        $max_period = $row['max_period'];
        return $max_period + 1;
    } else {
        return 1; 
    }
}

$period = determinePeriod($conn, $timee);

if (isset($_POST['submit1'])) {
    $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : null;
    
    if (isset($_POST['attendance']) && is_array($_POST['attendance'])) {
        
        foreach ($_POST['attendance'] as $student_id => $status) {
            $sql = "INSERT INTO at (class_id, student_id, date_time, status, teacher_id, period) 
                    VALUES ('$class_id', '$student_id', '$currentDateTime', '$status', '$teacher_id', '$period')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        echo "Attendance saved successfully at $currentDateTime.";
    } else {
        echo "No attendance data submitted.";
    }
} else {
    $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : null;
    $sql = "SELECT 
    s.*, 
    ua.*
FROM 
    student s
INNER JOIN 
    useraccount ua ON s.student_id = ua.user_id
WHERE 
    s.class_id = '$class_id';
";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form  method='post'>";
        echo "<input type='hidden' name='class_id' value='$class_id'>";
        echo "<div class='center'>";
        echo "<table class='attendance-table'>";
        echo "<tr><th></th><th>Student ID</th><th>Name</th><th>Attendance</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='" . $row["photo_path"] . "' alt='Student Photo' style='width:50px; height:50px;'></td>";

            echo "<td>" . $row["student_id"] . "</td>";
            echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
            echo "<td>";
            echo "<input type='radio' name='attendance[" . $row["student_id"] . "]' value='P' class='bigger-radio'> Present<br><br>";
            echo "<input type='radio' name='attendance[" . $row["student_id"] . "]' value='A' class='bigger-radio'> Absent";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        echo "<input type='submit' name='submit1' value='Submit Attendance'>";
        echo "</form>";
    } else {
        echo "No students found for this class.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .center {
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .attendance-table th, .attendance-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .attendance-table th {
            background-color: #f2f2f2;
        }

        .attendance-table button {
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .attendance-table button:hover {
            background-color: #45a049;
        }
        .bigger-radio {
    transform: scale(1.5);
}

    </style>
</head>
<body>
</body>
</html>
