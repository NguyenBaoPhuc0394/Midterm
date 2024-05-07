<?php 
    session_start();
    require_once('Controller/process.php');
    $page_title = "Thông tin giáo viên";
    include("sidebar.php");
    include("header.php");
    echo('<link rel="stylesheet" href="css/teacher.css">');
    echo '<script src="js/teacher.js" defer></script>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>';
    $results = getTeachers();
?>

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Teacher Information</h3>
        </div>
        <div class="card-body">
            <div class="search-wrapper">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input class="search-input" type="search" id="search" placeholder="Search by teacher name">
                </div>
                <div class="search-dropdown">
                    <div class="dropdown" id="dropdown">
                        <div class="select" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-square-check"></i>
                            <!-- <input class="selected" type="" placeholder="Choose Subject"> -->
                            <span class="selected" style="color: gray;">Choose Subject</span>
                            <div class="caret"></div>
                        </div>
                        <ul class="dropdown-menu" id="dropdown-menu">
                            <!-- <li class="act"></li> -->
                            <li class="dropdown-item act csb">Choose Subject</li>
                            <?php  
                                $result = getSubjects();
                                foreach($result as $res){
                                    if($res['error'] == ''){
                                    echo '<li class="dropdown-item">'.$res['temon'].'</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <table class="table table-responsive table-bordered border-dark table-hover table-striped text-center text-capitalize">
                <thead>
                    <tr class="table-active text-uppercase text-white">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        if(count($results) > 0){
                            foreach($results as $result){
                                if($result['error'] == ''){
                                    $tenmon = getTenmon($result['mamon']);
                                    if($tenmon['error'] == ''){
                                        echo '<tr class="teacher">';
                                        echo "<td class='magv'>{$result['magv']}</td>";
                                        echo "<td class='hoten'>{$result['hoten']}</td>";
                                        echo "<td class='tenmon'>{$tenmon['tenmon']}</td>";
                                        echo "<td class='sdt'>{$result['sdt']}</td>";
                                        echo '</tr>';
                                    }
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
    include("footer.php");
?>