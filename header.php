
<?php
    require_once('Controller/process.php');
    if(isset($_SESSION['status']) && $_SESSION['status'] == 'login success'){
        $id = $_SESSION['maHS'];
        $infor = getInformation($id);
    }
?>
<style>
    .date{
        color: lime;
        font-weight: bold;
        /* border: 1px solid white; */
        padding: 5px;
        font-size: large;
        margin-left: 270px;
    }
</style>
<div class="main">
    <nav class="navbar navbar-expand px-4 py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="widget no-boder m-0">
                    <a href="index.php" style="text-decoration: none;">
                        <!-- <img src="images/school.png" alt="" style="padding-right: 10px;"> -->
                        <i class="fa-solid fa-school" style="color: green; font-size: 40px;"></i>
                        <label id="home">HOME</label>
                        <!-- <span id="home">HOME</span> -->
                    </a>
                </div>
            </div>
        </div>
        <div class="date">

        </div>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                <div id="studentName" style="color: white;font-size: large;margin: 15px;font-weight: bold; position: relative;bottom: 5px;">
                    <span style="font-size: large;"><?php echo $infor['hoten'] ?></span>
                </div>
                <li class="nav-item dropdown" id="userAvatar">
                    <a href="#" class="nav-icon pe-md-0" data-bs-toggle="dropdown">
                        <!-- <img src="images/user.png" class="avatar img-fluid" alt=""> -->
                        <i class="fa-regular fa-circle-user" style="font-size: 35px;color: green;" id="avatar"></i>
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
                        <a href="changePassword.php" class="dropdown-item">
                            <i class="lni lni-question-circle"></i>
                            <span>Question</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main class="main-content">

<script>
    let time =document.querySelector(".date");
    let today = new Date();
    let month = today.getMonth() + 1;
    let year = today.getFullYear();
    let date = today.getDate();
    let current = `${date} - ${month} - ${year}`;
    time.innerHTML = current;

</script>