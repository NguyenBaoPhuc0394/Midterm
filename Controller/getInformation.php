<?php
    // session_start();
    require_once('../Model/process.php');
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
        $id = $_SESSION['maHS'];
        $infor = getInformation($id);
    }
?>