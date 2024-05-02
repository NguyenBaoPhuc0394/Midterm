<?php
    require_once('process.php');
    // require_once 'vendor/autoload.php';
    // use PhpOffice\PhpSpreadsheet\IOFactory;
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
        $id = $_SESSION['maHS'];
        $inforTuition = getInforTuition($id);
        // $tuition;
        // if(count($inforTuition) > 0){
        //     foreach($inforTuition as $inforItem){

        //     }
        // }
    }
?>