<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toggle Menu</title>
<style>
  /* Style for the toggle menu */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  .sidebar {
    height: 100%;
    width: 250px; /* Width of the sidebar when it's open */
    position: fixed;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }
  .sidebar a {
    padding: 10px 15px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }
  .sidebar a:hover {
    color: #f1f1f1;
  }
  .openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #111;
    color: white;
    border: none;
    position: fixed;
    top: 10px;
    left: 10px;
  }
  .openbtn:hover {
    background-color: #444;
  }
  #main {
    transition: margin-left .5s;
    padding: 16px;
    margin-left: 250px; /* Adjust margin to accommodate sidebar width */
  }
</style>
</head>
<body>

<div id="sidebar" class="sidebar">
  <a href="c.php">Link 1</a>
  <a href="#">Link 2</a>
  <a href="#">Link 3</a>
  <!-- Add more links as needed -->
</div>

<div id="main">
  <button class="openbtn" onclick="toggleNav()">&#9776; Toggle Menu</button>  
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
