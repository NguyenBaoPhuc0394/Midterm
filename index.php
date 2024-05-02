<?php
    session_start();
    if($_SESSION['status']  !== 'login success' || !isset($_SESSION['maHS']) || !isset($_SESSION['status'])){
        header('Location: login.php');
        exit;
    }
    $page_title = 'Home';
    include("sidebar.php");
    include("header.php");
    include("home.php");
    include("footer.php");
?>