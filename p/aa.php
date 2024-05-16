<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Left Menu Bar</title>
    <style>
        body, h1, h2, h3, p, ul, li, table {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
        }

        .sidebar {
            position: fixed; /* Set the position to fixed */
            top: 0; /* Stick it to the top */
            left: 0; /* Stick it to the left */
            height: 100%; /* Full height */
            width: 200px; /* Set width as per your requirement */
            background-color: #2c3e50; /* Background color */
            padding-top: 20px; /* Add some padding at the top */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Add a shadow */
            z-index: 999; /* Ensure it appears above other content */
            transition: all 0.3s ease; /* Add smooth transition */
            overflow-y: auto; /* Add scrollbar if content overflows */
        }

        .content {
            margin-left: 200px; /* Adjust margin to accommodate the width of the sidebar */
            padding: 20px; /* Add some padding */
        }

        /* Style for menu items */
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .sidebar.collapsed {
            width: 50px; /* Adjust width when collapsed */
        }

        .sidebar.collapsed h2 {
            display: none; /* Hide menu title when collapsed */
        }

        .sidebar.collapsed ul li a {
            padding: 10px 5px; /* Adjust padding when collapsed */
            text-align: center; /* Center align text when collapsed */
        }

        .sidebar.collapsed:hover {
            width: 200px; /* Expand width on hover */
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <h2>Menu</h2>
        <ul>
            <?php
            // Your PHP code to generate menu items dynamically
            // For example:
            $menuItems = array("Home", "About", "Services", "Contact");

            foreach ($menuItems as $item) {
                echo "<li><a href='www.facecook.com' onclick='toggleSidebar()'>$item</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="content">
        <!-- Main content of your website -->
        <h1>Main Content</h1>
        <p>This is the main content of your website.</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>
