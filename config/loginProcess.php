<?php
    function connect()
    {
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'qlhs';
        $conn = new mysqli($server, $user, $pass, $db);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        return $conn;
    }

    function loginAdmin($username, $pass)
    {
        $conn = connect();
        $md5pass = md5($pass);
        $sql = 'Select * from adminaccount where TaiKhoan = ? and MatKhau = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $md5pass);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'Invalid username or password');
        }
        return array('error' => '');
    }

