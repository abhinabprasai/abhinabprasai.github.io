<?php
session_start();

require "../pdo.php";
require "../utils.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "ADMIN") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../../login.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Responder CRUD</title>
    <style>
        .container{
            width: 80%;
            position: absolute;;
            top: 10;
            left: 12%;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <?=include "../navbar.php"?>

    <div class="container">
        <div class="tab">
            <a href="index.php"><button class="tablinks">Reports</button></a>
            <a href="injuries.php"><button class="tablinks">Injuries</button></a>
        </div>
        <div>
            <h2>Reports</h2>
        </div>
    </div>

    
</body>

</html>