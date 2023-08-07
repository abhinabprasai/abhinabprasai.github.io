<?php 
    @session_start();
    require "./utils.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="stylesheet" type="text/css" href="./css/app.css">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-image">
            <img src="./img/globe-image.png">
        </div>
        <div class="login-form">
            <div class="form">
            <form method="POST" action="login-process.php">
                <img class="logo" src="./img/logo.png">
                <h2 class="title">FBMD</h2>
                <p class="subtitle"><i>"Seconds <span style="color: #2663A7;">Save</span> <span style="color: #51A75E;">Lives</span>"</i></p>
                <h3>Login</h3>
                <?=flashMessages()?>
                <input type="email" placeholder="Email" name="email" required> 
                <br>
                <img src="./img/hide-eye-icon.png" class="hide-eye" id="toggle">
                <input type="password" placeholder="Password" name="password" id="pw" required>
                <br>
                <select name="role" required>
                    <option disabled>--Select user type--</option>
                    <option value="ADMIN">Admin</option>
                    <option value="FRESPONDER">First Responder</option>
                    <option value="DOCTOR">Doctor</option>
                    <option value="RECEPTIONIST">Receptionist</option>
                    <option value="PATIENT">Patient</option>
                </select>
                
                <span class="forgot-password">Forgot Password?</span>
                <button type="submit">Login</button><br><br>
            </form>
            </div>
        </div>
    </div>

    <script>
    const pwBtn = document.querySelector('#pw')
    document.querySelector('#toggle').addEventListener('click', (event) => {
        pwBtn.type === "password" ? pwBtn.type = "text" : pwBtn.type = "password"
        console.log("clicked");
    })
</script>
</body>

</html>