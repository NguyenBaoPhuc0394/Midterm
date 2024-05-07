<?php
    session_start();
    $page_title = 'student';
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
                        <h3 class="fw-bold fs-4 my-0">Student List</h3>
                        <div class="d-flex justify-content-end mb-3">
                            <select class="form-select w-25" aria-label="Default select example">
                                <option selected = "selected" value="all">Tat ca lop</option>
                                <?php
                                    showClassValue();
                                ?>
                            </select>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <table class="table table-striped text-center">
                                    <thead>
                                      <tr class="highlight">
                                            <th scope="col">Class</th>
                                            <th scope="col" class="toSort">Name</th>
                                            <th scope="col">Details</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        showAllStudent();
                                    ?>
                                    </tbody>
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
        var reverse = null;
        $(document).ready(function() {
            $('select').change(function() {
                var value = $(this).val();
                $('tbody').empty();
                $.ajax({
                    url: 'config/showStudent.php',
                    type: 'POST',
                    data: { data: value },
                    success: function(data) {
                        const obj = JSON.parse(data);
                        obj.forEach((element) => {
                            $('tbody').append("<tr>" +
                                "<td>" + element.Lop + "</td>" +
                                "<td>" + element.HoTen + "</td>" +
                                "<td><a type='button' class='btn btn-sm btn-secondary' href='StudentInfo.php?id=" + element.maHS + "'>Info</a></td></tr>"+
                                "</tr>");
                        });
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                });
            });
            $('.toSort').click(function (){
                var names = [];
                const elements = [];
                const rows = document.querySelectorAll('table tbody tr');
                rows.forEach(function(row) {
                    names.push(row.querySelector('td:nth-child(2)').innerHTML)
                    elements.push({classValue: row.querySelector('td:nth-child(1)').innerHTML, name: row.querySelector('td:nth-child(2)').innerHTML, button: row.querySelector('td:nth-child(3)').outerHTML})
                })
                names.sort(function(a, b) {
                    const lastWordA = a.split(' ').pop().toLowerCase();
                    const lastWordB = b.split(' ').pop().toLowerCase();
                    return lastWordA.localeCompare(lastWordB);
                })
                if (reverse == null){
                    reverse = false
                    $('.toSort').text('Name ▽');
                }else if(reverse === false){
                    names.reverse()
                    reverse = true
                    $('.toSort').text('Name △');
                } else if(reverse === true){
                    reverse = false
                    $('.toSort').text('Name ▽');
                }
                $('tbody').empty();
                names.forEach(function (n){
                  elements.forEach(function (element){
                      if(element.name === n){
                          $('tbody').append("<tr>" +
                              "<td>" + element.classValue + "</td>" +
                              "<td>" + element.name + "</td>" +
                              element.button + "</tr>")
                      }
                    })
                })
            })
        });
    </script>
</body>
</html>

