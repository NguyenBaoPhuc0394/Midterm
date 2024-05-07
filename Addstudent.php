<?php
    session_start();
    require 'config/process.php';
    $page_title = 'student';
    $error = '';
    $message = '';
    if(isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['phoneNumber']) && isset($_POST['hometown']) && isset($_POST['class']) && isset($_POST['address']) && isset($_POST['email'])){
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $phoneNumber = $_POST['phoneNumber'];
        $hometown = $_POST['hometown'];
        $class = $_POST['class'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $result = addStudent($name, $gender, $phoneNumber, $hometown, $class, $address, $email);
        if($result['error'] != ''){
            $error = 'Error';
        }
        else{
            $message = 'Success';
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
                <div class="container-fluid add-student">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 my-3">Add Student</h3>
                        <form action="" method="post">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter first name">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="optionGender" class="form-label">Gender</label>
                                    <select class="form-select" id="optionGender" name="gender">
                                        <option selected value="">Choose gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input name="phoneNumber" type="text" class="form-control" id="phoneNumber" placeholder="Enter phone number">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="hometown" class="form-label">Home Town</label>
                                    <input name="hometown" type="text" class="form-control" id="hometown" placeholder="Enter hometown">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="optionClass" class="form-label">Class</label>
                                    <select class="form-select" id="optionClass" name="class">
                                        <option selected value="">Choose class</option>
                                        <?php
                                            showClassValue();
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address ">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email ">
                            </div>
                            <div class="row justify-content-end a">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-dark mt-1">Add</button>
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
</body>
</html>

