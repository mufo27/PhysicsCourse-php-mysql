<?php
// Inclue File Logic & Select Data
require_once 'q_logic.inc.php';

// Include File Add DB
require_once 'q_db_add.inc.php';
// Include File Edit DB
require_once 'q_db_edit.inc.php';
// Include File Del DB
require_once 'q_db_del.inc.php';

// Modal Add
include 'q_modal_add.inc.php';
?>

<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">หน้าแรก </li>
    <li class="breadcrumb-item active">แบบทดสอบ </li>
</ol>

<div class="row">

    <div class="col-xl-12">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <h1>รายการแบบทดสอบ</h1>
                <div class="panel-toolbar"></div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <!-- START Filter Data  -->
                            <?php include 'q_filter_data.inc.php'; ?>
                            <!-- END Filter Data  -->

                        </div>
                    </div>

                    <!-- START Button Add-->
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-block waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มแบบทดสอบ
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-9 mb-3">
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
                                        <th style="width:5%; text-align: center; vertical-align: middle;">ลำดับ</th>
                                        <th style="width:8%; text-align: center; vertical-align: middle;">รหัส</th>
                                        <th style="width:20%; text-align: left; vertical-align: middle;">แบบทดสอบ</th>
                                        <th style="width:35%; text-align: left; vertical-align: middle;">คำชี้แจ้ง</th>
                                        <th style="width:8%; text-align: center; vertical-align: middle;">เกณฑ์ผ่าน</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">จำนวนคำถาม</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">สถานะ</th>
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
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['ls_id']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['ls_name']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['ls_detail']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['ls_id']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['ls_id']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php if ($row['check_count_in_c'] > 0) { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-success badge-pill"><?= getStatusTextInCL($row['check_count_in_c']); ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="?active=lesson&lesson_sub=<?= $row['ls_id']; ?>" class="btn btn-outline-info btn-sm btn-icon waves-effect waves-themed mb-2">
                                                    <i class="fal fa-plus"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#edit-modal<?= $row['ls_id']; ?>"><i class="fal fa-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#del-modal<?= $row['ls_id']; ?>"><i class="fal fa-times"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <?php include 'q_modal_edit.inc.php'; ?>

                                        <!-- Modal Delete -->
                                        <?php include 'q_modal_del.inc.php'; ?>


                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- START Pagination -->
                    <?php generatePagination($page, $total_pages, $per_page, $total_records, '?active=quiz&quiz&page='); ?>
                    <!-- END Pagination -->

                </div>
            </div>

        </div>
    </div>

</div>