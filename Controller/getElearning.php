<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once('../Model/process.php');
    if(isset($_POST['selectedValue'])){
        $selectedValue = $_POST['selectedValue'];
        // require_once('../Model/process.php');
        if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
            $id = $_SESSION['maHS'];
            $infor = getInformation($id);
            $mh = getMamon($selectedValue);
            if($infor['error'] == '' && $mh['error'] == ''){
                $elearning = getElearning($infor['maLop'],$mh['mamon']);
                // echo $elearning['LinkBaiGiang'];
                $data = array($elearning['LinkBaiGiang'], $elearning['LinkHocOnl']);
                $jsonData = json_encode($data);
                echo $jsonData;
            }
        }
    }
?>