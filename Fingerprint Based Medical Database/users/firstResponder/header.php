<?php
session_start();

require "../layouts/sidebar.php" ;
require "../layouts/dashboard.php" ;
require "../pdo.php";
require "../utils.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "FRESPONDER") {
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
        'title' => 'scan patient',
        'link' => 'scan-patient.php',
    ],


];
?>
<link rel="stylesheet" type="text/css" href="../../css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<title>FResponder Panel</title>