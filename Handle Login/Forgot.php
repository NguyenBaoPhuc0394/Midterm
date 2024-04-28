<?php
    session_start();
    require '../process/process.php';
    $error = '';

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $result = sendRecoverToEmail($email);
        if (!empty($result['error'])){
            $error = $result['error'];
        }else{
            $_SESSION['maHS'] = $result['maHS'];
            $_SESSION['status'] = 'sent email to recover password';
            header('Location: otp.php');
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
    <link rel="stylesheet" type="text/css" href="../css/forgot.css">
</head>
<body>

<div class="container">
    <div class="box">
        <span class="title">
                Reset password
        </span>

        <div class="line"></div>

        <form action="" method="post">
            <div class="form-element">
                <input class="input" type="text" name="email" id="email" placeholder=" ">
                <label for="email" id="usernameLabel">Email</label>
            </div>

            <div class="error" id="error">
                <?php
                    if(!empty($error)){
                        echo $error;
                    }
                ?>
            </div>

            <div class="help">
                Enter your email to reset password
                <p>*if your email exists, please check your email after click button reset</p>
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
    var but = document.getElementById('button');
    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    but.addEventListener('click', function (e){
        var error = document.getElementById('error');
        var emailField = document.getElementById('email').value;
        if (emailField === ""){
            e.preventDefault();
            error.innerText = "Please enter your email";
        }
        else if (!validateEmail(emailField)){
            e.preventDefault();
            error.innerText = "Your email is not valid";
        }
        else{
            error.textContent = "";
        }
    })
</script>

</body>
</html>