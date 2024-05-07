<?php
    session_start();
    require 'config/loginProcess.php';

    $error = '';
    $needHint = false;
    if (isset($_POST['username']) && isset($_POST['pass'])) {
        $user = $_POST['username'];
        $pass = $_POST['pass'];
        $result = loginAdmin($user, $pass);
        if(!empty($result['error'])){
            $error = $result['error'];
            $needHint = true;
        }
        else{
            $_SESSION['status'] = 'login success admin';
            header('Location: index.php');
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
	<title>Admin Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	  <link rel="stylesheet" href="css/adminLogin.css">
  </head>
	<body>
		<div class="container">
			<div class="box">
				<div class="circle">
					<i class="bi bi-person-circle"></i>
				</div>
				<h3>Admin Login</h3>
				<form action="" method="post">
					<div class="form-element">
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
				</form>
				<div class="hint">
                    <?php
                        if($needHint){
                            echo 'Hint: user:admin, pass admin';
                        }
                    ?>
                </div>
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

