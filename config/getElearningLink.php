<?php
    require 'process.php';
    if(isset($_POST['class']) && isset($_POST['subject'])){
        $subject = $_POST['subject'];
        $class = $_POST['class'];
        $result = getElearningLinks($class, $subject);
        echo json_encode($result);
    }
