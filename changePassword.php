<?php
session_start();
require 'Controller/process.php';

$message = '';
if (isset($_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $message = 'New passwords do not match!';
    } else {
        $result = changePass($maHS, $pass);
        if (!empty($result['error'])) {
            $message = $result['error'];
        } else {
            $message = 'Password changed successfully!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/changepass.css">
</head>
<body>
    <div class="container">
        <form class="form-box" method="post" action="">
            <h1 class="title">Change Password</h1>
            
            <div class="form-group">
                <input type="password" name="current_password" id="current_password" required>
                <label for="current_password">Current Password</label>
            </div>

            <div class="form-group">
                <input type="password" name="new_password" id="new_password" required>
                <label for="new_password">New Password</label>
            </div>

            <div class="form-group">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label for="confirm_password">Confirm New Password</label>
            </div>

            <div class="message">
                <?php if (!empty($message)) echo $message; ?>
            </div>
            
            <button type="submit" class="submit-btn">Change Password</button>
        </form>
    </div>
</body>
</html>