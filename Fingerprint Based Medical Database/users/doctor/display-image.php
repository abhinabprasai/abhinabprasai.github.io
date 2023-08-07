<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "./header.php"; ?>
</head>
<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>
        <div class="body-section">
            <img src="../uploads/<?=$_GET['img'];?>">
        </div>
    </div>
    </div>
</body>
</html>