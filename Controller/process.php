<?php
    // require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

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

    function loginStudent($username, $pass)
    {
        $conn = connect();
        $md5pass = md5($pass);
        $sql = 'Select * from studentAccount where TaiKhoan = ? and MatKhau = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $md5pass);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'Invalid username or password');
        }
        mysqli_stmt_bind_result($stmt, $maHS, $tk, $mk);
        mysqli_stmt_fetch($stmt);
        return array('error' => '', 'maHS' => $maHS);
    }

    function getInformation($maHS){
        $conn = connect();
        $sql = 'Select * from HocSinh where maHS = ?';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'s',$maHS);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'Invalid studentID');
        }
        mysqli_stmt_bind_result($stmt, $maHS, $maLop, $hoten, $SDT,$quequan, $gender, $diachi, $email);
        mysqli_stmt_fetch($stmt);
        return array('error' => '', 'maHS' => $maHS,'maLop' => $maLop,'hoten'=>$hoten,'SDT' => $SDT, 'quequan' => $quequan, 'gioitinh' => $gender,'diachi'=>$diachi,'Email'=>$email);
    }

    function getMamon($tenmon){
        $conn = connect();
        $sql = 'Select mamon from Monhoc where tenmon = ?';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'s',$tenmon);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'Invalid subjectID','mamon' => $tenmon);
        }
        mysqli_stmt_bind_result($stmt, $mamon);
        mysqli_stmt_fetch($stmt);
        return array('error' => '', 'mamon' => $mamon);
    }

    function getElearning($malop, $mamon){
        $conn = connect();
        $sql = 'Select * from Elearning where maLop = ? and maMon = ?';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'ss',$malop, $mamon);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => '', 'maLop' => $malop,'maMon' => $mamon,'LinkBaiGiang'=>'','LinkHocOnl' => '');
        }
        mysqli_stmt_bind_result($stmt, $malop, $mamon, $linkBG, $linkOnl);
        mysqli_stmt_fetch($stmt);
        return array('error' => '', 'maLop' => $malop,'maMon' => $mamon,'LinkBaiGiang'=>$linkBG,'LinkHocOnl' => $linkOnl);
    }

    function getInforTuition($mahs){
        $conn = connect();
        $sql = 'SELECT * FROM TTHocPhi WHERE mahs = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $mahs);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the SQL');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'No data found');
        }
        $results = array();
        mysqli_stmt_bind_result($stmt, $mahs, $thoigian, $tinhtrang);
        while (mysqli_stmt_fetch($stmt)) {
            $results[] = array(
                'error' =>'',
                'mahs' => $mahs,
                'thoigian' => $thoigian,
                'tinhtrang' => $tinhtrang
            );
        }
        return $results;
    }
    
    function getTuition($thoigian){
        $conn = connect();
        $sql = 'Select * from HocPhi where thoigian = ?';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'s',$thoigian);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 1);
        }
        mysqli_stmt_bind_result($stmt, $thoigian, $thongtin);
        mysqli_stmt_fetch($stmt);
        return array('error' => '', 'thoigian' => $thoigian, 'thongtin' => $thongtin);
    }

    function getTimetable($malop){
        $conn = connect();
        $sql = 'Select TKB from LOP where malop = ?';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'s',$malop);
        if (!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 1);
        }
        mysqli_stmt_bind_result($stmt, $tkb);
        mysqli_stmt_fetch($stmt);
        return array('error' => '', 'tkb' => $tkb);
    }

    function createResetPassRequest($email)
    {
        $conn = connect();
        $sql = 'Select MaHS from hocsinh where email = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        if(!mysqli_stmt_execute($stmt)){
            return array('error'=> 'cannot execute the sql');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'This email is not match with any student information');
        }
        mysqli_stmt_bind_result($stmt, $maHS);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_free_result($stmt);

        $sql = 'DELETE FROM resetpassword WHERE MaHS = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $maHS);
        if(!mysqli_stmt_execute($stmt)){
            return array('error'=> 'cannot execute the sql');
        }


        $sql = 'INSERT into resetpassword VALUES (?,(SELECT TaiKhoan from studentaccount WHERE MaHS = ?), ?, ?)';
        $stmt = mysqli_prepare($conn, $sql);
        $randomOTP = rand(1000, 9999);
        $time = time() + 3600*24;
        mysqli_stmt_bind_param($stmt, 'ssss', $maHS, $maHS, $randomOTP, $time);
        if(!mysqli_stmt_execute($stmt)){
            return array('error'=> 'cannot execute the sql');
        }
        return array('error' => '', 'otp' => $randomOTP, 'maHS' => $maHS);
    }

    function sendRecoverToEmail($email)
    {
        $request = createResetPassRequest($email);
        if (!empty($request['error'])){
            return $request;
        }
        $otp = $request['otp'];
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'huynhphuonggg1975@gmail.com';                     //SMTP username
            $mail->Password = 'tpwqpyeatbmmirrz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;


            //Recipients
            $mail->setFrom('huynhphuonggg1975@gmail.com', 'Admin');
            $mail->addAddress($email, 'User');     //Add a recipient
            /*$mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');*/

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Khoi phuc tai khoan cua ban';
            $mail->Body = "Ma OTP cua ban la $otp <br> Vui long khong chia se ma nay cho nguoi khac";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //$mail->Body = "hi";


            $mail->send();
            return array('error'=>'', 'maHS' => $request['maHS']);

        } catch (Exception $e) {
            return array('error'=>'Failed to send email');
        }
    }

    function deleteResetRequest($maHS)
    {
        $conn = connect();
        $sql = 'Delete from resetpassword where MaHS = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $maHS);
        if(!mysqli_stmt_execute($stmt)){
            return array('error'=>'Cannot execute the sql statement');
        }
        return array('error' => '');
    }

    function checkOTP($otp, $maHS)
    {
        if (empty($otp) || empty($maHS)){
            return array('error' => 'input error');
        }

        $conn = connect();
        $sql = 'Select expired_on from resetpassword where otp = ? and MaHS = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $otp, $maHS);
        if(!mysqli_stmt_execute($stmt)){
            return array('error'=>'Cannot execute the sql statement');
        }
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return array('error' => 'This otp is not match or there is no request to recover password');
        }

        mysqli_stmt_bind_result($stmt, $expired_on);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_free_result($stmt);
        if ($expired_on - time() < 0){
            return array('error' => 'end of time to reset password. please send request again!');
        }
        $deleteRequest = deleteResetRequest($maHS);
        if(!empty($deleteRequest['error'])){
            return $deleteRequest;
        }
        return array('error' => '');
    }

    function changePass($maHS, $pass)
    {
        if (empty($maHS) || empty($pass)){
            return array('error' => 'input error');
        }
        $md5pass = md5($pass);
        $conn = connect();
        $sql = 'Update studentaccount set MatKhau = ? where MaHS = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $md5pass, $maHS);
        if(!mysqli_stmt_execute($stmt)){
            return array('error'=>'Cannot execute the sql statement');
        }
        return array('error'=>'');
    }



