<?php
    session_start();
    require '../Model/process.php';

    $error = '';
    if (isset($_POST['username']) && isset($_POST['pass'])) {
        $user = $_POST['username'];
        $pass = $_POST['pass'];

        $result = loginStudent($user, $pass);
        if(!empty($result['error'])){
            $error = $result['error'];
        }
        else{
            $_SESSION['maHS'] = $result['maHS'];
            $_SESSION['status'] = 'login success';
            header('Location: ../View/index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
		<div class="container">
			<div class="box">
				<div class="pic">
					<img src="../images/img-01.png" alt="IMG">
				</div>

				<form method="post" action="">
					<span class="title">
						Student Login
					</span>

					<div class="form-element username">
						<input class="input" type="text" name="username" id="username" placeholder=" ">
						<label for="username" id="usernameLabel">Username</label>
					</div>

					<div class="form-element pass">
						<input class="input" type="password" name="pass" id="pass" placeholder=" ">
						<label for="pass" id="passLabel">Password</label>
					</div>

					<div class="error" id="error">
                        <?php
                        if (!empty($error)) {
                            echo $error;
                        }
                        ?>
					</div>
					
					<div class="container-button">
						<button class="btn" id = "button">
							Login
						</button>
					</div>

					<div class="forgot">
						<a class="forgot-text" href="Forgot.php">
							 Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>

        <script>
            var button = document.getElementById('button');
            button.addEventListener('click', function (e){

                var usernameField = document.getElementById('username').value;
                var passField = document.getElementById('pass').value;
                var error = document.getElementById('error');
                if(usernameField === ""){
                    e.preventDefault();
                    error.textContent = "Please enter username field";
                }
                else if(passField === ""){
                    e.preventDefault();
                    error.textContent = "Please enter password field";
                }
                else{
                    error.textContent = "";
                }
            })

        </script>

</body>
</html>