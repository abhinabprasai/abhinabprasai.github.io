<?php
session_start();

require "./utils.php";
require "./pdo.php";


if (!isset($_SESSION['userInfo']) && $_SESSION['userInfo']['role'] !== "FRESPONDER") {
    $_SESSION['error'] = "[403] Access Denied!";
    header("location: ../../login.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* $dir = "../uploads";
            if(!is_dir($dir)){
                echo "in";
                mkdir($dir, 0777, true);
            } else{
                echo "not done!";
            }
    echo basename($_FILES['image']['name']);
    debug($_FILES['image']); */
    // debug($_POST);
    if(isset($_POST, $_POST['injuries'], $_POST['condition'], $_POST['desc'])){
        $condition = $_POST['condition'];
        $injuries = $_POST['injuries'];
        $desc = validate($_POST['desc']);
        $lastId = "";
        // echo $condition. " ". $desc; exit;
        if(isset($_FILES['image'])){
            $dir = "../uploads";
            if(!is_dir($dir)){
                mkdir($dir);
            }
            $target_file = $dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // echo $target_file. " ". $imageFileType; exit;
            if($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "gif" && $imageFileType!= "jpeg"){
                $_SESSION['error'] = "[400] File type not allowed!";
                header("location: add-details.php");
                exit;
            }
            // echo $_FILES['image']['tmp_name']. " //". $target_file; 
            // move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            // echo "uploaded"; exit;
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                $_SESSION['error'] = "[400] File not uploaded!";
                header("location: add-details.php");
                exit;
            }

            $stmt = $conn->prepare("INSERT INTO patient_injuries_desc(description, status, image) VALUES(:desc, :status, :image)");
            try {
                $stmt->execute(array(
                    ":desc" => $desc,
                    ":status" => $condition,
                    ":image" => $_FILES['image']['name']
                ));
                $lastId = $conn->lastInsertId();
                // debug($lastId);
            } catch (PDOException $e) {
                //throw $th;
                $_SESSION['error'] = $e; //"Error Occured!";
                header("location: add-details.php");
                exit;
            }
        }
        
        
        $sql = "INSERT into patient_injuries(injury_id, desc_id) VALUES(:injuryId, :descId)";
        $stmt = $conn->prepare($sql);
        
        try {
            //code...
            foreach($injuries as $injury){
                $stmt->execute(array(
                    ":injuryId" => $injury,
                    ":descId" => $lastId
                ));
            }
            $_SESSION['success'] = "Details added Successfully!";
            header('location: add-details.php');
            exit;
        } catch (PDOException $e) {
            //throw $th;
            $_SESSION['error'] = "Error Occured while seeding Database!";
            header("location: add-details.php");
            exit;
        }

        

    }
    else{
        $_SESSION['error'] = "Please fill in the details!";
        header("location: add-details.php");
        exit;
    }
}
?>

<html>

<head>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <?php include "./header.php"; ?>
</head>

<body>
    <?php
    include "./navbar.php";
    ?>
    <div class="area">
        <div class="content">
            <h2>Add Details</h2>
            <?=flashMessages()?>
            <form action="add-details.php" method="post" enctype="multipart/form-data">
                <label for="injury">Injury Type</label><br>
                <?php 
                    $result = $conn->query("SELECT * from injuries");
                    $rows = $result->fetchAll(); 
                    foreach($rows as $row){
                        ?>
                            <input type="checkbox" name="injuries[]" value="<?=$row['id']?>"> <?=$row['title']?> <br>
                        <?php
                    }
                ?>
                <br>
                <label for="condition">Condition</label><br>
                <input type="radio" name="condition" id="condition" value="dead">Dead 
                <input type="radio" name="condition" id="condition" value="unconcious">Unconcious 
                <input type="radio" name="condition" id="condition" value="concious">Concious 
                <br>
                <br>
                <textarea name="desc" id="desc" cols="60" rows="10" placeholder="Comments" required></textarea>
                <br><br>
                Image: <input type="file" name="image">
                <br><br>
                <input type="submit" value="Add">
            </form>
        </div>
    </div>

</body>

</html>