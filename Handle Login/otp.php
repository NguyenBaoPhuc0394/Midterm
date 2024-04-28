<?php
    session_start();
    require '../process/process.php';
    $error = '';

    if(isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['num3']) && isset($_POST['num4'])){
        $arr = array();
        $arr[]= (string)$_POST['num1'];
        $arr[]= (string)$_POST['num2'];
        $arr[]= (string)$_POST['num3'];
        $arr[]= (string)$_POST['num4'];
        $otp = $arr[0].$arr[1].$arr[2].$arr[3];
        if($_SESSION['status'] == 'sent email to recover password'){
            $result = checkOTP($otp, $_SESSION['maHS']);
            if(!empty($result['error'])){
                $error = $result['error'];
            }
            else{
                $_SESSION['status'] = 'checked otp to recover password';
                header('Location: Reset.php');
            }
        }
        else{
            $error = 'status invalid';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Verification</title>
    <link rel="stylesheet" type="text/css" href="../css/otp.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../js/otp.js" defer></script>
  </head>
  <body>
    <div class="container">
      <header>
        <i class="bi bi-shield"></i>
      </header>
      <h4>Enter OTP Code</h4>
      <form action="" method="post">
        <div class="input-field">
          <input type="number" name="num1" />
          <input type="number" disabled name="num2"/>
          <input type="number" disabled name="num3"/>
          <input type="number" disabled name="num4"/>
        </div>
        <div class="error">
            <?php
                if(!empty($error)){
                    echo $error;
                }
            ?>
        </div>
        <button>Verify OTP</button>
      </form>
    </div>
  </body>
</html>
