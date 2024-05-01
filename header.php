
<?php
    require_once('Controller/getInformation.php');
?>
<div class="main">
    <nav class="navbar navbar-expand px-4 py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="widget no-boder m-0">
                    <a href="index.php" style="text-decoration: none;">
                        <img src="images/school.png" alt="" style="padding-right: 10px;">
                        <label id="home">HOME</label>
                        <!-- <span id="home">HOME</span> -->
                    </a>
                </div>
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                <div id="studentName" style="color: #003C43;font-size: large;margin: 15px;font-weight: bold; position: relative;bottom: 5px;">
                    <span style="font-size: large;"><?php echo $infor['hoten'] ?></span>
                </div>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                        <img src="images/user.png" class="avatar img-fluid" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end rounded">
                        <a href="logout.php" class="dropdown-item">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                        <a href="Forgot.php" class="dropdown-item">
                            <i class="lni lni-cog"></i>
                            <span>Reset Password</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="lni lni-question-circle"></i>
                            <span>Question</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main class="main-content">