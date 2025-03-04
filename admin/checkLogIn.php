<?php
    session_start();
    if (!isset($_SESSION['check'])) {
        include('./noAuthorization.php');
        die();
    } 
?>