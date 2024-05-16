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
    <link rel="stylesheet" href="style_teacher_dashboard.css">
</head>

<body>
    <div class="main">
        <div class="first">Header</div>
        <div class="second">
            <div id="left">
                <table class="mainmenu">
                    <tr>
                        <td>
                            <a href="list_class.php" target="rightframe" class="menu-item">Take Attandance</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" class="menu-item">View Attendance</a>
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

</html>
