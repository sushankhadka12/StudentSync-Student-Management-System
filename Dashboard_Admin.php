<?php
include 'check.php';
include 'active.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_styles_Dashboard.css">
</head>

<body>
    <div class="main">
        <div class="first"><a href ="logout.php"> Log Out</a> <br><?php 
        echo "Welcome ".$_SESSION['username'];
        ?></div>
        <div class="second">
            <div id="left">
                <table class="mainmenu">
                    <tr>
                        <td>
                            <a href="Add_teacher_main.php" target="rightframe" class="menu-item">Add Teacher</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="addstudent&parent.php" target="rightframe" class="menu-item">Add Student And Parent</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="addsub.html" target="rightframe" class="menu-item">Add Subject</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="addclass.html" target="rightframe" class="menu-item">Add Class</a>
                        </td>
                    </tr>
                    <!--<tr>
                        <td>
                            <a href="add_department.html" target="rightframe" class="menu-item">Add Department</a>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            <a href="#" class="menu-item">View Attendance</a>
                        </td>
                    </tr>
                   <!-- <tr>
                        <td>
                            <a href="#" class="menu-item">Send Message</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="manage_users.php" target="rightframe" class="menu-item">Manage Users</a>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            <a href="logout.php" class ="menu-item">Log Out</a>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="right">
                <iframe name="rightframe" id="rightframe" width="100%" height="100%"></iframe>
            </div>
        </div>
        <div class="third">Footer</div>
    </div>
</body>
<!--dashboard student sync-->
</html>
