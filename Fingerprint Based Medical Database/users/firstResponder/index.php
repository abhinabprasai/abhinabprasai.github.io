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

        $stmt = $conn->prepare("DELETE from retrieve_fingerprint");
        $stmt->execute();
        ?>
        <div class="body-section">
            
        </div>
    </div>

    <!-- div:dashboard-wrapper closing -->
    <div>
</body>

</html>