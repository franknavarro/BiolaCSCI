<?php
    ob_start();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
include 'resources/library/attendance.php';
attendance::endSession($_SESSION['session_id']);
header("Location: dashboard.php");
exit;
 ?>
