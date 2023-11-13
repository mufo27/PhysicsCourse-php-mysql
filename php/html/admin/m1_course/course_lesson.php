<?php
// Include File Logic & Select Data
require_once 'cl_logic.inc.php';

// Include File Add DB
require_once 'cl_db_add.inc.php';

// Include File Del DB
require_once 'cl_db_del.inc.php';

// Modal Add
include 'cl_modal_add.inc.php';
?>

<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">หน้าแรก</li>
    <li class="breadcrumb-item">คอร์สเรียน</li>
    <li class="breadcrumb-item active">เพิ่มบทเรียน</li>
</ol>

<div class="row">

    <div class="col-xl-12">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <h1>รายการบทเรียนใน <span class="fw-300 text-info"><i>คอร์สเรียน<?= $row_cs_name['cs_name']; ?></li></i></span></h1>
                <div class="panel-toolbar"></div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <!-- START Filter Data  -->
                            <?php include 'cl_filter_data.inc.php'; ?>
                            <!-- END Filter Data  -->

                        </div>
                    </div>

                    <!-- START Button Add-->
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-2">
                            <a href="?active=course&course" class="btn btn-light btn-block waves-effect waves-themed">
                                <span class="fal fa-step-backward mr-1"></span> ย้อนกลับ
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <button type="button" class="btn btn-success btn-block waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มบทเรียนลงในคอร์เรียน
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <h4 class="text-right">แสดง <?= $per_page; ?> รายการ</h4>
                        </div>
                    </div>
                    <!-- END Button Add-->

                    <!-- START Table  -->
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <table id="" class="table table-bordered table-striped w-100">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">ลำดับ</th>
                                        <th style="width:15%; text-align: center; vertical-align: middle;">รหัส</th>
                                        <th style="width:70%; text-align: left; vertical-align: middle;">บทเรียน</th>
                                        <th style="width:10%; text-align: center; vertical-align: middle;">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = ($per_page * ($page - 1)) + 1;
                                    while ($row_cs_lesson = $select_cs_lesson->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row_cs_lesson['ls_id']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row_cs_lesson['lesson_name']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row_cs_lesson['csl_id']; ?>"><i class="fal fa-times"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal Delete -->
                                        <?php include 'cl_modal_del.inc.php'; ?>


                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- START Pagination -->
                    <?php generatePagination($page, $total_pages, $per_page, $total_records,  '?active=course&course_lesson=' . $cs_id); ?>
                    <!-- END Pagination -->

                </div>
            </div>

        </div>
    </div>

</div>