<?php
$_SESSION['id'] = 1;
require_once 'include/auth.inc.php';
require_once '../config/con_db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <?php

    $title = "ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์";

    if (empty($_GET) || isset($_GET['main'])) {
        $show_title = 'หน้าแรก | ' . $title;
    } else if (isset($_GET['course'])) {
        $show_title = 'คอร์สเรียน  | ' . $title;
    } else if (isset($_GET['course_lesson'])) {
        $show_title = 'เพิ่มบทเรียน | ' . $title;
    } else if (isset($_GET['lesson'])) {
        $show_title = 'บทเรียน | ' . $title;
    } else if (isset($_GET['lesson_sub'])) {
        $show_title = 'บทเรียนย่อย | ' . $title;
    }else {
        echo 'error';
    }

    ?>

    <title><?= $show_title ?></title>

    <?php include 'include/header.inc.php'; ?>

</head>

<body class="mod-bg-1 mod-nav-link ">

    <div class="page-wrapper">
        <div class="page-inner">

            <?php include 'include/menu_left.inc.php'; ?>

            <div class="page-content-wrapper">

                <?php include 'include/menu_top.inc.php'; ?>

                <main id="js-page-content" role="main" class="page-content">

                    <?php
                    if (empty($_GET) || isset($_GET['main'])) {
                        include 'r1_main/main.php';
                    } else if (isset($_GET['course'])) {
                        include 'm1_course/course.php';
                    } else if (isset($_GET['course_lesson'])) {
                        include 'm1_course/course_lesson.php';
                    } else if (isset($_GET['lesson'])) {
                        include 'm2_course/lesson.php';
                    } else if (isset($_GET['lesson_sub'])) {
                        include 'm2_course/lesson_sub.php';
                    } else {
                        echo 'error';
                    }
                    ?>

                </main>

                <?php include 'include/footer.inc.php'; ?>

            </div>
        </div>
    </div>

    <?php include 'include/script.inc.php'; ?>



</body>

</html>