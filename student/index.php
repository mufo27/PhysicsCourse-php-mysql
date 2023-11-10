<?php 

  session_start();  
  
  if(isset($_SESSION['id']) == "")
  {

      echo "<meta http-equiv=\"refresh\" content=\"0; URL=../login/\">";
      exit();

  } else { 
               
    require_once '../config/con_db.php';

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

            if(empty($_GET)) {

                include('main.php');

            } else if(isset($_GET['main'])) {

                    include('main.php');

            } else if(isset($_GET['news'])) {

                include('news.php');

            } else if(isset($_GET['news_detail'])) {

                include('news_detail.php');

            } else if(isset($_GET['course'])) {

                include('course.php');

            } else if(isset($_GET['course_detail'])) {

                include('course_detail.php');

            } else if(isset($_GET['top_5'])) {

                include('top_5.php');

            } else if(isset($_GET['about'])) {

                include('about.php');

            } else if(isset($_GET['faq'])) {

                include('faq.php');

            } else if(isset($_GET['help'])) {

                include('help.php');

            } else if(isset($_GET['profile'])) {

                include('profile.php');

            } else if(isset($_GET['cr_course'])) {

                include('my-course/cr_course.php');

            } else if(isset($_GET['cr_course_detail'])) {

                include('my-course/cr_course_detail.php');

            } else if(isset($_GET['cr_sub_lesson'])) {

                include('my-course/cr_sub_lesson.php');

            } else if(isset($_GET['cr_lesson'])) {

                include('my-course/cr_lesson.php');

            } else if(isset($_GET['cr_query'])) {

                include('my-course/cr_query.php');

            } else if(isset($_GET['cr_report'])) {

                include('my-course/cr_report.php');

            } else if(isset($_GET['cr_exe'])) {

                include('my-course/cr_exe.php');

            } else if(isset($_GET['cr_quiz'])) {

                include('my-course/cr_quiz.php');

            } else if(isset($_GET['cr_quiz_start'])) {

                include('my-course/cr_quiz_start.php');

            } else if(isset($_GET['cr_quiz_sum_point'])) {

                include('my-course/cr_quiz_sum_point.php');

            } else if(isset($_GET['certificate'])) {

                include('certificate.php');

            } else {

                echo '<h1>ไม่พบหน้านี้</h1>';
            }
        ?>

    </main>

    <?php include('f.php'); ?>

</body>

</html>

<?php } ?>
