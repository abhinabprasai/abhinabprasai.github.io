<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "./header.php" ?>
</head>
<?php
if (isset($_POST, $_POST['scan'])) {
    try {
        $stmt = $conn->prepare("UPDATE status SET status =:status");
        $stmt->execute([
            "status" => 2,
        ]);

        header("location: view-details.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = $e;
        header('location: scan-patient.php');
        exit;
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
            <div class="scan-fingerprint">
                <h3>Scan Fingerprint</h3>
                <p>Press the Scan button and ask the patient to press his finger in the sensor, after the sensor has sent the ID, <span style="color: #353535;">press reload</span>.</p>
                <?php if (isset($_SESSION['error'])) :
                    flashMessages();
                ?>
                    <img src="../img/fingerprint-notfound-icon.png">
                <?php else : ?>
                    <img src="../img/fingerprint-icon.png">
                <?php endif; ?>

                <form action="scan-patient.php" method="POST">
                    <button type="submit" name="scan">Scan Fingerprint</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Closing for div:dashboard-wrapper -->
    </div>

</body>

</html>