<?php
    require 'process.php';
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;

    if(isset($_POST['data'])){
        $class = $_POST['data'];
        $filename = getTimeTableByClass($class);
        if ($filename == ''){
            echo json_encode(array());
        }
        else{
            $xlsxFile = '../modal/timetable/' . $filename;
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

    }

