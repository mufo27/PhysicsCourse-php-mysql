<?php
session_start();

require_once 'config/con_db.php';
?>

<!doctype html>
<html lang="en">

<head>

    <?php include('h.php'); ?>

</head>

<body class="bg-light">


    <?php include('menu_top.php'); ?>

    <main class="container my-5">

        <?php

        if (empty($_GET)) {

            include('main.php');
        } else if (isset($_GET['main'])) {

            include('main.php');
        } else if (isset($_GET['news'])) {

            include('news.php');
        } else if (isset($_GET['news_detail'])) {

            include('news_detail.php');
        } else if (isset($_GET['course'])) {

            include('course.php');
        } else if (isset($_GET['course_detail'])) {

            include('course_detail.php');
        } else if (isset($_GET['top_5'])) {

            include('top_5.php');
        } else if (isset($_GET['about'])) {

            include('about.php');
        } else if (isset($_GET['faq'])) {

            include('faq.php');
        } else if (isset($_GET['help'])) {

            include('help.php');
        } else {

            echo '<h1>ไม่พบหน้านี้</h1>';
        }
        ?>

    </main>

    <?php include('f.php'); ?>
    
</body>

</html>