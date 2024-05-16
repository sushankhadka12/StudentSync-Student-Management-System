<?php
include 'check_parent.php';
include 'active.php';
include 'db_connection.php';
include 'Header_Parent.php';
include 'menu_parent.php';
$iid=$_SESSION['user_id'];

$sql = "SELECT at.at_id, at.class_id, at.student_id, at.date_time, at.status, at.teacher_id, 
at.subject_id, at.period, at.created_at,
parent.parent_id, parent.first_name AS parent_first_name, parent.last_name AS parent_last_name, 
parent.phone_number AS parent_phone_number, parent.email_address AS parent_email_address,
student.first_name AS student_first_name, student.last_name AS student_last_name, 
student.date_of_birth, student.address, student.phone_number AS student_phone_number, 
student.email_address AS student_email_address
FROM at
INNER JOIN student ON at.student_id = student.student_id
INNER JOIN parent ON student.parent_id = parent.parent_id
where parent.parent_id='$iid'
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='center'>";
    echo "<table class='attendance-table'>";
    echo "<tr><th>Class ID</th><th>Student ID</th><th>Date Time</th><th>Status</th><th>Period</th></tr>";
    while($row = $result->fetch_assoc()) {
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
    echo "0 results";
}

$conn->close();
?>
