<?php 
  session_start();
  $page_title = "E-Learning";
  require_once('../Controller/getElearning.php');
  include("sidebar.php");
  include("header.php");
  echo '<link rel="stylesheet" href="../css/elearning.css">';
  echo '<script src="../js/elearning.js" defer></script>';
?>
<div class="container mt-5" id="elearning">
    <div class="row">
      <div class="col">
      <div class="card student-info-card">
      <div class="card-header">
        <h4 class="mb-3">E-LEARNING</h4>
      </div>
      <div class="card-body">
        <div class="subject">
          <h6><strong>Môn học</strong></h6>
          <div class="dropdown" id="dropdown">
            <div class="select">
              <span class="selected" style="color: gray;">Chọn môn học</span>
              <div class="caret"></div>
            </div>
            <ul class="menu">
                <!-- <li class="act"></li> -->
                <li>Toan</li>
                <li>Van</li>
                <li>Ly</li>
                <li>Hoa</li>
                <li>Sinh Hoc</li>
                <li>Su</li>
                <li>Dia</li>
                <li>Tin Hoc</li>
            </ul>
          </div>
        </div>
        <div class="linkBG">
          <div class="label">
            <h6><strong>Link bài giảng</h6></span>
          </div>
          <div class="copy-text">
            <input type="text" class='text' id="linkBG">
            <button>
              <i class='fa fa-clone'></i>
            </button>
          </div>
        </div>
        <div class="linkOnl">
          <div class="label">
            <h6><strong>Link học online</h6></span>
          </div>
          <div class="copy-text">
            <input type="text" class='text' id="linkOnl">
            <button>
              <i class='fa fa-clone'></i>
            </button>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
</div>

<?php 
  include("footer.php");
?>