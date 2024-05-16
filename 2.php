<?php
include 'db_connection.php';
include 'check.php';
include 'active.php';
include 'Header.php';
include 'menu_teacher.php';

$teacher_id = '';
if(isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];
}

$attendance_date = date('Y-m-d');
$class_id = '';
if(isset($_POST['attendance_date'])) {
    $attendance_date = $_POST['attendance_date'];
}
if(isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
}

$sql_teachers = "SELECT DISTINCT teacher_id FROM at";
$result_teachers = $conn->query($sql_teachers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
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
    </style>
</head>
<body>
    <h2>View Attendance</h2>
    <form method="post">
        <label for="teacher_id">Select Teacher ID:</label>
        <select id="teacher_id" name="teacher_id">
            <?php
            while($row = $result_teachers->fetch_assoc()) {
                $selected = ($row['teacher_id'] == $teacher_id) ? 'selected' : '';
                echo "<option value='{$row['teacher_id']}' $selected>{$row['teacher_id']}</option>";
            }
            ?>
        </select>
        <br>
        <label for="attendance_date">Select Date:</label>
        <input type="date" id="attendance_date" name="attendance_date" value="<?php echo $attendance_date; ?>">
        <br>
        <label for="class_id">Select Class ID:</label>
        <select id="class_id" name="class_id">
            <?php
            // Populate class_id options based on teacher_id
            $sql_classes = "SELECT DISTINCT class_id FROM at WHERE teacher_id = '$teacher_id'";
            $result_classes = $conn->query($sql_classes);
            while($row = $result_classes->fetch_assoc()) {
                $selected = ($row['class_id'] == $class_id) ? 'selected' : '';
                echo "<option value='{$row['class_id']}' $selected>{$row['class_id']}</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="View Attendance">
    </form>

    <h3>Search Attendance by Student ID</h3>
    <form method="post">
        <label for="student_id">Enter Student ID:</label>
        <input type="text" id="student_id" name="student_id">
        <button type="submit">Search</button>
    </form>
    
    <?php
    if(isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
        
        $sql_search = "SELECT * FROM at WHERE student_id = '$student_id'";
        $result_search = $conn->query($sql_search);

        if ($result_search->num_rows > 0) {
            echo "<h2>Attendance for Student ID: $student_id</h2>";
            echo "<div class='center'>";
            echo "<table class='attendance-table'>";
            echo "<tr><th>Class ID</th><th>Student ID</th><th>Date Time</th><th>Status</th><th>Period</th></tr>";

            while($row = $result_search->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["class_id"] . "</td>";
                echo "<td>" . $row["student_id"] . "</td>";
                echo "<td>" . $row["date_time"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>" . $row["period"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "No attendance records found for Student ID: $student_id.";
        }
    }
    ?>

</body>
</html>
