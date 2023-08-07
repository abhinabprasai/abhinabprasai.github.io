<?php
session_start();

require "../utils.php";
require "../pdo.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "ADMIN") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../../login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST, $_POST['title'])) {
        $title = validate($_POST['title']);

        $stmt = $conn->prepare("INSERT INTO injuries(title) VALUES(:title)");

        try {
            $stmt->execute(array(':title' => $title));
            $_SESSION['success'] = "Injury was successfully added!";
            header("location: injuries.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Invalid Request";
            header("location: injuries.php");
            exit;
        }
    }

    if (isset($_POST, $_POST['id'], $_POST['delete'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM injuries WHERE id=:id");

        try {
            $stmt->execute(array(':id' => $id));
            $_SESSION['error'] = "Injury was successfully deleted!";
            header("location: injuries.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Invalid Request";
            header("location: injuries.php");
            exit;
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Responder CRUD</title>
    <style>
        .container {
            width: 80%;
            position: absolute;
            ;
            top: 10;
            left: 12%;
        }
      li.actionsList {
        display: inline-block;
        width: 55px;
        font-size: 20px;
        color: #eeeeee;
        position: relative;
        left: -1.3rem;
        top: 1rem;
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
            <h2>Add Injury</h2>
            <?= flashMessages(); ?>
            <form action="injuries.php" method="post">
                <input type="text" id="title" name="title" placeholder="Title">
                <br><br>
                <input type="submit" value="Add">
            </form> <br><br>

            <h2>Injuries List</h2>

            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * from injuries ORDER BY id DESC");
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>$row[id]</td><td>$row[title]</td>";
                ?>
                        <td>
                            <ul>
                                <li class="actionsList">
                                    <form action="editinjuries.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="title" value="<?= $row['title'] ?>">
                                        <input type="submit" name="editKey" value="Edit">
                                    </form>
                                </li>
                                <li class="actionsList">
                                    <form action="injuries.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="delete" value="Delete">
                                    </form>
                                </li>
                            </ul>


                        </td>
                <?php
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan=\"2\">No Records Found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>


</body>

</html>