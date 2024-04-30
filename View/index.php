<?php
    session_start();
    $page_title = 'home';
    require '../Model/process.php';
    if($_SESSION['status'] != 'login success'){
        header('Location: ../View/login.php');
    }
    $page_title = 'Home';
    include("sidebar.php");
    include("header.php");
    include("home.php");
    include("footer.php");
?>