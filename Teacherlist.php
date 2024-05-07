<?php
    session_start();
    $page_title = 'teacher';
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
                    <h3 class="fw-bold fs-4 my-3">Teacher List</h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr class="highlight">
                                    <th scope="col">Name</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    showAllTeacher();
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
</body>
</html>

