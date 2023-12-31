<?php
// Inclue File Logic & Select Data
require_once 'c_logic.inc.php';

// Include File Add DB
require_once 'c_db_add.inc.php';
// Include File Edit DB
require_once 'c_db_edit.inc.php';
// Include File Del DB
require_once 'c_db_del.inc.php';

// Modal Add
include 'c_modal_add.inc.php';
?>


<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">หน้าแรก </li>
    <li class="breadcrumb-item active">คอร์สเรียน </li>
</ol>

<div class="row">

    <div class="col-xl-12">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <h2>รายการคอร์สเรียน</h2>
                <div class="panel-toolbar"></div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <!-- START Filter Data  -->
                            <?php include 'c_filter_data.inc.php'; ?>
                            <!-- END Filter Data  -->

                        </div>
                    </div>

                    <!-- START Button Add-->
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-block waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มคอร์สเรียน
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-9 mb-3 mt-3">
                            <h5 class="text-right">แสดง <?= $per_page; ?> รายการ</h5>
                        </div>
                    </div>
                    <!-- END Button Add-->

                    <!-- START Table  -->
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <table id="dt-basic-example" class="table table-bordered table-striped table-responsive w-100">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">ลำดับ</th>
                                        <th style="width:8%; text-align: center; vertical-align: middle;">รหัส</th>
                                        <th style="width:15%; text-align: left; vertical-align: middle;">คอร์ส</th>
                                        <th style="width:20%; text-align: left; vertical-align: middle;">รายละเอียด</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">บทเรียน</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">เหมาะสำหรับ</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">ใช้เวลา</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">ค่าธรรมเนียม</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">สถานะ</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">สถานะ</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = ($per_page * ($page - 1)) + 1;
                                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                                    ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['cs_code']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;">
                                                <?= $row['cs_name']; ?>
                                                <hr>
                                                <button type="button" class="btn btn-outline-primary btn-sm waves-effect waves-themed mb-2" data-toggle="modal" data-target="#img-modal<?= $row['cs_id']; ?>"><i class="fal fa-image"></i> รูปภาพ</button>
                                                <button type="button" class="btn btn-outline-primary btn-sm waves-effect waves-themed mb-2" data-toggle="modal" data-target="#cer-modal<?= $row['cs_id']; ?>"><i class="fal fa-certificate"></i> ใบเกียรติบัตร</button>
                                            </td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['cs_detail']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="?active=course&course_lesson=<?= $row['cs_id']; ?>" class="btn btn-outline-info btn-sm waves-effect waves-themed mb-2">
                                                    <span class="fal fa-plus mr-1"></span>
                                                    เพิ่ม (<?= $row['check_count_in_cl']; ?>)
                                                    </ฟ>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;"><?= getGradeText($row['cs_for']); ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['k_hour']; ?> ชม. <?= $row['k_minute']; ?> น.</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php if ($row['cs_pay_status'] == 1) { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-danger badge-pill"><?= $row['cs_pay_num']; ?> บ.</span>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-success badge-pill"><?= getPayStatusText($row['cs_pay_status']); ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php if ($row['cs_status'] == 0) { ?>
                                                    <span class="badge badge-danger badge-pill"><?= getStatusText($row['cs_status']); ?></span>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-success badge-pill"><?= getStatusText($row['cs_status']); ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php if ($row['check_count_in_cr'] > 0) { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-success badge-pill"><?= getStatusTextInCR($row['check_count_in_cr']); ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button type="button" class="btn btn-outline-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#edit-modal<?= $row['cs_id']; ?>"><i class="fal fa-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#del-modal<?= $row['cs_id']; ?>"><i class="fal fa-times"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <?php include 'c_modal_edit.inc.php'; ?>

                                        <!-- Modal Delete -->
                                        <?php include 'c_modal_del.inc.php'; ?>

                                        <!-- Modal Image -->
                                        <?php include 'c_modal_show_img.inc.php'; ?>

                                        <!-- Modal Cer -->
                                        <?php include 'c_modal_show_cer.inc.php'; ?>


                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- START Pagination -->
                    <?php generatePagination($page, $total_pages, $per_page, $total_records, '?active=course&course&page='); ?>
                    <!-- END Pagination -->

                </div>
            </div>

        </div>
    </div>

</div>