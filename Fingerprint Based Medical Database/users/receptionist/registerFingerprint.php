<?php 
    session_start();
    
    require "../pdo.php";

    @$fid = $_GET['fid'];

    $stmt = $conn->prepare("INSERT INTO fingerprint(fid) VALUES(:id)");
    $stmt->execute([
        'id' => $fid,
    ]);

    $stmt = $conn->prepare("INSERT INTO patient_details(fingerprint_id) VALUES(:id)");
    $stmt->execute([
        'id' => $fid,
    ]);

    $_SESSION['lastInsertedId'] = $conn->lastInsertId();

    $stmt = $conn->prepare("UPDATE status SET status =:status");
    $stmt->execute([
        "status" => 0,
    ]);


?>