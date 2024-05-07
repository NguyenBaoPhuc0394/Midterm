<?php
    require 'process.php';
    if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
        if($subject == 'Choose Subject'){
            $res = getTeachers();
            $result = array();
            foreach($res as $row){
                if($row['error'] == ''){
                    $tm = getTenmon($row['mamon']);
                    if($tm['error'] ==''){
                        $result[] = array('error' => $row['error'],'magv' => $row['magv'],'hoten' => $row['hoten'],'tenmon' => $tm['tenmon'],'sdt' => $row['sdt']);
                    }
                }
            }
            echo json_encode($result);

        }
        else{
            $subID = getMamon($subject);
            $res = getTeacherBySub($subID['mamon']);
            $result = array();
            foreach($res as $row){
                if($row['error'] == ''){
                    $result[] = array('error' => $row['error'],'magv' => $row['magv'],'hoten' => $row['hoten'],'tenmon' => $subject,'sdt' => $row['sdt']);
                }
            }
            echo json_encode($result);
        }
    }
