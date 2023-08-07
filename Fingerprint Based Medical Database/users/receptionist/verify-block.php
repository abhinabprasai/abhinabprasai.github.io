<?php
    session_start();
    require "./utils.php";
    require "./pdo.php";

    if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "RECEPTIONIST") {
        $_SESSION['error'] = "[403] Access Denied!";
        unset($_SESSION['userInfo']);
        header("location: ../../login.php");
    }
?>