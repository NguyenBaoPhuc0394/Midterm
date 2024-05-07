<?php
session_start();
$page_title = 'tuition';
require 'config/process.php';
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
    <style>
        tfoot tr:first-child,
        tbody tr:last-child {
            border-bottom: 1px solid #ddd;
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
            <div class="container-fluid">
                <div class="mb-3">
                    <h3 class="fw-bold fs-4 my-3">Tuition Status</h3>
                    <div class="d-flex justify-content-end mb-3">
                        <select class="form-select w-25" id="select-date" aria-label="Select" style="margin-right: 10px">
                            <option selected = "selected" value="">Choose date</option>
                            <?php
                            showDateValueOfTuition();
                            ?>
                        </select>
                        <select class="form-select w-25" id="select-class" aria-label="Select">
                            <option selected = "selected" value="">Choose class</option>
                            <?php
                            showClassValue();
                            ?>
                        </select>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr class="highlight">
                                    <th scope="col">StudentID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        include 'Footer.php';
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/Admin.js"></script>
<script>
    $(document).ready(function() {
        $('select').change(function() {
            var valueClass = $('#select-class').val()
            var valueDate = $('#select-date').val()
            $('tbody').empty();

            if(valueClass !== '' && valueDate !== ''){
                $.ajax({
                    url: 'config/showTuitionStatus.php',
                    type: 'POST',
                    data: { class: valueClass, date: valueDate },
                    success: function(data) {
                        var obj = JSON.parse(data)
                        obj.forEach(function (element){
                            $('tbody').append("<tr>" +
                                "<td>" + element[0] + "</td>" +
                                "<td>" + element[1] + "</td>" +
                                "<td>" + valueClass + "</td>" +
                                "<td>" + valueDate + "</td>" +
                                "<td>" + element[2] + "</td>" +
                                "<td><button type='button' class='btn btn-dark change-btn'>Change</button></td>"+
                                "</tr>")
                        })
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                });
            }
        });
        $(document).on('click', '.change-btn', function() {
            var id = $(this).closest('tr').find('td:first-child').text()
            var valueClass = $('#select-class').val()
            var valueDate = $('#select-date').val()
            var status = $(this).closest('tr').find('td:nth-child(5)').text()
            var button = $(this)
            $.ajax({
                url: 'config/changeTuitionStatus.php',
                type: 'POST',
                data: { id: id, date: valueDate, class: valueClass, status: status },
                success: function(data) {
                    var obj = JSON.parse(data)
                    if(obj.error === ""){
                        if(status === 'Not done'){
                            button.closest('tr').find('td:nth-child(5)').text('Done')
                        }else if(status === 'Done'){
                            button.closest('tr').find('td:nth-child(5)').text('Not done')
                        }
                    }
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            })

        });
    });
</script>
</body>
</html>

