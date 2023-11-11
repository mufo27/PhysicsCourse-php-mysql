<?php
require_once('include/auth.inc.php');
require_once('../config/con_db.php');

$ls_id = $_GET['lesson_sub'];

$select_check_ls_name = $conn->prepare("SELECT ls_name FROM lesson l WHERE l.ls_id = '$ls_id'");
$select_check_ls_name->execute();
$row_ls_name = $select_check_ls_name->fetch(PDO::FETCH_ASSOC);

$select_sls_lesson = $conn->prepare("SELECT sls.*, ex.ex_name AS exe_name, qz.z_name AS qz_name  
                        FROM sub_lesson sls 
                        INNER JOIN exercises ex ON sls.ex_id = ex.ex_id 
                        INNER JOIN quiz qz ON sls.z_id = qz.z_id 
                        WHERE sls.ls_id = '$ls_id' 
                        ");
$select_sls_lesson->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

    หัวข้อย่อย | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์

    </title>

    <?php include('include/header.inc.php') ?>

    <link rel="stylesheet" media="screen, print" href="assets/dist/css/datagrid/datatables/datatables.bundle.css">

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
                    
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item">บทเรียน</li>
                        <li class="breadcrumb-item"><?= $row_ls_name['ls_name']; ?></li>
                        <li class="breadcrumb-item active">หัวข้อย่อย</li>
                    </ol>

                    <div class="row">

                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">

                                <div class="panel-hdr">
                                    <h2 class="text-info">
                                        แสดงข้อมูล : หัวข้อย่อย
                                    </h2>
                                    <div class="panel-toolbar">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-success waves-effect waves-themed" data-toggle="modal" data-target="#add-modal"><span class="fal fa-plus mr-1"></span> เพิ่มข้อมูล</button>
                                    </div>
                                </div>


                                <!-- Modal Add-->
                                <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <form action="" method="post" enctype="multipart/form-data">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        เพิ่มข้อมูล
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body bg-faded">

                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">รหัสคอร์สเรียน : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="" name="cs_code" class="form-control" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คอร์สเรียน : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="" name="cs_name" class="form-control" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                                                        <div class="col-lg-9">
                                                            <textarea class="form-control" id="" name="cs_detail" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">

                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ระยะเวลาเรียน ชั่วโมง : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-3">
                                                            <input type="number" id="" name="k_hour" class="form-control" value="" min="0" max="999" required>
                                                        </div>

                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">นาที : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-3">
                                                            <input type="number" id="" name="k_minute" class="form-control" value="" min="0" max="59" required>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">

                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ค่าธรรมเนียม* : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-3">
                                                            <select class="custom-select form-control" id="" name="cs_pay_status" required>
                                                                <option value="">-- เลือก --</option>
                                                                <option value="0">ฟรี</option>
                                                                <option value="1">ไม่ฟรี</option>
                                                            </select>
                                                        </div>

                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนเงิน : <span class="text-danger">(กรณีไม่ฟรี)</span></label>
                                                        <div class="col-lg-3">
                                                            <input type="number" id="" name="cs_pay_num" class="form-control" min="0" max="999999" value="">
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">

                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">เหมาะสำหรับ* : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-3">
                                                            <select class="custom-select form-control" id="" name="cs_for" required>
                                                                <option value="">-- เลือก --</option>
                                                                <option value="1">ม.1</option>
                                                                <option value="2">ม.2</option>
                                                                <option value="3">ม.3</option>
                                                                <option value="4">ม.4</option>
                                                                <option value="5">ม.5</option>
                                                                <option value="6">ม.6</option>
                                                                <option value="7">ป.ตรี</option>
                                                                <option value="0">ทั้งหมด</option>
                                                            </select>
                                                        </div>

                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะ เปิด/ปิด* : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-3">
                                                            <select class="custom-select form-control" id="" name="cs_status" required>
                                                                <option value="">-- เลือก --</option>
                                                                <option value="0">ค่าเริ่มต้น ปิด</option>
                                                                <option value="1">เปิด</option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดรูปภาพ : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
                                                            <input type="file" id="" name="cs_img" class="form-control" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดใบเกียรติบัตร : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
                                                            <input type="file" id="" name="cs_cer" class="form-control" value="" required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <button type="submit" name="btn_save" class="btn btn-success">บันทึกข้อมูล</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-container show">
                                    <div class="panel-content">

                                        <!-- datatable start -->
                                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="width:30%; text-align: left; vertical-align: middle;">หัวข้อย่อย</th>
                                                    <th style="width:20%; text-align: left; vertical-align: middle;">รายละเอียด</th>
                                                    <th style="width:15%; text-align: left; vertical-align: middle;">อ้างอิง</th>
                                                    <th style="width:10%; text-align: left; vertical-align: middle;">แบบฝึกหัด</th>
                                                    <th style="width:10%; text-align: left; vertical-align: middle;">แบบทดสอบ</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $i = 1;
                                                    while($row_sls_lesson = $select_sls_lesson->fetch(PDO::FETCH_ASSOC))  { 
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;">
                                                            <?= $row_sls_lesson['sls_name']; ?>
                                                            <hr>
                                                            <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed" data-toggle="modal" data-target="#show1-modal<?= $row_sls_lesson['sls_id']; ?>"><i class="fal fa-image"></i> รูปภาพ</button>
                                                            <button type="button" class="btn btn-sm btn-outline-primary waves-effect waves-themed" data-toggle="modal" data-target="#show2-modal<?= $row_sls_lesson['sls_id']; ?>"><i class="fal fa-video"></i> คลิปวิดิโอ</button>
                                                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect waves-themed" data-toggle="modal" data-target="#show3-modal<?= $row_sls_lesson['sls_id']; ?>"><i class="fal fa-file-pdf"></i> ไฟล์แบบฝึกหัด</button>
                                                            <button type="button" class="btn btn-sm btn-outline-danger waves-effect waves-themed" data-toggle="modal" data-target="#show4-modal<?= $row_sls_lesson['sls_id']; ?>"><i class="fal fa-file-check"></i> ไฟล์เฉลย</button>
                                                        </td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row_sls_lesson['sls_detail']; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row_sls_lesson['sls_refer']; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row_sls_lesson['exe_name']; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row_sls_lesson['qz_name']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row_sls_lesson['sls_id']; ?>"><i class="fal fa-edit"></i></button>                                                   
                                                            <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row_sls_lesson['sls_id']; ?>"><i class="fal fa-times"></i></button>
                                                        </td>
                                                    </tr>

                                                     <!-- Modal Alert Show1 -->
                                                     <div class="modal fade" id="show1-modal<?= $row_sls_lesson['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">
                                                                        รูปภาพ
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-faded">
                                                                    <img src="upload/sub-lessons/<?= $row_sls_lesson['sls_img'];  ?>" alt="Image" class="img-fluid">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Alert Show2 -->
                                                    <div class="modal fade" id="show2-modal<?= $row_sls_lesson['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">
                                                                        คลิปวิดิโอ
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-faded">
                                                                    <iframe width="100%" height="600" src="https://www.youtube.com/embed/<?= $row_sls_lesson['sls_youtube'];  ?>" frameborder="0" allowfullscreen></iframe>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                     <!-- Modal Alert Show3 -->
                                                     <div class="modal fade" id="show3-modal<?= $row_sls_lesson['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">
                                                                        ไฟล์แบบฝึกหัด
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-faded">
                                                                    <?php if($row_sls_lesson['sls_sheet'] != null){ ?>
                                                                    <iframe src="upload/sub-lessons/<?= $row_sls_lesson['sls_sheet'];  ?>" width="100%" height="600px"></iframe>
                                                                    <?php } else {?>
                                                                    <h4>ไม่มีไฟล์</h4>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                     <!-- Modal Alert Show4 -->
                                                     <div class="modal fade" id="show4-modal<?= $row_sls_lesson['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">
                                                                        ไฟล์แบบฝึกหัด
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-faded">
                                                                    <?php if($row_sls_lesson['sls_answer'] != null){ ?>
                                                                    <iframe src="upload/sub-lessons/<?= $row_sls_lesson['sls_answer'];  ?>" width="100%" height="600px"></iframe>
                                                                    <?php } else {?>
                                                                    <h4>ไม่มีไฟล์</h4>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                 
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <!-- datatable end -->

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </main>
                <!-- END Page Content -->


                <?php include('include/footer.inc.php'); ?>

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

<?php


?>

    <script src="assets/dist/js/vendors.bundle.js"></script>
    <script src="assets/dist/js/app.bundle.js"></script>

    <script src="assets/dist/js/datagrid/datatables/datatables.bundle.js"></script>
    <script>
        $(document).ready(function() {
            $('#dt-basic-example').dataTable({
                responsive: true
            });


        });
    </script>
</body>
<!-- END Body -->

</html>