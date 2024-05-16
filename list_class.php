<?php
include 'db_connection.php';
include 'check_teacher.php';
include 'active.php';
include 'Header_Teacher.php';
include 'menu_teacher.php';
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
        .attendance-table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
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
    <?php
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM class";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='process_attendance.php' method='post'>";
        echo "<table class='attendance-table'>";
        echo "<tr><th>ID</th><th>Name</th><th>Action</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["class_id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td><button type='submit' name='class_id' value='" . $row["class_id"] . "'>Take Attendance</button></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</body>
</html>
