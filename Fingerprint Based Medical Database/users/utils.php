<?php 
    @session_start();

    function debug($str){
        echo "<pre>";
        print_r($str);
        echo "</pre>";
        exit;
    }

    function flashMessages(){
        if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
            echo "<p><span style='color: green'>".$_SESSION['success']."</span></p>";
            unset($_SESSION['success']);
        }

        if(isset($_SESSION['warning']) && !empty($_SESSION['warning'])){
            echo "<p><span style='color: yellow'>".$_SESSION['warning']."</span></p>";
            unset($_SESSION['warning']);
        }

        if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo "<p><span style='color: red'>".$_SESSION['error']."</span></p>";
            unset($_SESSION['error']);
        }
    }
    
    function validate($str){
        htmlentities($str);
        trim($str);
        // htmlspecialchars($str);

        return $str;
    }
?>