<?php

// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abhi";

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare SQL query
$sql = "INSERT INTO patient_injuries_desc (id, description, status, image, created_at)
        VALUES (17, 'this is a fingerprint test esp', 'dead', 'success.jpg', NOW())";

// execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// close database connection
$conn->close();

?>
