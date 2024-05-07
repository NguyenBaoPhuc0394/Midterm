<?php 
    $page_title = "Home";
    require_once('Controller/process.php');
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
        $id = $_SESSION['maHS'];
        $infor = getInformation($id);
    }
?>

<link rel="stylesheet" href="css/home.css">

<div class="utility">
    <div class="utility-header">
        <h4>TRANG CHỦ</h4>
    </div>
    <div class="utility-body">
        <div class="profile-container">
            <div class="personal-info">
                <h2>Thông tin cá nhân</h2>
                <p><strong>Tên:</strong> <?php echo($infor['hoten']) ?></p>
                <p><strong>Lớp:</strong> <?php echo($infor['maLop']) ?></p>
            </div>
            <div class="actions">
                <a href="score.php">
                    <div class="action-button new-action1">
                        <div class="icon"><img src="images/scores.png" alt="Điểm số"></div>
                        <div class="title">Điểm số</div>
                    </div>
                </a>
                <a href="Elearning.php">
                    <div class="action-button new-action2">
                        <div class="icon"><img src="images/E-learning.png" alt="E-Learning"></div>
                        <div class="title">E-Learning</div>
                    </div>
                </a>
                <a href="Tuition.php">
                    <div class="action-button change-class">
                        <div class="icon"><img src="images/tuition.png" alt="Học Phí"></div>
                        <div class="title">Học Phí</div>
                    </div>
                </a>
                <a href="TimeTable.php">
                    <div class="action-button logout">
                        <div class="icon"><img src="images/calendar.png" alt="Thời Khóa Biểu"></div>
                        <div class="title">Thời Khóa Biểu</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="video-container">
            <video controls width="100%" height="auto">
                <source src="video/st3.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</div>

