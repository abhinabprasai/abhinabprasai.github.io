<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require "./header.php"; ?>
</head>
<?php
$sql = "SELECT * from users WHERE role!='ADMIN'";


if (isset($_POST, $_POST['search'], $_POST['search-role'])) {
    $fname = $_POST['search'];
    $role = $_POST['search-role'];
    $sql = "SELECT * from users WHERE name LIKE '%$fname%' AND role='$role' AND role!='ADMIN'";
}

if (isset($_POST, $_POST['search'])) {
    $s = $_POST['search'];
    $sql = "SELECT * FROM users WHERE name LIKE '%$s%' AND role!='ADMIN'";
}

if (isset($_POST, $_POST['search-role'])) {
    $s = $_POST['search-role'];
    $sql = "SELECT * FROM users WHERE role LIKE '%$s%' AND role!='ADMIN'";
}

if (isset($_POST, $_POST['delete-user'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id=$id");
    $stmt->execute();
    $_SESSION['error'] = "User deleted successfully";
    header('location: users.php');
    exit;
}

if(isset($_POST, $_POST['add-user'])){
    header("location: adduser.php");
    exit;
}

?>

<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="search-bar">
            <form action="users.php" method="POST">
                <input type="text" name="search" size="30" placeholder="Search Patient">
                <select name="search-role" class="search-role">
                    <option disabled selected>--Sort Options--</option>
                    <option value="FRESPONDER">First Responder</option>
                    <option value="DOCTOR">Doctors</option>
                    <option value="RECEPTIONIST">Receptionist</option>
                </select>
                <button type="submit" class="search-button">
                    <img src="../img/search.png">
                </button>
            </form>
        </div>

        <div class="body-section">
            <h3>In-house user details</h3>
            <form action="users.php" method="POST">
                <button type="submit" class="add-button" name="add-user">Add User</button>
            </form>
            <div class="list-wrapper">
                <?php
                $stmt = $conn->query($sql);
                $stmt->execute();
                $userDetails = $stmt->fetchAll();
                ?>

                <div class="list <?php echo $stmt->rowCount() > 5 ? 'list-start-animation' : ''; ?>">
                    <?php
                    flashMessages();
                    if ($stmt->rowCount() > 0) {
                        foreach ($userDetails as $user) {
                    ?>
                            <div class="list-item" style="margin-left: 2rem;">
                                <div style="width: 15rem;"><?= $user['name'] ?></div>
                                <div style="width: 18rem;"><?= $user['email'] ?></div>
                                <div style="width: 15rem;"><?= ucfirst(strtolower($user['role'])) ?></div>
                                <div>
                                    <form action="users.php" method="POST">
                                        <input type="hidden" name="id" value="<?=$user['id']?>">
                                        <img class="cursor-pointer" style="height: 15px; vertical-align: middle;" src="../img/delete-icon.png">
                                        <input class="cursor-pointer" style="color: red; border: none; background-color: white;" type="submit" name="delete-user" value="Delete User">
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p style='color: red; text-align: center; font-size: 18px; margin-top: 5rem;'>User not found!</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>