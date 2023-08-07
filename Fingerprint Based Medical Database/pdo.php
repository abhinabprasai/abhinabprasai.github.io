<?php 
    $env = parse_ini_file(".env");
    $dbname = $env['DB_NAME'];
    $dbuser = $env['DB_USER'];
    $dbpassword = $env['DB_PASSWORD'];
   
    $conn = new PDO("mysql:host=127.0.0.1; port=3306; dbname=$dbname", "$dbuser", "$dbpassword");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(!$conn){
        die("Database error!");
    }
    // else{
    //     echo "conn";
    // }

?>