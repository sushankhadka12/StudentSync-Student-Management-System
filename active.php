<?php
date_default_timezone_set('Asia/Kathmandu');


$session_timeout = 300;

if (isset($_SESSION['last_activity'])) {
    $inactive_time = time() - $_SESSION['last_activity'];
    
    if ($inactive_time > $session_timeout) {
        session_unset();
        session_destroy();
        header("Location: index.html");
        exit;
    }
}
$_SESSION['last_activity'] = time();

?>
