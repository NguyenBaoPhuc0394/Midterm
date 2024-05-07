<?php
    require 'process.php';
    if(isset($_POST['classValue']) && isset($_POST['subjectValue'])){
        $class = $_POST['classValue'];
        $subject = $_POST['subjectValue'];
        if($class == 'all'){
            $result = getAllResultBySubject($subject);
            echo json_encode($result);
        }
        else{
            $result = getClassResultBySubject($class, $subject);
            echo json_encode($result);
        }
    }
