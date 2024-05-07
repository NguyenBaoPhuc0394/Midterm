<?php
    require 'process.php';
    if(isset($_POST['data'])){
        $class = $_POST['data'];
        if ($class == 'all'){
            $result = getAllStudent();
            echo json_encode($result);
        }
        else{
            $result = getStudentByClass($class);
            echo json_encode($result);
        }
    }

