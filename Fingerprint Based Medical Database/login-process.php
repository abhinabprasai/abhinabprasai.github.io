<?php
session_start();
require "./pdo.php";
require "./utils.php";

// debug($_POST);

if(!isset($_POST)){
    header("location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST, $_POST['email'], $_POST['password'], $_POST['role'])) {
        $email = validate($_POST['email']);
        $pass = validate($_POST['password']);

        $stmt = $conn->prepare("SELECT * from users WHERE email = '$email'");
        $stmt->execute();
        $user = $stmt->fetchAll();
        // $hash = password_hash("admin123", PASSWORD_DEFAULT);
        // debug(var_dump($user[0]['role']));

        if (count($user) > 0) {

            // debug(!password_verify("admin123", $user[0]['password']));
            if(!password_verify($pass, $user[0]['password'])) {
                $_SESSION['error'] = "Invalid email or password combination!";
                header("location: login.php");
                exit;
            }

            if($_POST['role'] != $user[0]['role']) {
                $_SESSION['error'] = "Invalid email or password combination!";
                header("location: login.php");
                exit;
            }
            
            $_SESSION['userInfo'] = $user[0];
            switch($user[0]['role']) {
                case "ADMIN":
                    header("location: users/admin/index.php");
                    break;
                
                case "FRESPONDER":
                    header("location: users/firstResponder/index.php");
                    break;
                
                case "RECEPTIONIST": 
                    header("location: users/receptionist/index.php");
                    break;
                
                case "PATIENT": 
                    header("location: users/patient/index.php");
                    break;
                
                case "DOCTOR": 
                    header("location: users/doctor/index.php");
                    break;
                
                default: 
                    $_SESSION['error'] = "[403] Access Denied!";
                    header("location: login.php");

            }


        } else {
            $_SESSION['error'] = "Please enter valid credentials!";
            header("location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Please enter valid credentials!";
        header("location: login.php");
        exit;
    }
}
