<?php
    require 'process.php';
    if(isset($_POST['class']) && isset($_POST['date'])){
        $class = $_POST['class'];
        $time = $_POST['date'];
        $result = getTuitionStatus($time, $class);
        echo json_encode($result);
    }
