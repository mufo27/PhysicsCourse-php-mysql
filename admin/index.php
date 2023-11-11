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

    <?php include('include/header.inc.php') ?>


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