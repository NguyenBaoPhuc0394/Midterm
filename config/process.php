<?php
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;


function connect()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'qlhs');
        if($conn -> connect_error){
            die($conn -> connect_error);
        }
        return $conn;
    }

    function getNumOfStudent()
    {
        $conn = connect();
        $sql = 'select count(*) from HocSinh';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $num);
        mysqli_stmt_fetch($stmt);
        return $num;
    }

    function getNumOfTeacher()
    {
        $conn = connect();
        $sql = 'select count(*) from GiaoVien';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $num);
        mysqli_stmt_fetch($stmt);
        return $num;
    }

    function getNumOfUser()
    {
        $conn = connect();
        $sql = 'select count(*) from StudentAccount';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $num);
        mysqli_stmt_fetch($stmt);
        return $num;
    }

    function showClassValue()
    {
        $conn = connect();
        $sql = 'select MaLop from lop';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $tenLop);
        while (mysqli_stmt_fetch($stmt)){
            echo "<option value='$tenLop'>$tenLop</option>";
        }
    }

    function showAllStudent()
    {
        $conn = connect();
        $sql = 'select * from HocSinh ORDER by hocsinh.HoTen';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maHS, $MaLop, $HoTen, $SDT, $QQ, $GT, $DC, $email);
        while (mysqli_stmt_fetch($stmt)){
            echo "<tr>";
                echo "<td>$MaLop</td>";
                echo "<td>$HoTen</td>";
                echo "<td><a type='button' href='./Studentinfo.php?id=$maHS' class='btn btn-sm btn-secondary'>Info</a></td>";
            echo "</tr>";
        }
    }

    function getStudentByClass($class)
    {
        $conn = connect();
        $sql = 'select * from HocSInh where MaLop = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $class);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maHS, $MaLop, $HoTen, $SDT, $QQ, $GT, $DC, $email);
        $arr = array();
        while (mysqli_stmt_fetch($stmt)){
            $arr[] = array('Lop' => $MaLop, 'HoTen' => $HoTen, 'SDT' => $SDT, 'QQ' => $QQ, 'GT' => $GT, 'DC' => $DC, 'email' => $email, 'maHS' => $maHS);
        }
        return $arr;
    }

    function getAllStudent()
    {
        $conn = connect();
        $sql = 'select * from HocSInh';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maHS, $MaLop, $HoTen, $SDT, $QQ, $GT, $DC, $email);
        $arr = array();
        while (mysqli_stmt_fetch($stmt)){
            $arr[] = array('Lop' => $MaLop, 'HoTen' => $HoTen, 'SDT' => $SDT, 'QQ' => $QQ, 'GT' => $GT, 'DC' => $DC, 'email' => $email, 'maHS' => $maHS);
        }
        return $arr;
    }

    function getNewestStudentId()
    {
        $sql = 'SELECT MaHS from hocsinh ORDER BY MaHS DESC LIMIT 1 ';
        $conn = connect();
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $result);
        mysqli_stmt_fetch($stmt);
        return $result;
    }

    function getNewStudentId($id)
    {
        $num = (int)substr(getNewestStudentId(), 2);
        $num += 1;
        return 'HS' . $num;
    }

    function createAccount($id, $phoneNumber)
    {
        $md5pass = md5($phoneNumber);
        $conn = connect();
        $username = 'student' . '_' .$id;
        $sql = 'Insert into studentaccount values (?,?,?)';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $id, $username, $md5pass);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'cannot execute the sql statement');
        }
        return array('error' => '');
    }

    function addStudent($name, $gender, $phoneNumber, $hometown, $class, $address, $email)
    {
        $conn = connect();
        $id = getNewStudentId(getNewestStudentId());
        $sql = 'Insert into HocSinh values (?,?,?,?,?,?,?,?)';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $id, $class, $name, $phoneNumber, $hometown, $gender, $address, $email);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'cannot execute the sql statement');
        }
        insertStudyResultForNewStudent($id);
        return createAccount($id, $phoneNumber);
    }

    function getStudentDataByID($id)
    {
        $conn = connect();
        $sql = 'Select * from HocSinh where MaHS = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maHS, $MaLop, $HoTen, $SDT, $QQ, $GT, $DC, $email);
        mysqli_stmt_fetch($stmt);
        $arr = array('Lop' => $MaLop, 'HoTen' => $HoTen, 'SDT' => $SDT, 'QQ' => $QQ, 'GT' => $GT, 'DC' => $DC, 'email' => $email, 'maHS' => $maHS);
        return $arr;
    }

    function updateStudent($id ,$name, $gender, $phoneNumber, $hometown, $class, $address, $email)
    {
        $conn = connect();
        $sql = 'UPDATE hocsinh set MaLop = ?, HoTen = ?, SDT = ?, QueQuan = ?, GioITinh = ?, DiaChi = ?, Email = ? WHERE MaHS = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssss', $class, $name, $phoneNumber, $hometown, $gender, $address, $email, $id);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'cannot execute the sql statement');
        }
        return array('error' => '');
    }

    function showAllTeacher()
    {
        $conn = connect();
        $sql = "SELECT giaovien.MaGV, giaovien.HoTen, monhoc.tenMon, giaovien.SDT from (giaovien inner JOIN monhoc on giaovien.MaMon = monhoc.MaMon)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id,$name, $subject, $phoneNumber);
        while (mysqli_stmt_fetch($stmt)){
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$subject</td>";
            echo "<td>$phoneNumber</td>";
            echo "<td><a class='btn btn-secondary btn-sm' href='./editTeacher.php?id=$id'>Edit</a></td>";
            echo "</tr>";
        }
    }

    function showSubjectValue()
    {
        $conn = connect();
        $sql = "SELECT * FROM monhoc";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maMon, $tenMon);
        while (mysqli_stmt_fetch($stmt)){
            echo "<option value='$maMon'>$tenMon</option>";
        }
    }

    function getNewestTeacherID()
    {
        $sql = 'SELECT MaGV from giaovien ORDER BY MaGV DESC LIMIT 1';
        $conn = connect();
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $result);
        mysqli_stmt_fetch($stmt);
        return $result;
    }

    function getNewTeacherID()
    {
        $num = (int)substr(getNewestTeacherID(), 2);
        $num += 1;
        return 'GV' . $num;
    }

    function addTeacher($name, $phoneNumber, $subject)
    {
        $conn = connect();
        $id = getNewTeacherID();
        $sql = 'Insert into GiaoVien values (?,?,?,?)';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $id,  $subject, $name, $phoneNumber);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'cannot execute the sql statement');
        }
        return array('error' => '');
    }

    function getTeacherDataByID($id)
    {
        $conn = connect();
        $sql = 'Select * from GiaoVien where MaGV = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $subject, $name, $phoneNumber);
        mysqli_stmt_fetch($stmt);
        return array('id'=> $id, 'subject' => $subject, 'name' => $name, 'phoneNumber' => $phoneNumber);
    }

    function getSubjectName($id)
    {
        $conn = connect();
        $sql = 'Select TenMon from MonHoc where MaMon = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $result);
        mysqli_stmt_fetch($stmt);
        return $result;
    }

    function updateTeacher($id ,$name, $phoneNumber, $subject)
    {
        $conn = connect();
        $sql = 'UPDATE GiaoVien set HoTen = ?, SDT = ?, MaMon = ? WHERE MaGV = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $name,$phoneNumber, $subject, $id);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'cannot execute the sql statement');
        }
        return array('error' => '');
    }

    function showClass()
    {
        $conn = connect();
        $sql = 'select MaLop from lop';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $tenLop);
        while (mysqli_stmt_fetch($stmt)){
            echo "<tr>";
            echo "<td>$tenLop</td>";
            echo "<td><a href='./editElearning.php?id=$tenLop'>Edit</a></td>";
            echo "</tr>";
        }
    }

    function getElearningLinks($class, $subject)
    {
        $conn = connect();
        $sql = "SELECT LinkBaiGiang, LinkHocOnl FROM elearning WHERE MaLop = ? and MaMon = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $class, $subject);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $linkbg, $linkgg);
        mysqli_stmt_fetch($stmt);
        return array('BG'=> $linkbg, 'GG' => $linkgg);
    }

    function updateElearning($class, $subject, $BG, $GG){
        $conn = connect();
        $sql = 'Update elearning set LinkBaiGiang = ?, LinkHocOnl = ? where MaLop = ? and MaMon = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $BG, $GG, $class, $subject);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'cannot execute the sql statement');
        }
        return array('error' => '');
    }

    function getTimeTableByClass($class)
    {
        $conn = connect();
        $sql = 'select TKB from lop where MaLop = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $class);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $filename);
        mysqli_stmt_fetch($stmt);
        return $filename;
    }

    function isExistTuition($time)
    {
        $arr = explode("-", $time);
        $conn = connect();
        $sql = 'select * from hocphi where thoigian = ?';
        $stmt = mysqli_prepare($conn, $sql);
        $tg = $arr[0] . '-'. $arr[1] . '-01';
        mysqli_stmt_bind_param($stmt, 's', $tg);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 0){
            return false;
        }
        return true;
    }

    function getAllStudentID()
    {
        $conn = connect();
        $sql = 'select maHS from hocsinh';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maHS);
        $arr = array();
        while (mysqli_stmt_fetch($stmt)){
            $arr[] = $maHS;
        }
        return $arr;
    }

    function insertTuitionInfo($tg)
    {
        $studentID = getAllStudentID();
        $conn = connect();
        $sql = 'insert into tthocphi values (?, ?, ?)';
        $stmt = mysqli_prepare($conn, $sql);
        $status = 'Not done';
        mysqli_stmt_bind_param($stmt, 'sss', $id, $tg, $status);
        foreach ($studentID as $id){
            mysqli_stmt_execute($stmt);
        }
    }

    function insertNewTuition($time)
    {
        $conn = connect();
        $arr = explode("-", $time);
        $sql = 'Insert into hocphi values (?, ?)';
        $tg = $arr[0] . '-'. $arr[1] . '-01';
        $filename = $arr[1] .'-'.$arr[0] .'.xlsx';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $tg, $filename);
        if(!mysqli_stmt_execute($stmt)){
            return array('error' => 'Cannot execute the sql statement');
        }
        insertTuitionInfo($tg);
        return array('error' => '');
    }

    function showDateValueOfTuition()
    {
        $conn = connect();
        $sql = 'select ThoiGian from hocphi';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $time);
        while (mysqli_stmt_fetch($stmt)){
            $arr = explode('-', $time);
            $value = $arr[1].'-'.$arr[0];
            $show = $arr[1].'/'.$arr[0];
            echo "<option value='$value'>$show</option>";
        }
    }

    function getFileNameByTime($time)
    {
        $arr = explode('-',$time);
        $conn = connect();
        $sql = 'select ThongTinHocPhi from hocphi where MONTH(ThoiGian) = ? and YEAR(ThoiGian) = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $arr[0], $arr[1]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $filename);
        mysqli_stmt_fetch($stmt);
        return $filename;
    }

    function getTuitionStatus($time, $class)
    {
        $arr = explode('-', $time);
        $conn = connect();
        $sql = 'SELECT hocsinh.MaHS, HoTen, TinhTrang FROM (hocsinh INNER JOIN tthocphi on hocsinh.MaHS = tthocphi.MaHS) WHERE MONTH(thoigian) = ? and YEAR(thoigian) = ? AND MaLop = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $arr[0], $arr[1], $class);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id,$name, $tg);
        $result = array();
        while (mysqli_stmt_fetch($stmt)){
             $result[] = array($id, $name, $tg);
        }
        return $result;
    }

    function changeToDone($id, $time)
    {
        $arr = explode('-', $time);
        $conn = connect();
        $sql = 'Update tthocphi set TinhTrang = ? where MaHS = ? and Month(ThoiGian) = ? and Year(ThoiGian) = ?';
        $stmt = mysqli_prepare($conn, $sql);
        $status = 'Done';
        mysqli_stmt_bind_param($stmt, 'ssss', $status, $id ,$arr[0], $arr[1]);
        mysqli_stmt_execute($stmt);
        if(mysqli_stmt_affected_rows($stmt) == 1){
            return true;
        }
        return false;
    }

    function changeToUndone($id, $time)
    {
        $arr = explode('-', $time);
        $conn = connect();
        $sql = 'Update tthocphi set TinhTrang = ? where MaHS = ? and Month(ThoiGian) = ? and Year(ThoiGian) = ?';
        $stmt = mysqli_prepare($conn, $sql);
        $status = 'Not done';
        mysqli_stmt_bind_param($stmt, 'ssss', $status, $id,$arr[0], $arr[1]);
        mysqli_stmt_execute($stmt);
        if(mysqli_stmt_affected_rows($stmt) == 1){
            return true;
        }
        return false;
    }

    function getAllSubjects()
    {
        $conn = connect();
        $result = array();
        $sql = 'Select MaMon from monhoc';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $s);
        while (mysqli_stmt_fetch($stmt)){
            $result[] = $s;
        }
        return $result;
    }

    function insertStudyResultForNewStudent($id)
    {
        $defaultValue = -1;
        $conn = connect();
        $sql = 'Insert into kqht values (?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($conn, $sql);
        $subjects = getAllSubjects();
        mysqli_stmt_bind_param($stmt, 'ssiii', $id, $subject, $defaultValue, $defaultValue, $defaultValue);
        foreach ($subjects as $subject){
            mysqli_stmt_execute($stmt);
        }
    }

    function getAllResultBySubject($subject)
    {
        $conn = connect();
        $sql = 'SELECT hoten, qt1, gk, ck FROM kqht INNER JOIN hocsinh on kqht.MaHS = hocsinh.MaHS WHERE kqht.MaMon = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $subject);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hoten, $qt1, $gk, $ck);
        $result = array();
        while (mysqli_stmt_fetch($stmt)){
            $temp = array();
            $temp[] = $hoten;
            if($qt1 == -1){$temp[] = '_';}else{$temp[] = $qt1;}
            if($gk == -1){$temp[] = '_';}else{$temp[] = $gk;}
            if($ck == -1){$temp[] = '_';}else{$temp[] = $ck;}
            if($qt1 == -1 || $gk == -1 || $ck == -1){$temp[] = '_';}else{$temp[] = ((double)$qt1 * 2 + (double)$gk * 3 + (double)$ck * 5) / 10;}
            $result[] = $temp;
        }
        return $result;
    }

    function getClassResultBySubject($class, $subject)
    {
        $conn = connect();
        $sql = 'SELECT hoten, qt1, gk, ck FROM kqht INNER JOIN hocsinh on kqht.MaHS = hocsinh.MaHS WHERE kqht.MaMon = ? and hocsinh.MaLop = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $subject, $class);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hoten, $qt1, $gk, $ck);
        $result = array();
        while (mysqli_stmt_fetch($stmt)){
            $temp = array();
            $temp[] = $hoten;
            if($qt1 == -1){$temp[] = '_';}else{$temp[] = $qt1;}
            if($gk == -1){$temp[] = '_';}else{$temp[] = $gk;}
            if($ck == -1){$temp[] = '_';}else{$temp[] = $ck;}
            if($qt1 == -1 || $gk == -1 || $ck == -1){$temp[] = '_';}else{$temp[] = ((double)$qt1 * 2 + (double)$gk * 3 + (double)$ck * 5) / 10;}
            $result[] = $temp;
        }
        return $result;
    }

    function getSubjectResultInfo($subject)
    {
        $conn = connect();
        $sql = 'SELECT hocsinh.MaHS, hocsinh.HoTen, kqht.QT1, kqht.GK, kqht.CK FROM kqht INNER JOIN hocsinh on hocsinh.MaHS = kqht.MaHS WHERE kqht.MaMon = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $subject);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $maHS, $hoten, $qt1, $gk, $ck);
        $result = array();
        $header = ['MaHS', 'Name', 'QT', 'GK', 'CK'];
        $result[] = $header;
        while (mysqli_stmt_fetch($stmt)){
            $temp = array();
            $temp[] = $maHS;
            $temp[] = $hoten;
            if($qt1 == -1){$temp[] = '_';}else{$temp[] = $qt1;}
            if($gk == -1){$temp[] = '_';}else{$temp[] = $gk;}
            if($ck == -1){$temp[] = '_';}else{$temp[] = $ck;}
            $result[] = $temp;
        }
        return $result;
    }

    function updateResult($subject, $maHS, $qt, $gk, $ck)
    {
        $conn = connect();
        $sql = 'Update kqht set QT1 = ?, GK = ?, CK = ? where MaHS = ? and MaMon = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'dddss', $qt, $gk, $ck, $maHS, $subject);
        mysqli_stmt_execute($stmt);
    }

    function executeResultUpdate($subject)
    {
        $xlsxFile = 'modal/ResultUpdate/update.xlsx';
        $spreadsheet = IOFactory::load($xlsxFile);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();
        $result = array();
        foreach ($data as $index => $row){
            if($index == 0 || $index == 1){
                continue;
            }
            $result[] = $row;
        }
        foreach ($result as $arr){
            if($arr[2] == '_'){$arr[2] = -1;}
            if($arr[3] == '_'){$arr[3] = -1;}
            if($arr[4] == '_'){$arr[4] = -1;}
            updateResult($subject, $arr[0], (double) $arr[2], (double) $arr[3], (double) $arr[4]);
        }
        return true;
    }





















