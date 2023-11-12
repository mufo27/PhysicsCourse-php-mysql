<?php
$_SESSION['id'] = 1;
require_once 'include/auth.inc.php';
require_once '../config/con_db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <!-- <title>หน้าแรก | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์</title> -->

    <title>คอร์สเรียน | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์</title>

    <!-- <title>เพิ่มบทเรียน | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์</title> -->

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
                    } 
                        if (isset($_GET['course'])) {
                            include 'm1_course/course.php';
                        } 
                        
                        if (isset($_GET['course_lesson'])) {
                            include 'm1_course/course_lesson.php';
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
