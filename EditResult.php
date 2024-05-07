<?php
    require 'config/process.php';
    $page_title = 'Result';

    session_start();
    $error = '';
    $message = '';
    if(isset($_POST['subject']) && isset($_FILES['resultFile'])){
        $subject = $_POST['subject'];
        $file = $_FILES['resultFile'];
        $fileTmpName = $file['tmp_name'];
        $dest = 'modal/ResultUpdate/update.xlsx';
        if(!move_uploaded_file($fileTmpName, $dest)){
            $error = 'error';
        }else{
            if(!executeResultUpdate($subject)){
                $error = 'error';
            }
            else{
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
                            <div class="col-md-12 mb-3 mt-3">
                                <label for="selectSubject" class="form-label">Subject</label>
                                <select class="form-select w-20" aria-label="Default select example" id="selectSubject" name="subject">
                                    <option selected="selected" value="">Chọn môn</option>
                                    <?php
                                    showSubjectValue();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="file" class="form-label">File</label>
                                <input type="file" class="form-control" id="file" name="resultFile" placeholder="Enter file">
                            </div>
                        </div>
                        <a onclick="getFormalFile()" id="download" style="color: #3b7ddd">Download format for tuition</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>
<script>
    $(document).ready(function (){
        $('#download').hide()
        updateButtonAvailability()
        $('#btn').prop('disabled', true)
        $('#selectSubject, #file').change(function() {
            updateButtonAvailability()
        });
        $('#selectSubject').change(function() {
            if ($(this).val() === '') {
                $('#download').hide()
            } else {
                $('#download').show()
            }
        });
    })

    function toArrBuffer(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }

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

    function updateButtonAvailability(){
        if ($('#selectSubject').val() === '' && $('#file').val() === '') {
            $('#btn').prop('disabled', true)
            $('#error').text('Please fill all field')
        } else if(!validateFile()){
            $('#btn').prop('disabled', true)
        } else {
            $('#btn').prop('disabled', false)
            $('#error').text('')
        }
    }

    function getFormalFile(){
        var subjectValue = $('#selectSubject').val()
        var subject = $('#selectSubject option:selected').text()
        if (subjectValue !== ''){
            $.ajax({
                url: 'config/getResultInfoToEdit.php',
                type: 'POST',
                data: { subjectValue: subjectValue},
                success: function (data){
                    var result = JSON.parse(data)
                    var book = XLSX.utils.book_new()
                    var sheet = XLSX.utils.json_to_sheet(result)
                    var firstRow = sheet['!ref'].split(':')[1]
                    sheet['A1'] = {v: subject , t: 's'};
                    sheet['B1'] = {v: '' , t: 's'};
                    sheet['C1'] = {v: '' , t: 's'};
                    sheet['D1'] = {v: '' , t: 's'};
                    sheet['E1'] = {v: '' , t: 's'};
                    sheet[firstRow].s = { font: { bold: true } }
                    sheet['!cols'] = [{wch: 10}, {wch: 40}, {wch: 10}, {wch: 10}, {wch: 10},]
                    XLSX.utils.book_append_sheet(book, sheet, 'ResultFormal')
                    var file = XLSX.write(book, { bookType: 'xlsx', type: 'binary'})
                    const blob = new Blob([toArrBuffer(file)], { type: "application/octet-stream" })
                    saveAs(blob, 'resultFormal.xlsx')
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            })

        }
    }


</script>
</body>
</html>
