
<aside id="sidebar">
    <div class="d-flex">
        <button id="toggle-btn" type="button">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="sidebar-logo">
            <a href="Index.php"><i class="fa-solid fa-user-gear"></i> Admin</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="Index.php" class="sidebar-link">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li <?php echo $page_title =="student" ? "class='sidebar-item highlight active'" : "class='sidebar-item highlight'" ; ?>>
            <a href="#" class="sidebar-link has-dropdown collapsed item" data-bs-toggle="collapse" data-bs-target="#student"
               aria-expanded="false" aria-controls="student">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Student</span>
            </a>
            <ul id="student" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="Studentlist.php" class="sidebar-link">Student List</a>
                </li>
                <li class="sidebar-item">
                    <a href="Addstudent.php" class="sidebar-link">Add Student</a>
                </li>
            </ul>
        </li>
        <li <?php echo $page_title =="teacher" ? "class='sidebar-item highlight active'" : "class='sidebar-item highlight'" ; ?>>
            <a href="#" class="sidebar-link has-dropdown collapsed item" data-bs-toggle="collapse" data-bs-target="#teacher"
               aria-expanded="false" aria-controls="teacher">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Teacher</span>
            </a>
            <ul id="teacher" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="Teacherlist.php" class="sidebar-link">Teacher List</a>
                </li>
                <li class="sidebar-item">
                    <a href="Addteacher.php" class="sidebar-link">Add Teacher</a>
                </li>
            </ul>
        </li>
        <li <?php echo $page_title =="tuition" ? "class='sidebar-item highlight active'" : "class='sidebar-item highlight'" ; ?>>
            <a href="#" class="sidebar-link has-dropdown collapsed item" data-bs-toggle="collapse" data-bs-target="#tuition"
               aria-expanded="false" aria-controls="tuition">
                <i class="fa-solid fa-money-bills"></i>
                <span>Tuition</span>
            </a>
            <ul id="tuition" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="TuitionInfo.php" class="sidebar-link">Tuition info</a>
                </li>
                <li class="sidebar-item">
                    <a href="AddTuition.php" class="sidebar-link">Add/update tuition</a>
                </li>
                <li class="sidebar-item">
                    <a href="TuitionStatus.php" class="sidebar-link">Tuition status</a>
                </li>
            </ul>
        </li>
        <li <?php echo $page_title =="Result" ? "class='sidebar-item highlight active'" : "class='sidebar-item highlight'" ; ?>>
            <a href="#" class="sidebar-link has-dropdown collapsed item" data-bs-toggle="collapse" data-bs-target="#result"
               aria-expanded="false" aria-controls="result">
               <i class="fa-solid fa-square-poll-vertical"></i>
                <span>Result</span>
            </a>
            <ul id="result" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="StudyResult.php" class="sidebar-link">Study result</a>
                </li>
                <li class="sidebar-item">
                    <a href="EditResult.php" class="sidebar-link">Edit result</a>
                </li>
            </ul>
        </li>
        <li <?php echo $page_title =="elearning" ? "class='sidebar-item highlight active'" : "class='sidebar-item highlight'" ; ?>>
            <a href="Elearning.php" class="sidebar-link item">
                <i class="lni lni-graduation"></i>
                <span>Elearning</span>
            </a>
        </li>
        <li <?php echo $page_title =="timetable" ? "class='sidebar-item highlight active'" : "class='sidebar-item highlight'" ; ?>>
            <a href="Timetable.php" class="sidebar-link item">
                <i class="fa fa-table" aria-hidden="true"></i>
                <span>Timetable</span>
            </a>
        </li>
    </ul>
    <li class="sidebar-item">
        <a href="logout.php" class="sidebar-link">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <span>Log out</span>
        </a>
    </li>
</aside>