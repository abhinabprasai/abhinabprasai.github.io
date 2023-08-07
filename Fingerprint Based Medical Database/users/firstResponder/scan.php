<?php 
    include "./verify-block.php";

    if(isset($_POST, $_POST['scan'])){
        $stmt = $conn->prepare("UPDATE status SET status =:status");
        $stmt->execute([
            "status" => 2,
        ]);
    
        header("location: view-details.php");
        exit;
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRESPONDER</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


    <?php include "./header.php" ?>
</head>
<body>
    <div class="text-center text-lg-start mt-4 pt-2">
        <form action="scan.php" method="POST">
            <button type="submit" name="scan" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Scan Fingerprint</button>
        </form>
    </div>
</body>
</html>