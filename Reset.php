<?php
    session_start();
    require 'Model/process.php';
    $error = '';
    if(isset($_POST['pass']) && isset($_POST['confirmPass'])) {
        $pass = $_POST['pass'];
        $maHS = $_SESSION['maHS'];
        if ($_SESSION['status'] == 'checked otp to recover password') {
            $result = changePass($maHS, $pass);
            if (!(empty($result['error']))) {
                $error = $result['error'];
            } else {
                session_unset();
                session_destroy();
                header('Location: success.php');
            }
        } else{
            $error = 'status invalid';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
</head>
<body>

<div class="container">
    <div class="box">
        <span class="title">
            Reset password
        </span>

        <div class="line"></div>

        <form method="post" action="">
            <div class="form-element pass">
                <input class="input" type="password" name="pass" id="pass" placeholder=" ">
                <label for="pass" id="passLabel"> New Password</label>
            </div>

            <div class="form-element confirm-pass">
                <input class="input" type="password" name="confirmPass" id="confirmPass" placeholder=" ">
                <label for="confirmPass" id="confirmPassLabel">Confirm Password</label>
            </div>

            <div class="error" id="error">
                <?php
                    if(!empty($error)){
                        echo $error;
                    }
                ?>
            </div>

            <div class="container-button">
                <button class="btn" type="submit" id="button">
                    Reset password
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    var button = document.getElementById('button');
    button.addEventListener('click', function (e){
        var pass = document.getElementById('pass').value;
        var confirmPass = document.getElementById('confirmPass').value;
        var error = document.getElementById('error');
        if(pass === ""){
            e.preventDefault();
            error.textContent = "Please enter password field";
        }else if(confirmPass === ""){
            e.preventDefault();
            error.textContent = "Please enter confirm password field";
        } else if(pass.length < 9){
            e.preventDefault();
            error.textContent = "Password length must be more than 8 character";
        }
        else if(pass !== confirmPass){
            e.preventDefault();
            error.textContent = "Password and confirm password not match";
        }else {
            error.textContent = "";
        }
    })
</script>
</body>
</html>