<?php
require 'config/process.php';
session_start();
$page_title = 'tuition';

$error = '';
$message = '';
if(isset($_POST['time']) && isset($_FILES['tuitionFile'])) {
    $time = $_POST['time'];
    $timeArr = explode('-', $time);
    $file = $_FILES['tuitionFile'];
    $fileTmpName = $file['tmp_name'];
    $dest = 'modal/tuition/'.$timeArr[1] . '-' . $timeArr[0]. '.xlsx';

    if(!isExistTuition($time)){
        $result = insertNewTuition($time);
        if($result['error'] != ''){
            $error = 'error';
        }else{
            if (!move_uploaded_file($fileTmpName, $dest)) {
                $error = 'error';
            }else{
                $message = 'success';
            }
        }
    }else{
        if (!move_uploaded_file($fileTmpName, $dest)) {
            $error = 'error';
        }else{
            $message = 'success';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="css/Admin.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
    <script>
        function showError(){
            $.bootstrapGrowl("Adding failed",{
                type: 'danger',
                offset: {from:"top",amount: 30},
                align: "right",
                delay: 3000,
                width: 350,
                allow_dismiss: true
            });
        }

        function showSuccess(){
            $.bootstrapGrowl("Adding success",{
                type: 'success',
                offset: {from:"top",amount: 30},
                align: "right",
                delay: 3000,
                width: 350,
                allow_dismiss: true
            });
        }
    </script>
    <style>
        .error{
            margin-top: 0;
            color: #DC4C64;
        }
        #download{
            text-decoration: none;
            margin-top: 3px;
            margin-bottom: 3px;
            display: flex;
        }
    </style>

</head>
<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <?php include 'Sidebar.php'?>
    <!-- Main  -->
    <div class="main">
        <!-- Navbar  -->
        <!-- Content  -->
        <main class="content px-3 py-4 mt-5">
            <div class="container-fluid add-student" style="margin-top: 50px">
                <div class="mt-6">
                    <h3 class="fw-bold fs-4 my-3">Add/Update Tuition</h3>
                    <form method="post" action="" novalidate enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="month" class="form-control" id="time" name="time" placeholder="Choose time">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="file" class="form-label">File</label>
                                <input type="file" class="form-control" id="file" name="tuitionFile" placeholder="Enter file">
                            </div>
                        </div>
                        <a href="modal/tuition/TuitionFormal.xlsx" id="download" download>Download format for tuition</a>
                        <div class="error" id="error"></div>
                        <div class="row justify-content-end" style="margin-top: 6px; margin-right: 10px">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-dark mt-1" id="btn">Submit</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (!empty($error)){
                        echo "<script> showError(); </script>";
                    } else if (!empty($message)){
                        echo "<script> showSuccess(); </script>";
                    }
                    ?>
                </div>
            </div>
        </main>
        <?php include 'Footer.php' ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/Admin.js"></script>
<script>
    function validateFile() {
        var fileInput = document.getElementById('file')
        var filePath = fileInput.value
        var allowedExtensions = /(\.xlsx)$/i

        if (!allowedExtensions.exec(filePath)) {
            $('#error').text('Please upload xlsx file')
            return false;
        }
        return true;
    }

    function checkDate(){
        var inputDate = new Date(document.getElementById('time').value)
        var currentDate = new Date()
        var leastDate = new Date(2023, 10)
        if(inputDate > currentDate){
            $('#error').text('Please select a time earlier than now')
            return false
        } else if (inputDate <= leastDate){
            $('#error').text('Please select a time later than 10/2023')
            return false
        }
        return true
}

    function updateButtonAvailability(){
        if ($('#time').val() === '' && $('#file').val() === '') {
            $('#btn').prop('disabled', true)
            $('#error').text('Please fill all field')
        } else if(!checkDate()){
            $('#btn').prop('disabled', true)
        }
        else if(!validateFile()){
            $('#btn').prop('disabled', true)
        } else {
            $('#btn').prop('disabled', false)
            $('#error').text('')
        }
    }

    $(document).ready(function (){
        updateButtonAvailability()
        $('#btn').prop('disabled', true)
        $('#time, #file').change(function() {
            updateButtonAvailability()
        });


    })
</script>
</body>
</html>
