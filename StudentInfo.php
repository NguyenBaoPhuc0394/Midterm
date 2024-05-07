<?php
    $page_title = 'student';
    session_start();
    require 'config/process.php';
    $result = array();

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $result = getStudentDataByID($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="css/Admin.css">
    <link rel="stylesheet" href="css/information.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .back-btn{
            padding: 10px 20px;
            color: black;
            text-decoration: none;
            margin-top: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <?php
    include 'Sidebar.php';
    ?>
    <div class="main">
        <a class="back-btn" href="Studentlist.php">< Back</a>
        <main class="content px-3 py-4">
            <div class="container-fluid">
                <div class="container mt-0">
                    <div class="card student-info-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" style="color: black">Student Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center pb-3">
                                <img src="images/student.png" class="rounded-circle student-avatar me-3" alt="Student Avatar">
                                <div class="student-info-text-container">
                                    <div class="name-text"></div>
                                    <div class="email-text"></div>
                                    <div class="learning-text"><?php echo $result['HoTen']?></div>
                                </div>
                            </div>
                            <hr>
                            <div class="student-details">
                                <p class="info-line"><strong>Student ID:</strong> <span id="studentId"><?php echo $result['maHS']?></span></p>
                                <p class="info-line"><strong>Class ID:</strong> <span id="classIdId"><?php echo $result['Lop']?></span></p>
                                <p class="info-line"><strong>Phone Number:</strong> <span id="phoneNumber"><?php echo $result['SDT']?></span></p>
                                <p class="info-line"><strong>Hometown:</strong> <span id="hometown"><?php echo $result['QQ']?></span></p>
                                <p class="info-line"><strong>Gender:</strong> <span id="gender"><?php echo $result['GT']?></span></p>
                                <p class="info-line"><strong>Address:</strong> <span id="address"><?php echo $result['DC']?></span></p>
                            </div>
                            <div class="mt-auto justify-content-end d-flex">
                                <a type="button" class="btn btn-secondary" href="editStudent.php?id=<?php echo $result['maHS'];?>">Edit</a>
                            </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/Admin.js"></script>
<script>
</script>
</body>
</html>


