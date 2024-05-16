<?php
include 'check_admin.php';
include 'active.php';

?>
  <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu</title>
<link rel="stylesheet" type="text/css" href="menu.css">
</head>
<body>
<div>

<div>
<div id="sidebar" class="sidebar">
<table>
                      <tr>
                        <td>
                        <a href="dAdmin.php" class="menuitem">Home</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <a href="Add_teacher_main.php" class="menuitem">Add Teacher</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <a href="addstudent&parent.php" class="menuitem">Add Student And Parent</a>

                        </td>
                    </tr>
                    <tr>
                        <td>
                        <a href="addsub.php" class="menuitem">Add Subject</a>
  
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <a href="addclass.php" class="menuitem">Add Class</a>

                        </td>
                    </tr>
                    <!--<tr>
                        <td>
                            <a href="add_department.html" class="menuitem">Add Department</a>

                      </td>
                    </tr>-->
                    <tr>
                        <td>
                        <a href="view_AttandanceAdmin.php" class="menuitem">View Attendance</a>

                        </td>
                    </tr>
                   <!-- <tr>
                        <td>
                          <a href="manage_users.php" class="menuitem">Manage Users</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                        <a href="logout.php" class="menuitem">Log Out</a>
                        </td>
                    </tr>
                </table>
</div>

<div id="main">
  <button class="openbtn" onclick="toggleNav()">&#9776; Menu</button>  
</div>

<script>
function toggleNav() {
  var sidebar = document.getElementById("sidebar");
  if (sidebar.style.width === "250px") {
    sidebar.style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  } else {
    sidebar.style.width = "250px";
    document.getElementById("main").style.marginLeft= "250px";
  }
}
</script>

</body>
</html>
