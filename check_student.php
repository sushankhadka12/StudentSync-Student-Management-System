<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ((!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) || ($_SESSION['role'] !== 'student')) {
    if (isset($_SESSION['loggedin'])) {
        session_unset();
        session_destroy();
    }
    header("Location: index.html");
    exit;
}
?>
