<?php
    session_start();
    $page_title = 'home';
    require 'config/process.php';
    if($_SESSION['status'] != 'login success admin'){
        header('Location: login.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/Admin.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <?php include 'Sidebar.php' ?>
        <div class="main">
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Student
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            <?php echo getNumOfStudent();?>
                                        </p>
                                        <!-- <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since last year
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Teacher
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            <?php echo getNumOfTeacher();?>
                                        </p>
                                        <!-- <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since last year
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card border-0">
                                    <div class="card-body py-4">
                                        <h5 class="mb-2 fw-bold">
                                            Users
                                        </h5>
                                        <p class="mb-2 fw-bold">
                                            <?php echo getNumOfUser();?>
                                        </p>
                                        <!-- <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9.0%
                                            </span>
                                            <span class="fw-bold">
                                                Since last year
                                            </span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<h3 class="fw-bold fs-4 my-3">New Student List</h3>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                      <tr class="highlight">
                                        <th scope="col">STT</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@gmail.com</td>
                                        <td>
                                            <button type="button" class="btn border-0 rounded-0" onclick="editStudent(1)">Edit</button>
                                            <button type="button" class="btn border-0 rounded-0" onclick="deleteStudent(1)">Delete</button>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@gmail.com</td>
                                        <td>
                                            <button type="button" class="btn border-0 rounded-0" onclick="editStudent(1)">Edit</button>
                                            <button type="button" class="btn border-0 rounded-0" onclick="deleteStudent(1)">Delete</button>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th scope="row">3</th>
                                        <td>Lionel</td>
                                        <td>Messi</td>
                                        <td>lionelmessi@gmail.com</td>
                                        <td>
                                            <button type="button" class="btn border-0 rounded-0" onclick="editStudent(1)">Edit</button>
                                            <button type="button" class="btn border-0 rounded-0" onclick="deleteStudent(1)">Delete</button>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                        </div>-->
                    </div>
                </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start">
                        </div>
                        <div class="col-6 text-end text-body-secondary d-none d-md-block">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="AboutUs.php" target="_blank" class="text-body-secondary">About us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/Admin.js"></script>
</body>
</html>

