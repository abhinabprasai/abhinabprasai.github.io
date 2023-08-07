<?php 

session_start();

require "./utils.php";
require "./pdo.php";

// debug($_SESSION['userInfo']);exit;
if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "FRESPONDER") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../login.php");
}

?>