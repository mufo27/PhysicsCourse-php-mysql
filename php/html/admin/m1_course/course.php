<?php
// Inclue File Logic & Select Data
require_once 'c_logic.inc.php';

// Inclue File Add DB
require_once 'c_db_add.inc.php';
// Inclue File Edit DB
require_once 'c_db_edit.inc.php';
// Inclue File Del DB
require_once 'c_db_del.inc.php';

// Modal Add
include 'c_modal_add.inc.php'
?>


<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">หน้าแรก </li>
    <li class="breadcrumb-item active">คอร์สเรียน </li>
</ol>

<div class="row">

    <div class="col-xl-12">
        <div id="panel-1" class="panel">

            <div class="panel-hdr">
                <h1>รายการคอร์สเรียน</h1>
                <div class="panel-toolbar"></div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">

                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <!-- START Filter Data  -->
                            <?php require_once 'c_filter_data.inc.php' ?>
                            <!-- END Filter Data  -->

                        </div>
                    </div>

                    <!-- START Button Add-->
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-3">
                            <button type="button" class="btn btn-success btn-block waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มข้อมูล
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
                                        <th style="width:5%; text-align: left; vertical-align: middle;">รหัส</th>
                                        <th style="width:15%; text-align: left; vertical-align: middle;">คอร์ส</th>
                                        <th style="width:20%; text-align: left; vertical-align: middle;">รายละเอียด</th>
                                        <th style="width:7%; text-align: center; vertical-align: middle;">บทเรียน</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">เหมาะสำหรับ</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">ใช้เวลา</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">ค่าธรรมเนียม</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">สถานะ</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                                        // $show_cs_pay_status = ($row['cs_pay_status'] == 0) ? 'ฟรี' : 'ไม่ฟรี';
                                        $show_status = ($row['cs_status'] == '0') ? 'ปิด' : 'เปิด';

                                    ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['cs_code']; ?></td>
                                            <td style="text-align: left; vertical-align: middle;">
                                                <?= $row['cs_name']; ?>
                                                <hr>
                                                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed" data-toggle="modal" data-target="#img-modal<?= $row['cs_id']; ?>"><i class="fal fa-image"></i> รูปภาพ</button>
                                                <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed" data-toggle="modal" data-target="#cer-modal<?= $row['cs_id']; ?>"><i class="fal fa-certificate"></i> ใบเกียรติบัตร</button>
                                            </td>
                                            <td style="text-align: left; vertical-align: middle;"><?= $row['cs_detail']; ?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="index.php?course_lesson=<?= $row['cs_id']; ?>" class="btn btn-sm btn-info waves-effect waves-themed">
                                                    <span class="fal fa-plus mr-1"></span>
                                                    เพิ่ม (<?= $row['cl_count']; ?>)
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
                                                <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row['cs_id']; ?>"><i class="fal fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row['cs_id']; ?>"><i class="fal fa-times"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <?php include 'c_modal_edit.inc.php' ?>

                                        <!-- Modal Delete -->
                                        <?php include 'c_modal_del.inc.php' ?>

                                        <!-- Modal Image -->
                                        <?php include 'c_modal_show_img.inc.php' ?>

                                        <!-- Modal Cer -->
                                        <?php include 'c_modal_show_cer.inc.php' ?>


                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- START Pagination -->
                    <?php require_once 'c_pagination.inc.php' ?>
                    <!-- END Pagination -->

                </div>
            </div>



        </div>
    </div>

</div>

<script>
    // function checkPaymentStatus(index) {
    //     var paymentStatusDropdown = document.getElementById(`cs_pay_status${index}`);
    //     var amountField = document.getElementById(`cs_pay_num${index}`);

    //     paymentStatusDropdown.addEventListener("change", function() {
    //         amountField.disabled = (paymentStatusDropdown.value !== "1");
    //     });

    //     paymentStatusDropdown.dispatchEvent(new Event("change"));
    // }

    // let index = 1;
    // while (document.getElementById(`cs_pay_status${index}`)) {
    //     checkPaymentStatus(index);
    //     index++;
    // }
</script>