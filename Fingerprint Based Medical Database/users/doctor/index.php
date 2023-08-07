<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require "./header.php"; ?>
</head>
<?php 
if(isset($_POST, $_POST['diseases'], $_POST['rbc_count'], $_POST['wbc_count'])){
$patient_id = $_POST['patient_id'];
$diseases = $_POST['diseases'];
$rbc_count = $_POST['rbc_count'];
$wbc_count = $_POST['wbc_count'];
$allergies = $_POST['allergies'];
$blood_group = $_POST['blood_group'];
$advised_tests = $_POST['advised_tests'];
$test_status = $_POST['test_status'];
$symptoms = $_POST['symptoms'];
$diagnosis = $_POST['diagnosis'];
$prescriptions = $_POST['prescriptions'];
$prescribed_medicines = $_POST['prescribed_medicines'];

try{
$stmt = $conn->prepare("INSERT into doctor_reports(patient_id, diseases, rbc_count, wbc_count, allergies, blood_group, advised_tests, test_status, symptoms, diagnosis, prescriptions, prescribed_medicines)
                            VALUES($patient_id, '$diseases', '$rbc_count', '$wbc_count', '$allergies', '$blood_group', '$advised_tests', '$test_status', '$symptoms', '$diagnosis', '$prescriptions', '$prescribed_medicines')");
$stmt->execute();
header("location: index.php");
$_SESSION['success'] = "Data updated successfully";
}catch(Exception $e){
    echo $e;
}
}
?>
<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="body-section">
            <h3>Your appointment</h3>
            <?php
            $user_id = $_SESSION['userInfo']['id'];
            $stmt = $conn->query("SELECT patient_id from appointments WHERE user_id = $user_id ORDER BY created_at DESC");
            $stmt->execute();
            $patientId = $stmt->fetch();
            // echo $patientId['patient_id'] ?? 'null';
            if($stmt->rowCount() < 0){
                echo "No appointments scheduled now!";
            }else {
                $id = $patientId['patient_id']??0;
            $stmt1 = $conn->query("SELECT *, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as age from patient_details WHERE id=$id");
            $stmt1->execute();
            $patientDetails = $stmt1->fetch();
            ?>
            <div class="view-section">
                <?= flashMessages() ?>
                <div class="patient-details">
                    <h4>Patient Details</h4>
                    <div style="position: relative">
                        <img src="../img/defUser.jpeg">
                        <p class="details">
                            <span><?= $patientDetails['fname']??'N/A' ?></span><br><br>
                            <span><?= $patientDetails['address']??'N/A' ?></span><br><br>
                            <span><?= $patientDetails['phone']??'N/A' ?></span><br><br>
                            <span><?= $patientDetails['age']??'N/A' ?></span><br><br>
                            <span><?= $patientDetails['gender']??'N/A' ?></span><br><br>
                            <a style="color: blue; text-decoration: underline;" href="patient-history.php?pid=<?= $patientDetails['id']??0 ?>">View History</a>
                        </p>
                    </div>
                </div>
                <div class="register-details">
                    <form method="POST" action="index.php">
                        <input type="hidden" name="patient_id" value="<?=$patientDetails['id']?>">
                        <input type="text" name="diseases" placeholder="Diseases" required>
                        <input type="text" name="rbc_count" placeholder="RBC Count" required>
                        <input type="text" name="wbc_count" placeholder="WBC Count" required>
                        <input type="text" name="allergies" placeholder="Allergies" required>
                        <input type="text" placeholder="Blood Group" name="blood_group" required>
                        <div class="two-columns">
                            <input type="text" name="advised_tests" placeholder="Advised Tests" required>
                            <select name="test_status" required>
                                <option disabled>--Test Status--</option>
                                <option value="parents">Pending</option>
                                <option value="spouse">Done</option>
                            </select>
                        </div>
                        <div class="two-columns">
                            <input type="text" name="symptoms" placeholder="Symptoms" required>
                            <input type="text" name="diagnosis" placeholder="Diagnosis" required>
                        </div>
                        <div class="two-columns">
                            <input type="text" name="prescriptions" placeholder="Prescriptions" required>
                            <input type="text" name="prescribed_medicines" placeholder="Prescribed Medicines" required>
                        </div>

                        <button type="submit" class="display-block-center">Create New Patient</button>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

    </div>
    <!-- dashboard:wrapper closing -->
    </div>
</body>

</html>