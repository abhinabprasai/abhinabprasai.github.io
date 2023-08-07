<?php 
    $phone = "9899949999";

    $phone_pattern = "/^9[0-9]{9}$/";

    if(preg_match($phone_pattern, $phone)) {
        echo "validated";
    }
    else {
        echo "failed";
    }
?>