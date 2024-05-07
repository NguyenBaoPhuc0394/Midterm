<?php
    require 'config/process.php';
    session_start();
    $page_title = 'timetable';
    $error = '';
    $message = '';
    if(isset($_POST['classEdit']) && isset($_FILES['file'])){
        $file = $_FILES['file'];
        $class = $_POST['classEdit'];
        $fileTmpName = $file['tmp_name'];
        $dest = 'modal/timetable/'. $class . '.xlsx';
        if (move_uploaded_file($fileTmpName, $dest)) {
            $message = 'success';
        } else {
            $error = 'fail';
        }
        if (file_exists($fileTmpName)) {
            unlink($fileTmpName);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="css/Admin.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
        #editModal{
            margin-top: 100px;
        }
        #download{
            text-decoration: none;
            margin-top: 10px;
            display: flex;
        }
        .error{
            margin-top: 1px;
            color: #DC4C64;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
    include 'Sidebar.php';
    ?>
    <div class="main">
        <main class="content px-3 py-4">
            <div class="container">
                <h3 class="fw-bold fs-4 my-3">Timetable</h3>
                <div class="d-flex justify-content-end mb-3">
                    <select class="form-select w-25" aria-label="Default select example">
                        <option selected = "selected" value="">Choose class</option>
                        <?php
                        showClassValue();
                        ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-10 mx-auto mt-5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Class period</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end a">
                    <div class="col-md-2">
                        <button id="edit" type="button" class="btn btn-dark mt-1" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include 'Footer.php';
        ?>
    </div>
</div>
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit TimeTable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body">
                <form method="post" id="editTimeTable" action="" novalidate enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="classEdit" class="mb-1">Class</label>
                        <input readonly name="classEdit" required class="form-control" type="text" id="classEdit">
                    </div>
                    <div class="form-group mb-3">
                        <label for="file" class="mb-1">Timetable file</label>
                        <input name="file" required class="form-control" type="file" id="file" onchange="validateFile()" placeholder="">
                </form>
                <a href="modal/timetable/FormalTimeTable.xlsx" id="download" download>Download format for timetable</a>
                <div class="error" id="error"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button form="editTimeTable" type="submit" class="btn btn-success" id="editTimeTable-btn" disabled>Save</button>
            </div>
        </div>
        <?php
        if (!empty($error)) {
            echo "<script> showError(); </script>";
        } else if (!empty($message)) {
            echo "<script> showSuccess(); </script>";
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/Admin.js"></script>
<script>
    function validateFile() {
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.xlsx)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#error').text('Please upload xlsx file')
            return false;
        }
        $('#error').text('')
        $('#editTimeTable-btn').prop('disabled', false)
        return true;
    }

    $(document).ready(function() {
        $('#edit').hide()
        $('select').change(function() {
            var value = $(this).val();
            $('tbody').empty();
            if (value === ""){
                $('#edit').hide()
            } else{
                $('#edit').show()
            }
            $('#classEdit').val(value);
            $.ajax({
                url: 'config/showTimeTable.php',
                type: 'POST',
                data: { data: value },
                success: function(data) {
                    var obj = JSON.parse(data)
                    obj.forEach(function (element){
                        for (var i = 0; i < element.length; i++) {
                            if (element[i] === null) {
                                element[i] = '';
                            }
                        }
                        $('tbody').append("<tr>" +
                            "<td>" + element[0] + "</td>" +
                            "<td>" + element[1] + "</td>" +
                            "<td>" + element[2]  + "</td>" +
                            "<td>" + element[3]  + "</td>" +
                            "<td>" + element[4]  + "</td>" +
                            "<td>" + element[5]  + "</td>" +
                            "<td>" + element[6]  + "</td>" +
                            "</tr>")
                    })
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            });
        });

    });
</script>
</body>
</html>



