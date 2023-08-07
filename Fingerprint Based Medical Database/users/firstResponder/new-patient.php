<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require "./header.php"; ?>
</head>

<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>
        <div class="body-section">
            <h3>Accidental Details</h3>
            <div class="view-section">
                <div class="patient-details">
                    <h4>Patient Details</h4>
                    <div style="position: relative">
                        <img src="../img/defUser.jpeg">
                        <p class="details">
                            <span>Patient Name</span><br><br>
                            <span>Patient Contact</span><br><br>
                            <span>Patient Age</span><br><br>
                            <span>Gender</span><br><br>
                        </p>
                    </div>
                    <hr>
                    <div>
                        <h4>Medical History</h4>
                        <p>Blood Group: </p>
                        <p>RBC Count: </p>
                        <p>WBC Count: </p>
                        <p>Allergies</p>
                        <p>Prescribed Medicines</p>
                    </div>
                </div>
                <div class="patient-form">
                    <form method="POST" action="view-details.php">
                        <input type="text" name="location" placeholder="Location"><br>
                        <input type="text" name="incident_cause" placeholder="Incident Cause"><br>
                        <textarea type="text" name="description" placeholder="Description" cols="55" rows="10"></textarea><br>
                        <input type="file" name="image" class="image-upload"><br>
                        <button type="submit">Add Details</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>