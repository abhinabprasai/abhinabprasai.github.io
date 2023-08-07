<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "./header.php"; ?>
    <style>
    table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    table td, table th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    table tr:nth-child(even){background-color: #f2f2f2;}

    table tr:hover {background-color: #ddd;}

    table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: lightgrey;
    color: white;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>
        <div class="body-section">
            <h3>First responder reports</h3>
            <table border="1">
                <tr>
                    <th>Location</th>
                    <th>Incident Cause</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created at</th>
                </tr>
                <?php
                $patientId = $_GET['pid'];
                $stmt=$conn->query("SELECT * from fresponder_reports WHERE patient_id = $patientId");
                $stmt->execute();
                $fresponder_reports = $stmt->fetchAll();

                foreach($fresponder_reports as $fr){
                ?>
                <tr>
                    <td><?=$fr['location']??'N/A'?></td>
                    <td><?=$fr['incident_cause']??'N/A'?></td>
                    <td><?=$fr['description']??'N/A'?></td>
                    <td><a href="display-image.php?img=<?=$fr['image']?>"><img src="../uploads/<?=$fr['image']?>" alt="" height="300px"></a></td>
                    <td><?=$fr['created_at']??'N/A'?></td>
                </tr>
                <?php
                }
                ?>
            </table>
            <br><br>
            <h3>Doctor reports</h3>
            <table border="1">
                <tr>
                    <th>Diseases</th>
                    <th>RBC Count</th>
                    <th>WBC Count</th>
                    <th>Allergies</th>
                    <th>Advised Tests</th>
                    <th>Symptoms</th>
                    <th>Presription</th>
                    <th>Created at</th>
                </tr>
                <?php
                $patientId = $_GET['pid'];
                $stmt=$conn->query("SELECT * from doctor_reports WHERE patient_id = $patientId");
                $stmt->execute();
                $fresponder_reports = $stmt->fetchAll();

                foreach($fresponder_reports as $fr){
                ?>
                <tr>
                    <td><?=$fr['dieseases']??'N/A'?></td>
                    <td><?=$fr['rbc_count']??'N/A'?></td>
                    <td><?=$fr['wbc_count']??'N/A'?></td>
                    <td><?=$fr['allergies']??'N/A'?></td>
                    <td><?=$fr['advised_tests']??'N/A'?></td>
                    <td><?=$fr['symptoms']??'N/A'?></td>
                    <td><?=$fr['prescriptions']??'N/A'?></td>
                    <td><?=$fr['created_at']??'N/A'?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
    </div>
</body>
</html>