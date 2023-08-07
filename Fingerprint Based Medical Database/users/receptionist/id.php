<?php
    require "../pdo.php";
    
$arr = [];
        for($i = 1; $i <= 127; $i++){
            array_push($arr, $i);
        }
// debug($arr);
$result = $conn->prepare("SELECT fid from fingerprint");
$result->execute();
$fids = $result->fetchAll(PDO::FETCH_ASSOC);


// debug($fids);

foreach($fids as $fid){
    $pos = array_search($fid['fid'], $arr);
    array_splice($arr, $pos, 1);
} 
// debug($arr);

echo intval($arr[0]);
?>
