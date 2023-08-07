<?php
require './pdo.php';
require "./utils.php";

//insert admin in Database
/* $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

try {
    $stmt->execute(array(
        "email" => "admin@example.com",
        "password" => password_hash("admin123", PASSWORD_DEFAULT),
        "name" => "Admin",
        "role" => "ADMIN"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

/* $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

try {
    $stmt->execute(array(
        "email" => "first@responder.com",
        "password" => password_hash("first123", PASSWORD_DEFAULT),
        "name" => "First Responder",
        "role" => "FRESPONDER"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

// $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

// try {
//     $stmt->execute(array(
//         "email" => "receptionist@login.com",
//         "password" => password_hash("recep123", PASSWORD_DEFAULT),
//         "name" => "Receptionist",
//         "role" => "RECEPTIONIST"
//     ));
// } catch (Exception $th) {
//     echo $th;
//     echo $conn->errorInfo();
// }

/* $stmt = $conn->prepare("INSERT INTO patient_injuries_desc(description, status) VALUES(:desc, :status)");

 try {
    $stmt->execute(array(
        "desc" => "First Patient",
        "status" => "First Patient"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

if(isset($_FILES['image'])){
    debug($_FILES['image']);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="sub">
    </form>
</body>
</html>