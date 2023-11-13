<?php

$select_data = $conn->prepare("
    SELECT
        (SELECT number FROM web_view WHERE w_id = 1) AS web_views,
        (SELECT count(cs_id) FROM course) AS course_count,
        (SELECT count(ls_id) FROM lesson) AS lesson_count,
        (SELECT count(cr_id) FROM class_room) AS class_room_count,
        (SELECT count(id) FROM users WHERE status = 0) AS inactive_member_count,
        (SELECT count(id) FROM users WHERE status = 1) AS active_student_count
");
$select_data->execute();
$row_data = $select_data->fetch(PDO::FETCH_ASSOC);

?>

<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item active"> หน้าแรก</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-home'></i> หน้าแรก
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
    </div>
</div>

<h1>รายงานข้อมูล</h1>

<div class="row text-center">
    <div class="col-12 col-md-6">
        <a href="account_check.php?account_check=Farmer">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h2 class="display-6 d-block l-h-n m-0 fw-500">
                        จำนวนสถิติผู้เข้าชมเว็บไซต์ <?= $row_data['web_views']; ?> คน
                    </h2>
                </div>
                <!-- <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 4rem;"></i> -->
            </div>
        </a>
    </div>
    <div class="col-12 col-md-6">
        <a href="account.php?account=Customer">
            <div class="p-3 bg-dark rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h2 class="display-6 d-block l-h-n m-0 fw-500">
                        จำนวนคอร์สเรียน <?= $row_data['course_count']; ?> บท
                    </h2>
                </div>
                <!-- <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 4rem;"></i> -->
            </div>
        </a>
    </div>
</div>

<div class="row text-center">
    <div class="col-12 col-md-6">
        <a href="account.php?account=Customer">
            <div class="p-3 bg-dark rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h2 class="display-6 d-block l-h-n m-0 fw-500">
                        จำนวนบทเรียน <?= $row_data['lesson_count']; ?> บท
                    </h2>
                </div>
                <!-- <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 4rem;"></i> -->
            </div>
        </a>
    </div>
    <div class="col-12 col-md-6">
        <a href="account.php?account=Farmer">
            <div class="p-3 bg-dark rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h2 class="display-6 d-block l-h-n m-0 fw-500">
                        จำนวนห้องเรียน <?= $row_data['class_room_count']; ?> ห้อง
                    </h2>
                </div>
                <!-- <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 4rem;"></i> -->
            </div>
        </a>
    </div>
</div>


<div class="row text-center">
    <div class="col-12 col-md-6">
        <a href="account.php?account=Delivery">
            <div class="p-3 bg-dark rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h2 class="display-6 d-block l-h-n m-0 fw-500">
                        จำนวนสมาชิก <?= $row_data['inactive_member_count']; ?> คน
                    </h2>
                </div>
                <!-- <i class="fal fa-users position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 4rem;"></i> -->
            </div>
        </a>
    </div>

    <div class="col-12 col-md-6">
        <a href="manage_category.php?manage_category">
            <div class="p-3 bg-dark rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h2 class="display-6 d-block l-h-n m-0 fw-500">
                        จำนวนนักเรียน <?= $row_data['active_student_count']; ?> คน
                    </h2>
                </div>
                <!-- <i class="fal fa-shopping-bag position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 5rem;"></i> -->
            </div>
        </a>
    </div>
</div>