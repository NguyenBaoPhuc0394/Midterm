
<?php 
  session_start();
  require_once('../Controller/getInformation.php');
  $page_title = "Thông Tin";
  include("sidebar.php");
  include("header.php");
  echo('<link rel="stylesheet" href="../css/Information.css">');
?>

<div class="container mt-5">
  <div class="card student-info-card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Student Information</h5>
      <!-- <button class="btn btn-primary">Save</button> -->
    </div>
    <div class="card-body">
      <div class="d-flex align-items-center pb-3">
        <img src="../images/student.png" class="rounded-circle student-avatar me-3" alt="Student Avatar">
        <div class="student-info-text-container">
            <div class="name-text"><?php echo $infor['hoten'] ?></div>
            <div class="email-text"><?php echo $infor['Email'] ?></div>
            <div class="learning-text">Student</div>
        </div>
      </div>
      <hr>
      <div class="student-details">
        <p class="info-line"><strong>Student ID:</strong> <span id="studentId"><?php echo $infor['maHS'] ?></span></p>
        <p class="info-line"><strong>Class ID:</strong> <span id="classIdId"><?php echo $infor['maLop'] ?></span></p>
        <p class="info-line"><strong>Phone Number:</strong> <span id="phoneNumber"><?php echo $infor['SDT'] ?></span></p>
        <p class="info-line"><strong>Hometown:</strong> <span id="hometown"><?php echo $infor['quequan'] ?></span></p>
        <p class="info-line"><strong>Gender:</strong> <span id="gender"><?php echo $infor['gioitinh'] ?></span></p>
        <p class="info-line"><strong>Address:</strong> <span id="address"><?php echo $infor['diachi'] ?></span></p>
      </div>
    </div>
  </div>
</div>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->

<!-- </body>
</html> -->
<?php 
  include("footer.php");
?>