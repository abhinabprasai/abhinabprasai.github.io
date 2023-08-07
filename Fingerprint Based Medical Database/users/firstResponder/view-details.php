<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require './header.php'; ?>
</head>
<?php
if (isset($_POST, $_POST['redirect'])) {
    header("location: view-details.php");
    exit;
}

if(isset($_POST, $_POST['location'], $_POST['description'], $_POST['incident_cause'])){
    $location = $_POST['location'];
    $description = $_POST['description'];
    $incident_cause = $_POST['incident_cause'];
    $patientId = $_POST['patient_id']??null;
    $user_id = $_SESSION['userInfo']['id'];
    $image = "";
    
    if(isset($_FILES['image'])){
        $dir = "../uploads/";
        if(!is_dir($dir)){
            mkdir($dir, 0777);
        }
        $target_file = $dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "gif" && $imageFileType!= "jpeg"){
            $_SESSION['error'] = "[400] File type not allowed!";
            header("location: view-details.php");
            exit;
        }
        
        if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
            $_SESSION['error'] = "[400] File not uploaded!";
            header("location: view-details.php");
            exit;
        }
        $image = $_FILES['image']['name'];
    }else {
        $image = "defUser.jpeg";
    }

    try {
        $stmt = $conn->prepare("INSERT into fresponder_reports(location, incident_cause, description, image, patient_id, user_id) VALUES(:location, :incident_cause, :description, :image, :patient_id, :user_id)");
        $stmt->execute([
            'location' => $location,
            'incident_cause' => $incident_cause,
            'description' => $description, 
            'image' => $image,
            'patient_id' => $patientId,
            'user_id' => $user_id,
        ]);
    } catch (Exception $e) {
        $_SESSION['error'] = $e;
        header("location: view-details.php");
        exit;
    }
}

$stmt = $conn->query("SELECT fid from retrieve_fingerprint");
$stmt->execute();
$fid = $stmt->fetch();

?>


<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="body-section">
            <h3>Accidental Details</h3>

            <?php
            flashMessages();
            if (!isset($fid[0])) {
            ?>
                <div class="fingerprint-registering">
                    <h3>Fetching Details...</h3>
                    <img src="../img/spinner.gif">
                    <p>Kindly refresh the page after few minutes!</p>
                    <form method="POST" action="view-details.php">
                        <button class="submit" name="redirect">
                            Reload
                        </button>
                    </form>
                </div>
            <?php
            } else {
            ?>
                <?php
                $stmt = $conn->query("SELECT *, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as age from patient_details WHERE fingerprint_id =" . $fid[0]);
                $stmt->execute();
                $patientDetails = $stmt->fetch();

                if ($stmt->rowCount() <= 0) {
            flashMessages();

                ?>
                    <div class="patient-form">
                        <form method="POST" action="view-details.php" enctype="multipart/form-data">
                            <input type="text" name="location" placeholder="Location" required><br>
                            <input type="text" name="incident_cause" placeholder="Incident Cause" required><br>
                            <textarea type="text" name="description" placeholder="Description" cols="55" rows="10" required></textarea><br>
                            <input type="file" name="image" class="image-upload"><br>
                            <button type="submit">Add Details</button>
                        </form>
                    </div>
                <?php
                } else {
            flashMessages();

                ?>
                    <div class="view-section">
                        <div class="patient-details">
                            <h4>Patient Details</h4>
                            <div style="position: relative">
                                <img src="../img/defUser.jpeg">
                                <p class="details">
                                    <span><?=$patientDetails['fname']?></span><br><br>
                                    <span><?=$patientDetails['address']?></span><br><br>
                                    <span><?=$patientDetails['phone']?></span><br><br>
                                    <span><?=$patientDetails['age']?></span><br><br>
                                    <span><?=$patientDetails['gender']?></span><br><br>
                                </p>
                            </div>
                            <hr>
                            <div>
                                <?php
                                $id = $patientDetails['id'];
                                $stmt1 = $conn->query("SELECT * from doctor_reports WHERE patient_id=$id ORDER BY created_at desc");
                                $stmt1->execute();
                                $medicalDetails = $stmt1->fetch();
                                // print_r($medicalDetails);
                                ?>
                                <h4>Medical History</h4>
                                <p><b>Blood Group</b>: <?=$medicalDetails['blood_group']??'N/A'?></p>
                                <p><b>RBC Count</b>: <?=$medicalDetails['rbc_count']??'N/A'?></p>
                                <p><b>WBC Count</b>: <?=$medicalDetails['wbc_count']??'N/A'?></p>
                                <p><b>Allergies</b><br>
                                    <span><?=$medicalDetails['allergies']??'N/A'?></span>
                                </p>
                                <p><b>Prescribed Medicines</b><br>
                                    <span><?=$medicalDetails['prescribed_medicines']??'N/A'?></span>
                                </p>
                            </div>
                        </div>
                        <div class="patient-form">
                            <form method="POST" action="view-details.php" enctype="multipart/form-data">
                                <input type="hidden" name="patient_id" value="<?=$patientDetails['id']?>">
                                <input type="text" name="location" placeholder="Location" required><br>
                                <input type="text" name="incident_cause" placeholder="Incident Cause" required><br>
                                <textarea type="text" name="description" placeholder="Description" cols="55" rows="10" required></textarea><br>
                                <input type="file" name="image" class="image-upload"><br>
                                <button type="submit">Add Details</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>

    <!-- Closing for div:dashboard-wrapper -->
    </div>
<?php
            }
?>
</body>

</html>