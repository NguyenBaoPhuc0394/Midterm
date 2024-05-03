
<?php 
  session_start();
  require_once('Controller/process.php');
  $page_title = "Thông Tin";
  include("sidebar.php");
  include("header.php");
  echo('<link rel="stylesheet" href="css/Information.css">');
  if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
    $id = $_SESSION['maHS'];
    $infor = getInformation($id);
  }
?>

<div class="container mt-5">
  <div class="card student-info-card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h3 class="mb-0">Student Information</h3>
      <!-- <button class="btn btn-primary">Save</button> -->
    </div>
    <div class="card-body">
      <div class="d-flex align-items-center pb-3" id="InforHeader">
        <div class="imageStudent">
          <img src="images/student.png" class="rounded-circle student-avatar me-3" alt="Student Avatar" id="studentAvatar">
          <label for="input-file" id="labelFile">
            <i class="fa-solid fa-user-plus"></i>
            Update Image
          </label>
          <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file">
        </div>
        <div class="student-details">
          <i class="fa-solid fa-circle-info"></i>
          <span style="font-weight: bold;font-size: 20px;">Details</span>
          <hr style="width: 100%;">
          <p class="info-line"><strong>Name:</strong> <span id="name-text"><?php echo $infor['hoten'] ?></span></p>
          <p class="info-line"><strong>Student ID:</strong> <span id="studentId"><?php echo $infor['maHS'] ?></span></p>
          <p class="info-line"><strong>Class ID:</strong> <span id="classIdId"><?php echo $infor['maLop'] ?></span></p>
          <p class="info-line"><strong>Hometown:</strong> <span id="hometown"><?php echo $infor['quequan'] ?></span></p>
          <p class="info-line"><strong>Gender:</strong> <span id="gender"><?php echo $infor['gioitinh'] ?></span></p>
          <p class="info-line"><strong>Address:</strong> <span id="address"><?php echo $infor['diachi'] ?></span></p>
        </div>
      </div>
      <hr>
      <div class="detail">
        
        <div class="student-info-text-container">
          <i class="fa-solid fa-address-card"></i>
          <span style="font-weight: bold;font-size: 20px;">Contact</span>
          <hr style="width: 100%;">
            <div id="copy-text">
              <i class="fa-solid fa-envelope"></i>
              <span id="tooltiptext">Copy</span>
              <span class="email-text" onclick="copyText()"><?php echo $infor['Email'] ?></span>
            </div>
            <div class="phone">
              <i class="fa-solid fa-mobile-screen-button"></i>
              <span id="phoneNumber"><?php echo $infor['SDT'] ?></span>
            </div>
            <!-- <div class="learning-text">Student</div> -->
        </div>
        <div class="shared">
          <div id="share">
            <i class="fa-solid fa-square-pen"></i>
            About me
          </div>
          <hr style="color: white;">
          <textarea name="" id="textarea" cols="30" rows="10"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let profilePic = document.getElementById('studentAvatar');
  let inputFile = document.getElementById('input-file');
  inputFile.onchange =function(){
    profilePic.src = URL.createObjectURL(inputFile.files[0]);
  }
  // $('#studentAvatar').src = profilePic.src;
  // var uploaded = "";
  // inputFile.addEventListener("change",function(){
  //   const reader = new FileReader();
  //   reader.addEventListener("load",()=>{
  //     uploaded = reader.result;
  //     profilePic.style.backgroundImage = `url(${uploaded}`;
  //   })
  //   reader.readAsDataURL(this.files[0]);
  // })
  function copyText() {
    var text = document.getElementById("copy-text"); 
    var emailText = text.querySelector(".email-text"); 

    var tempTextarea = document.createElement("textarea");
    tempTextarea.value = emailText.innerText; 
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    document.execCommand("copy");
    document.body.removeChild(tempTextarea);
    var tooltext = text.querySelector('#tooltiptext');
    tooltext.innerHTML = "Copied";
    setTimeout(function() {
      tooltext.innerHTML = "Copy";
    }, 1000);
}

</script>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> -->

<!-- </body>
</html> -->
<?php 
  include("footer.php");
?>