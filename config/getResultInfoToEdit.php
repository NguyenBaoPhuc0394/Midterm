<?php
    require 'process.php';
    if(isset($_POST['subjectValue'])){
        $subjectValue = $_POST['subjectValue'];
        $result = getSubjectResultInfo($subjectValue);
        echo json_encode($result);
    }