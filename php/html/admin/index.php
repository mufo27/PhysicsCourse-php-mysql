<?php
$_SESSION['id'] = 1;

// require_once 'include/auth.inc.php';
// require_once '../config/con_db.inc.php';

require_once 'include' . DIRECTORY_SEPARATOR . 'auth.inc.php';
require_once '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'con_db.inc.php';
require_once 'include' . DIRECTORY_SEPARATOR . 'function.inc.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

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

                    switch (true) {
                        case (empty($_GET) || isset($_GET['main'])):
                            include 'r1_main/main.php';
                            break;
                        case isset($_GET['course']):
                            include 'm1_course/course.php';
                            break;
                        case isset($_GET['course_lesson']):
                            include 'm1_course/course_lesson.php';
                            break;
                        case isset($_GET['lesson']):
                            include 'm2_lesson/lesson.php';
                            break;
                        case isset($_GET['lesson_sub']):
                            include 'm2_lesson/lesson_sub.php';
                            break;
                        case isset($_GET['quiz']):
                            include 'm3_quiz/quiz.php';
                            break;

                        case isset($_GET['exe']):
                            include 'm4_exe/exe.php';
                            break;

                        case isset($_GET['class_room']):
                            include 'm5_class_room/class_room.php';
                            break;

                        default:
                            echo 'error: Include Page';
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