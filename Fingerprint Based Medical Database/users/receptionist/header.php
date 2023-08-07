<?php
session_start();

require "../layouts/sidebar.php" ;
require "../layouts/dashboard.php" ;
require "../pdo.php";
require "../utils.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "RECEPTIONIST") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../login.php");
    exit;
}

$links = [
    [
        'title' => 'dashboard',
        'link' => 'index.php',
    ],
    
    [
        'title' => 'new patient',
        'link' => 'enroll.php',
    ],


];
?>
<link rel="stylesheet" type="text/css" href="../../css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<title>Receptionist Panel</title>