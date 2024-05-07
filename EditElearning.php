<?php
session_start();
require 'config/process.php';
$page_title = 'elearning';
$class = '';
$error = '';
$message = '';
if(isset($_POST['class']) && isset($_POST['subject']) && isset($_POST['BG']) && isset($_POST['GG'])){
    $class = $_POST['class'];
    $subject  = $_POST['subject'];
    $BG  = $_POST['BG'];
    $GG = $_POST['GG'];
    $result = updateElearning($class, $subject, $BG, $GG);
    if($result['error'] != ''){
        $error = 'error';
    }
    else{
        $message = 'Success';
    }
}
else if(isset($_GET['id'])){
    $class = $_GET['id'];
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
            $.bootstrapGrowl("Update failed",{
                type: 'danger',
                offset: {from:"top",amount: 30},
                align: "right",
                delay: 3000,
                width: 350,
                allow_dismiss: true
            });
        }

        function showSuccess(){
            $.bootstrapGrowl("Update success",{
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
        .back-btn{
            padding: 10px 20px;
            color: black;
            text-decoration: none;
            margin-top: 10px;
            font-size: 20px;
        }
        .error{
            margin-top: 2px;
            color: #DC4C64;
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
        <a class="back-btn" href="Elearning.php">< Back</a>
        <main class="content px-3 py-4 mt-5">
            <div class="container-fluid add-student">

                <div class="mb-3">
                    <h3 class="fw-bold fs-4 my-3">Edit E-learning</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <input type="text" class="form-control" id="class" name="class" placeholder="" value="<?php if(!empty($class)) echo $class?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" id="subject" name="subject">
                                <option selected value="">Choose subject</option>
                                <?php
                                showSubjectValue();
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="BG" class="form-label">Video Link</label>
                            <input type="text" class="form-control" id="BG" name="BG" onfocusout="checkLink('BG')" placeholder="Enter link ">
                            <div class="error" id="BG-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="GG" class="form-label">Meeting room link</label>
                            <input type="text" class="form-control" id="GG" name="GG" onfocusout="checkLink('GG')" placeholder="Enter link ">
                            <div class="error" id="GG-error"></div>

                        </div>
                        <div class="row justify-content-end">
                            <div class="col-md-10 text-end">
                                <button id="btn-submit" type="submit" class="btn btn-dark mt-1" >Update</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (!empty($error)) {
                        echo "<script> showError(); </script>";
                    } else if (!empty($message)) {
                        echo "<script> showSuccess(); </script>";
                        echo "<script> setTimeout(function() { window.location.href = 'Elearning.php'; }, 2000); </script>";
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
    function checkLink(id){
        let input = document.getElementById(id)
        let isError = false
        if (id === 'BG'){
            if(!matchYoutubeVideoUrl(input.value)){
                document.getElementById('BG-error').textContent = 'Invalid youtube url'
                isError = true
            }
            else{
                document.getElementById('BG-error').textContent = ''
            }
        }
        if (id === 'GG'){
            if(!validateMeetLink(input.value)){
                document.getElementById('GG-error').textContent = 'Invalid google meet url'
                isError = true
            }
            else{
                document.getElementById('GG-error').textContent = ''
            }
        }
        if(isError){
            $('#btn-submit').prop('disabled', true)
        } else if (document.getElementById('BG-error').textContent === '' && document.getElementById('GG-error').textContent === '') {
            $('#btn-submit').prop('disabled', false);
        }


    }
    function matchYoutubeVideoUrl(url) {
        var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
        if(url.match(p)){
            return true;
        }
        return false;
    }

    function validateMeetLink(url) {
        var pattern = /^https:\/\/meet\.google\.com\/[a-z]{3}-[a-z]{4}-[a-z]{3}$/i;
        return pattern.test(url);
    }

    $(document).ready(function (){
        $('label[for="BG"]').hide()
        $('label[for="GG"]').hide()
        $('#BG').hide()
        $('#GG').hide()
        $('#btn-submit').prop('disabled', true)
        $('select').on('change', function (e){
            var subject = this.value;
            var classValue = $('#class').val()
            if(subject === ""){
                $('label[for="BG"]').hide()
                $('label[for="GG"]').hide()
                $('#BG').hide()
                $('#GG').hide()
                $('#btn-submit').prop('disabled', true)
            } else {
                $('label[for="BG"]').show()
                $('label[for="GG"]').show()
                $('#BG').show()
                $('#GG').show()
            }
            $.ajax({
                url: 'config/getElearningLink.php',
                type: 'POST',
                data: {class: classValue, subject: subject},
                success: function (data){
                    const obj = JSON.parse(data);
                    $('#BG').val(obj.BG)
                    $('#GG').val(obj.GG)
                }
            })
        })

        $()
    })
</script>
</body>
</html>
