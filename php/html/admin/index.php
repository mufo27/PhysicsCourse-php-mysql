<?php

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

    <?php require_once 'include/header.inc.php'; ?>

</head>

<body class="mod-bg-1 mod-nav-link ">

    <div class="page-wrapper">
        <div class="page-inner">

            <?php require_once 'include/menu_left.inc.php'; ?>

            <div class="page-content-wrapper">

                <?php require_once 'include/menu_top.inc.php'; ?>

                <main id="js-page-content" role="main" class="page-content">

                    <?php
                    if (empty($_GET) || isset($_GET['main'])) {
                        require_once 'r1_main/main.php';
                    } elseif (isset($_GET['course'])) {
                        require_once 'm1_course/course.php';
                    } elseif (isset($_GET['course_lesson'])) {
                        require_once 'm1_course/course_lesson.php';
                    }
                    ?>

                </main>

                <?php require_once 'include/footer.inc.php'; ?>

            </div>
        </div>
    </div>

    <?php require_once 'include/script.inc.php'; ?>

    <script>
        function checkPaymentStatus(index) {
            var paymentStatusDropdown = document.getElementById(`cs_pay_status${index}`);
            var amountField = document.getElementById(`cs_pay_num${index}`);

            paymentStatusDropdown.addEventListener("change", function() {
                amountField.disabled = (paymentStatusDropdown.value !== "1");
            });

            paymentStatusDropdown.dispatchEvent(new Event("change"));
        }

        let index = 1;
        while (document.getElementById(`cs_pay_status${index}`)) {
            checkPaymentStatus(index);
            index++;
        }
    </script>

</body>

</html>
