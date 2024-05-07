<?php
session_start();
$page_title = 'Result';
require 'config/process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Result</title>
    <link rel="stylesheet" href="css/Admin.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>
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
                    <h3 class="fw-bold fs-4 my-0">Study Result</h3>
                    <div class="d-flex justify-content-center mb-3 mt-4">
                        <select class="form-select w-20 me-2" aria-label="Default select example" style="width: 120px" id="selectClass">
                            <option selected="selected" value="all">Tất cả lớp</option>
                            <?php
                            showClassValue();
                            ?>
                        </select>
                        <select class="form-select w-20" aria-label="Default select example" style="width: 150px" id="selectSubject">
                            <option selected="selected" value="">Chọn môn</option>
                            <?php
                            showSubjectValue();
                            ?>
                        </select>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <table class="table table-striped text-center" id="table">
                                <thead>
                                <tr class="highlight">
                                    <th scope="col">Tên</th>
                                    <th scope="col">Quá trình</th>
                                    <th scope="col">Giữa kì</th>
                                    <th scope="col">Cuối kỳ</th>
                                    <th scope="col" id="toSort">Trung bình</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end a">
                    <div class="col-md-2">
                        <button id="export" type="button" class="btn btn-dark mt-1" onclick="exportDate()">Export</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script>
<script>
    function toArrBuffer(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    function exportDate(){
        var table = document.getElementById('table')
        var book = XLSX.utils.table_to_book(table)
        XLSX.utils.book_append_sheet(book, book.Sheets['Data'], 'Data')
        var file = XLSX.write(book, { bookType: 'xlsx', type: 'binary'})
        var sfe = window.saveAs
        const blob = new Blob([toArrBuffer(file)], { type: "application/octet-stream" });
        sfe(blob, 'data.xlsx')
    }

    $(document).ready(function (){
        $('#export').hide()
        $('select').change(function (){
            var subjectValue = $('#selectSubject').val()
            var classValue = $('#selectClass').val()
            if (subjectValue === ""){
                $('tbody').empty()
                $('#export').hide()
            }else{
                $('tbody').empty()
                $('#export').show()
                $.ajax({
                    url: 'config/showResult.php',
                    type: 'POST',
                    data: { classValue: classValue, subjectValue: subjectValue},
                    success: function (data){
                        const obj = JSON.parse(data);
                        obj.forEach((element) => {
                            $('tbody').append("<tr>" +
                                "<td>" + element[0] + "</td>" +
                                "<td>" + element[1] + "</td>" +
                                "<td>" + element[2] + "</td>" +
                                "<td>" + element[3] + "</td>" +
                                "<td>" + element[4] + "</td>" +
                                "</tr>");
                        });
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    }
                })
            }
        })
        let reverse = null
        $('#toSort').click(function (){
            var elements = []
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function(row) {
                if(row.querySelector('td:nth-child(1)').innerHTML === '_'){
                    elements.push({name: row.querySelector('td:nth-child(1)').innerHTML, qt: row.querySelector('td:nth-child(2)').innerHTML, gk: row.querySelector('td:nth-child(3)').innerHTML, ck: row.querySelector('td:nth-child(4)').innerHTML, tb: -1})
                }
                else{
                    elements.push({name: row.querySelector('td:nth-child(1)').innerHTML, qt: row.querySelector('td:nth-child(2)').innerHTML, gk: row.querySelector('td:nth-child(3)').innerHTML, ck: row.querySelector('td:nth-child(4)').innerHTML, tb: row.querySelector('td:nth-child(5)').innerHTML})
                }
            })
            elements.sort(function (a, b){
                return a.tb - b.tb
            })
            if(reverse == null){
                reverse = false
                $('#toSort').text('Trung bình ▽')
            } else if(reverse === false){
                reverse = true
                elements.reverse()
                $('#toSort').text('Trung bình △')
            }else if(reverse === true) {
                reverse = false
                $('#toSort').text('Trung bình ▽')
            }
            $('tbody').empty()
            elements.forEach(function (element) {
                var row = "<tr>" +
                    "<td>" + element.name + "</td>" +
                    "<td>" + element.qt + "</td>" +
                    "<td>" + element.gk + "</td>" +
                    "<td>" + element.ck + "</td>";

                if (element.tb === -1) {
                    row += "<td>" + "_" + "</td>";
                } else {
                    row += "<td>" + element.tb + "</td>";
                }

                row += "</tr>";
                $('tbody').append(row);
            });

        })
    })

</script>
</body>
</html>

