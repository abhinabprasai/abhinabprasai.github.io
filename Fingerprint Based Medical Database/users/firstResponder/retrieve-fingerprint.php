<?php
    include "../pdo.php";

    @$fid = $_GET['fid'];

    // $stmt = $conn->query("SELECT * from retrieve_fingerprint");
    // $stmt->execute();
    // echo $stmt->rowCount(); exit;

    $stmt = $conn->prepare("INSERT into retrieve_fingerprint(fid) VALUE($fid)");
        $stmt->execute();

    // if($stmt->rowCount() <= 0){
        
    // }
    // else {
    //     $stmt = $conn->prepare("UPDATE retrieve_fingerprint SET fid=:fid");
    //     $stmt->execute([
    //         'fid'=>$fid
    //     ]);
    // }
    

    $stmt = $conn->prepare("UPDATE status SET status =:status");
    $stmt->execute([
        "status" => 0,
    ]);
?>