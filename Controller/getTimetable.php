<?php
    require_once('Model/process.php');
    require_once 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
        $id = $_SESSION['maHS'];
        $infor = getInformation($id);
        $tkb = getTimetable($infor['maLop']);
        if($infor['error'] == ''){
            $result = getData($tkb['tkb']);
        }
    }

    function getData($maLop){
        $filepath = '../Admin_backend/timetable/'.$maLop;
        $spreadsheet = IOFactory::load($filepath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();
        $allRows = array();
        foreach ($data as $index => $row) {
            $allRows[] = $row;
        }
        return $allRows;
    }
?>