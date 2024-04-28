
<?php 
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
            <div class="name-text">Nguyen Van A</div>
            <div class="email-text">student@gmail.com</div>
            <div class="learning-text">Student</div>
        </div>
      </div>
      <hr>
      <div class="student-details">
        <p class="info-line"><strong>Student ID:</strong> <span id="studentId">01</span></p>
        <p class="info-line"><strong>Class ID:</strong> <span id="classIdId">10A5</span></p>
        <p class="info-line"><strong>Phone Number:</strong> <span id="phoneNumber">09823222</span></p>
        <p class="info-line"><strong>Hometown:</strong> <span id="hometown">TP.HCM</span></p>
        <p class="info-line"><strong>Gender:</strong> <span id="gender">Male</span></p>
        <p class="info-line"><strong>Address:</strong> <span id="address">District 7, TP.HCM</span></p>
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