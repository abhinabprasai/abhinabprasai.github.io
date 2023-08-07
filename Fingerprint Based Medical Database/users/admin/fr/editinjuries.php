<?php
session_start();

require "../utils.php";
require "../pdo.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "ADMIN") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../../login.php");
}

if(isset($_POST, $_POST['title'], $_POST['updateKey']) && !empty($_POST['title']) && !empty($_POST['id'])){
    $id = $_POST['id'];
    $title = validate($_POST['title']);

    $query = "UPDATE `injuries` SET `title` = :title WHERE `id` = :id";
    $stmt = $conn->prepare($query);
    try {
        $stmt->execute(array(
            ':title' => $title,
            ':id' => $id
        ));
        $_SESSION['success'] = "Successfully updated!";
        header("location: injuries.php");
        exit;
    } catch (PDOException $e) {
        //throw $th;
        $_SESSION['error'] = "Error Occured during update!";
        header("location: injuries.php");
        exit;
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CRUD</title>
    <style>
        .container {
            width: 80%;
            position: absolute;
            ;
            top: 10;
            left: 12%;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <?= include "../navbar.php" ?>

    <div class="container">
        <div class="tab">
            <a href="index.php"><button class="tablinks">Reports</button></a>
            <a href="injuries.php"><button class="tablinks">Injuries</button></a>
        </div>
        <div>
            <h2>Edit Injury</h2>
            <?= flashMessages(); ?>
            <?php
            if (isset($_POST, $_POST['editKey'])) {


            ?>
                <form action="editinjuries.php" method="post">
                    <input type="hidden" name="id" value="<?=$_POST['id']??''?>">
                    <input type="text" id="title" name="title" placeholder="Title" value="<?=$_POST['title']??''?>">
                    <br><br>
                    <input type="submit" name="updateKey" value="Update">
                    <a href="./injuries.php">Back</a>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>