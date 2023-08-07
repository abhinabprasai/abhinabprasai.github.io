<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require "./header.php"; ?>
</head>
<?php
if(isset($_POST) && @$_POST['fname']){
// if (isset($_POST['fname'], $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['relation'], $_POST['gender'])) {
    // echo "in";exit;
    $fname = $_POST['fname'];
    $phone = $_POST['phone']??null;
    $dob = $_POST['dob']??null;
    $address = $_POST['address']??null;
    $email = $_POST['email']??null;
    $ephone = $_POST['ephone']??null;
    $relation = $_POST['relation']??null;
    $gender = $_POST['gender']??null;
    $image = "";

    $phone_pattern = "/^9[0-9]{9}$/";

    if(!preg_match($phone_pattern, $phone) || !preg_match($phone_pattern, $ephone)){
        $_SESSION['error'] = "Invalid contact number!";
        header('location: register.php');
        exit;
    }

    if (isset($_FILES['dp'])) { //If block to be commented out if any error occurs
        $dir = "../uploads/";
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
        $target_file = $dir . basename($_FILES["dp"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // echo $target_file. " ". $imageFileType; exit;
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
            $_SESSION['error'] = "[400] File type not allowed!";
            header("location: register.php");
            exit;
        }

        if (!move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
            $_SESSION['error'] = "[400] File not uploaded!";
            header("location: register.php");
            exit;
        }

        //If any error occurs please move the block i.e. line 34-42 out of the this if statement and comment out the if statement for $_FILES
        //Delete the image=:image if error occurs
        $image =  $_FILES['dp']['name'];
    }
    else{
        $image = "defUser.jpeg";
    }
    try{
    $stmt1 = $conn->prepare("UPDATE patient_details SET fname='$fname', address='$address', email='$email', phone='$phone', ephone='$ephone', relation='$relation', gender='$gender', dob='$dob', dp='$image' WHERE id=" . $_SESSION['id']);
    $stmt1->execute();
    unset($_SESSION['id']);
    header("location: index.php");
    exit;
    }catch(Exception $e){
        echo $e;
    }
}
else{
    // debug($_POST);
    // print_r($_POST);
}

if(isset($_POST, $_POST['redirect'])){
    header("location: register.php");
    exit;
}

$stmt = $conn->prepare("SELECT * from patient_details WHERE fname IS NULL");
$stmt->execute();
$rowCount = $stmt->rowCount();
$emptyData = $stmt->fetch();
?>
<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        
        ?>
        <div class="body-section">
            <?php 
            if ($rowCount > 0) {
                $_SESSION['id'] = $emptyData['id'];
                // echo "<script>alert('Continue?')</script>";
            ?>
            <div class="register-details">
                <h3>Patient Form</h3>
                <?=flashMessages()?>
                <form method="POST" action="register.php" enctype="multipart/form-data">
                    <input type="text" name="fname" placeholder="Full Name" required>
                    <input type="text" name="address" placeholder="Address" required>
                    <input type="number" name="phone" placeholder="Phone Number" required>
                    <input type="email" name="email" placeholder="Email Address" required>
                    <div class="two-columns">
                        <input type="number" name="ephone" placeholder="Emergency Contact Number" required>
                        <select name="relation" required>
                            <option disabled>--Relation--</option>
                            <option value="parents">Parents</option>
                            <option value="spouse">Spouse</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                        </select>
                    </div>
                    <div class="two-columns">
                        <select name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                        
                        DOB: <input type="date" name="date" required>
                    </div>

                    <input class="image-upload" type="file" name="dp" required>

                    <button type="submit" class="display-block-center">Create New Patient</button>
                </form>
            </div>
            <?php
        }
        else{
        ?>  
            <div class="fingerprint-registering">
                <h3>Fingerprint registering...</h3>
                <img src="../img/spinner.gif">
                <p>Kindly refresh the page after few minutes!</p>
                <form method="POST" action="register.php">
                    <button class="submit" name="redirect"> 
                        Reload
                    </button>
                </form>
            </div>
        <?php
        }
        ?>
        </div>
    
        <!-- div:dashboard-wrapper closing -->
    </div>
    </div>

</body>

</html>