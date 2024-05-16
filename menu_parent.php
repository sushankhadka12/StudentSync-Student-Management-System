<?php
include 'check_parent.php';
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
                        <a href="dParent.php" class="menuitem">Home</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                        <a href="view_parent_attandance.php" class="menuitem">View Attendance</a>

                        </td>
                    </tr>
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
