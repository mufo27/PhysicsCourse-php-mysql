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
    <li class="breadcrumb-item active">บทเรียน </li>
</ol>

<div class="row">

    <div class="col-xl-12">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <h1>รายการบทเรียน</h1>
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
                        <div class="col-sm-12 col-md-3">
                            <button type="button" class="btn btn-success btn-block waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มบทเรียน
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <h4 class="text-right">แสดง <?= $per_page; ?> รายการ</h4>
                        </div>
                    </div>
                    <!-- END Button Add-->

                    <!-- START Table  -->
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <table id="dt-basic-example" class="table table-bordered table-striped w-100">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">ลำดับ</th>
                                        <th style="width:10%; text-align: center; vertical-align: middle;">รหัส</th>
                                        <th style="width:25%; text-align: left; vertical-align: middle;">บทเรียน</th>
                                        <th style="width:40%; text-align: left; vertical-align: middle;">รายละเอียด</th>
                                        <th style="width:10%; text-align: center; vertical-align: middle;">หัวข้อย่อย</th>
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
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="?active=lesson&lesson_sub=<?= $row['ls_id']; ?>" class="btn btn-sm btn-info waves-effect waves-themed">
                                                    <span class="fal fa-plus mr-1"></span>
                                                    เพิ่ม (<?= $row['sls_count']; ?>)
                                                    </ฟ>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row['ls_id']; ?>"><i class="fal fa-edit"></i></button>

                                                <?php if ($row['sls_count'] < 1) { ?>
                                                    <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row['ls_id']; ?>"><i class="fal fa-times"></i></button>
                                                <?php } ?>
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