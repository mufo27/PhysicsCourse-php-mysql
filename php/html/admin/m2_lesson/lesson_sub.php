<?php
// Inclue File Logic & Select Data
require_once 'ls_logic.inc.php';

// Include File Add DB
require_once 'ls_db_add.inc.php';
// Include File Edit DB
require_once 'ls_db_edit.inc.php';
// Include File Del DB
require_once 'ls_db_del.inc.php';

// Modal Add
include 'ls_modal_add.inc.php';
?>

<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">หน้าแรก </li>
    <li class="breadcrumb-item">บทเรียน</li>
    <li class="breadcrumb-item active">หัวข้อย่อย</li>
</ol>

<div class="row">

    <div class="col-xl-12">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <h1>รายการหัวข้อย่อยใน <span class="fw-300 text-info"><i>บทเรียน<?= $row_ls_name['ls_name']; ?></li></i></span></h1>
                <div class="panel-toolbar"></div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <!-- START Filter Data  -->
                            <?php include 'ls_filter_data.inc.php'; ?>
                            <!-- END Filter Data  -->

                        </div>
                    </div>

                    <!-- START Button Add-->
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-2 mb-3">
                            <a href="?active=lesson&lesson" class="btn btn-light btn-block waves-effect waves-themed">
                                <span class="fal fa-step-backward mr-1"></span> ย้อนกลับ
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-block waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มหัวข้อย่อยในบทเรียน
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-7 mb-3">
                            <h4 class="text-right">แสดง <?= $per_page; ?> รายการ</h4>
                        </div>
                    </div>
                    <!-- END Button Add-->

                    <!-- START Table  -->
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <table id="dt-basic-example" class="table table-bordered table-striped table-responsive w-100">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">No.</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">รหัส</th>
                                        <th style="width:25%; text-align: left; vertical-align: middle;">หัวข้อย่อย</th>
                                        <th style="width:15%; text-align: left; vertical-align: middle;">รายละเอียด</th>
                                        <th style="width:10%; text-align: left; vertical-align: middle;">อ้างอิง</th>
                                        <th style="width:10%; text-align: left; vertical-align: middle;">แบบฝึกหัด</th>
                                        <th style="width:10%; text-align: left; vertical-align: middle;">แบบทดสอบ</th>
                                        <th style="width:10%; text-align: center; vertical-align: middle;">จัดการ</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $i = ($per_page * ($page - 1)) + 1;
                                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['sls_id']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;">
                                                <?= $row['sls_name']; ?>
                                                <hr>
                                                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed mb-2" data-toggle="modal" data-target="#show1-modal<?= $row['sls_id']; ?>"><i class="fal fa-image"></i> รูปภาพ</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed mb-2" data-toggle="modal" data-target="#show2-modal<?= $row['sls_id']; ?>"><i class="fal fa-video"></i> คลิปวิดิโอ</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed mb-2" data-toggle="modal" data-target="#show3-modal<?= $row['sls_id']; ?>"><i class="fal fa-file-pdf"></i> ไฟล์แบบฝึกหัด</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed mb-2" data-toggle="modal" data-target="#show4-modal<?= $row['sls_id']; ?>"><i class="fal fa-file-check"></i> ไฟล์เฉลย</button>
                                            </td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['sls_detail']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['sls_refer']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['exe_name']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['qz_name']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button type="button" class="btn btn-outline-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#edit-modal<?= $row['sls_id']; ?>"><i class="fal fa-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#del-modal<?= $row['sls_id']; ?>"><i class="fal fa-times"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <?php include 'ls_modal_edit.inc.php'; ?>

                                        <!-- Modal Delete -->
                                        <?php include 'ls_modal_del.inc.php'; ?>

                                        <!-- Modal Show Image -->
                                        <?php include 'ls_modal_show_img.inc.php'; ?>

                                        <!-- Modal Show Video -->
                                        <?php include 'ls_modal_show_video.inc.php'; ?>

                                        <!-- Modal Show Quiz -->
                                        <?php include 'ls_modal_show_quiz.inc.php'; ?>

                                        <!-- Modal Show EXE -->
                                        <?php include 'ls_modal_show_exe.inc.php'; ?>

                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- START Pagination -->
                    <?php generatePagination($page, $total_pages, $per_page, $total_records,  '?active=lesson&lesson_sub=' . $ls_id); ?>
                    <!-- END Pagination -->

                </div>
            </div>

        </div>
    </div>

</div>