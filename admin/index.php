<?php
require_once('include/auth.inc.php');
require_once('../config/con_db.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>

        เพิ่มบทเรียน | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์

    </title>

    <?php //include('include/header.inc.php') ?>

    <meta name="description" content="Basic">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">

    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="msapplication-tap-highlight" content="no">

    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../assets/dist/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="../assets/dist/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="../assets/dist/css/skins/skin-master.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../my-img/logo-5.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../my-img/logo-5.png">
    <link rel="mask-icon" href="../my-img/logo-5.png" color="#5bbad5">

    <link rel="stylesheet" href="include/style.css">
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    


</head>

<body class="mod-bg-1 mod-nav-link ">

    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">

            <?php include('include/menu_left.inc.php'); ?>

            <div class="page-content-wrapper">

                <?php include('include/menu_top.inc.php'); ?>

                <!-- BEGIN Page Content -->
                <main id="js-page-content" role="main" class="page-content">
                    
                         
                <?php

                    if (empty($_GET)) {
                        include('main/main.php');
                    }
                        if (isset($_GET['main'])) {
                            include('main/main.php');
                        }

                        if (isset($_GET['main'])) {
                            include('main/main.php');
                        }

                        if (isset($_GET['main'])) {
                            include('main/main.php');
                        }

                        if (isset($_GET['main'])) {
                            include('main/main.php');
                        }
                    
                ?>


                </main>
                <!-- END Page Content -->


                <?php include('include/footer.inc.php'); ?>

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <script src="assets/dist/js/vendors.bundle.js"></script>
    <script src="assets/dist/js/app.bundle.js"></script>

</body>
<!-- END Body -->

</html>