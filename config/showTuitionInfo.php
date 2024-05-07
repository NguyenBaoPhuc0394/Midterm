<?php
require 'process.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

    if(isset($_POST['data'])){
        $timeValue = $_POST['data'];
        $filename = getFileNameByTime($timeValue);
        $xlsxFile = '../modal/tuition/' . $filename;
        $spreadsheet = IOFactory::load($xlsxFile);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        $allRows = array();
        foreach ($data as $index => $row) {
            if ($index === 0) {
                continue;
            }
            $allRows[] = $row;
        }
        echo json_encode($allRows);
    }
