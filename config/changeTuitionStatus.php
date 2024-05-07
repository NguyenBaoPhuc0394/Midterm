<?php
    require 'process.php';
    if(isset($_POST['id']) && isset($_POST['class']) && isset($_POST['date']) && isset($_POST['status'])){
        $class = $_POST['class'];
        $time = $_POST['date'];
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status == 'Not done'){
            if(changeToDone($id, $time)){
                echo json_encode(array('error' => ''));
            } else{
                echo json_encode(array('error' => 'fail'));
            }
        } else if ($status == 'Done'){
            if(changeToUndone($id, $time)){
                echo json_encode(array('error' => ''));
            } else{
                echo json_encode(array('error' => 'fail'));
            }
        }
    }
