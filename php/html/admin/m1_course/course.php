<?php

require_once('include/auth.inc.php');
require_once('../config/con_db.php');

$per_page = 1;

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

$start_from = ($page - 1) * $per_page;

$select_all = $conn->prepare("SELECT COUNT(*) FROM course");
$select_all->execute();
$total_records = $select_all->fetchColumn();

$total_pages = ceil($total_records / $per_page);


if (isset($_POST['btn_save'])) {

    $cs_code       = $_POST['cs_code'];
    $cs_name       = $_POST['cs_name'];
    $cs_detail     = $_POST['cs_detail'];
    $k_hour        = $_POST['k_hour'];
    $k_minute      = $_POST['k_minute'];
    $cs_pay_status = $_POST['cs_pay_status'];
    $cs_pay_num    = $_POST['cs_pay_num'];
    $cs_for        = $_POST['cs_for'];
    $cs_status     = $_POST['cs_status'];

    //ตรวจสอบรหััสคอร์สเรียนซ้ำ หรือ ชื่อคอร์สเรียนซ้ำ
    $select = $conn->prepare("SELECT count(*) AS check_num FROM course WHERE cs_code=:cs_code OR cs_name=:cs_name");
    $select->bindParam(':cs_code', $cs_code);
    $select->bindParam(':cs_name', $cs_name);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row['check_num'] > 0) {

        echo "<script>alert('**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!')</script>";
        echo "<script>window.location='javascript:history.back(-1)';</script>";
        exit;
    } else {

        try {

            $file_location  = "upload/courses/";

            if ($_FILES['cs_img']['tmp_name'] == "") {

                $newfilename   = "";
            } else {

                $allowedExts    =   array("jpg,png");
                $temp           =   explode(".", $_FILES["cs_img"]["name"]);
                $source_file    =   $_FILES['cs_img']['tmp_name'];
                $size_file      =   $_FILES['cs_img']['size'];
                $extension      =   end($temp);
                $newfilename    =   'img_' . round(microtime(true)) . '.' . end($temp);

                move_uploaded_file($source_file, $file_location . $newfilename);
            }

            if ($_FILES['cs_cer']['tmp_name'] == "") {

                $newfilename_cer = "";
            } else {

                $allowedExts_cer    =   array("jpg,png");
                $temp_cer           =   explode(".", $_FILES["cs_cer"]["name"]);
                $source_file_cer    =   $_FILES['cs_cer']['tmp_name'];
                $size_file_cer      =   $_FILES['cs_cer']['size'];
                $extension_cer      =   end($temp_cer);
                $newfilename_cer    =   'cer_' . round(microtime(true)) . '.' . end($temp_cer);

                move_uploaded_file($source_file_cer, $file_location . $newfilename_cer);
            }


            $insert = $conn->prepare("INSERT INTO course (cs_code, cs_name, cs_detail, k_hour, k_minute, cs_pay_status, cs_pay_num, cs_status, cs_for, cs_img, cs_cer) 
            VALUES (:cs_code, :cs_name, :cs_detail, :k_hour, :k_minute, :cs_pay_status, :cs_pay_num, :cs_status, :cs_for, :cs_img, :cs_cer)");
            $insert->bindParam(':cs_code',  $cs_code);
            $insert->bindParam(':cs_name',  $cs_name);
            $insert->bindParam(':cs_detail',  $cs_detail);
            $insert->bindParam(':k_hour',  $k_hour);
            $insert->bindParam(':k_minute',  $k_minute);
            $insert->bindParam(':cs_pay_status',  $cs_pay_status);
            $insert->bindParam(':cs_pay_num',  $cs_pay_num);
            $insert->bindParam(':cs_status',  $cs_status);
            $insert->bindParam(':cs_for',  $cs_for);
            $insert->bindParam(':cs_img',  $newfilename);
            $insert->bindParam(':cs_cer',  $newfilename_cer);
            $insert->execute();

            if ($insert) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "บันทึกข้อมูล เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=course.php?course\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                        });
                    </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=course.php?course\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}

if (isset($_POST['btn_update'])) {


    $cs_id         = $_POST['btn_update'];
    $cs_code       = $_POST['cs_code'];
    $cs_name       = $_POST['cs_name'];
    $cs_detail     = $_POST['cs_detail'];
    $k_hour        = $_POST['k_hour'];
    $k_minute      = $_POST['k_minute'];
    $cs_pay_status = $_POST['cs_pay_status'];
    $cs_pay_num    = $_POST['cs_pay_num'];
    $cs_for        = $_POST['cs_for'];
    $cs_status     = $_POST['cs_status'];

    try {

        $file_location  = "upload/courses/";

        if ($_FILES['cs_img']['tmp_name'] == "") {

            $newfilename   = $_POST['cs_img_befor'];
        } else {

            $allowedExts    =   array("jpg,png");
            $temp           =   explode(".", $_FILES["cs_img"]["name"]);
            $source_file    =   $_FILES['cs_img']['tmp_name'];
            $size_file      =   $_FILES['cs_img']['size'];
            $extension      =   end($temp);
            $newfilename    =   'img_' . round(microtime(true)) . '.' . end($temp);

            unlink($file_location . $_POST['cs_img_befor']);
            move_uploaded_file($source_file, $file_location . $newfilename);
        }

        if ($_FILES['cs_cer']['tmp_name'] == "") {

            $newfilename_cer   = $_POST['cs_cer_befor'];
        } else {

            $allowedExts_cer    =   array("jpg,png");
            $temp_cer           =   explode(".", $_FILES["cs_cer"]["name"]);
            $source_file_cer    =   $_FILES['cs_cer']['tmp_name'];
            $size_file_cer      =   $_FILES['cs_cer']['size'];
            $extension_cer      =   end($temp_cer);
            $newfilename_cer    =   'cer_' . round(microtime(true)) . '.' . end($temp_cer);

            unlink($file_location . $_POST['cs_cer_befor']);
            move_uploaded_file($source_file_cer, $file_location . $newfilename_cer);
        }

        $update = $conn->prepare("UPDATE course SET cs_code = :cs_code, 
                                                    cs_name = :cs_name, 
                                                    cs_detail = :cs_detail, 
                                                    k_hour = :k_hour, 
                                                    k_minute = :k_minute, 
                                                    cs_pay_status = :cs_pay_status, 
                                                    cs_pay_num = :cs_pay_num, 
                                                    cs_status = :cs_status, 
                                                    cs_for = :cs_for, 
                                                    cs_img = :cs_img, 
                                                    cs_cer = :cs_cer 
                                                WHERE cs_id = :cs_id
                                ");

        $update->bindParam(':cs_id',  $cs_id);
        $update->bindParam(':cs_code',  $cs_code);
        $update->bindParam(':cs_name',  $cs_name);
        $update->bindParam(':cs_detail',  $cs_detail);
        $update->bindParam(':k_hour',  $k_hour);
        $update->bindParam(':k_minute',  $k_minute);
        $update->bindParam(':cs_pay_status',  $cs_pay_status);
        $update->bindParam(':cs_pay_num',  $cs_pay_num);
        $update->bindParam(':cs_status',  $cs_status);
        $update->bindParam(':cs_for',  $cs_for);
        $update->bindParam(':cs_img',  $newfilename);
        $update->bindParam(':cs_cer',  $newfilename_cer);
        $update->execute();

        if ($update) {

            echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "อัพเดทข้อมูล เรียบร้อย...!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=course.php?course\">";
            exit;
        } else {
            echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                    });
                </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=course.php?course\">";
            exit;
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}

if (isset($_POST['btn_del'])) {

    $check_id = $_POST['btn_del'];

    try {

        $file_location  = "upload/courses/";

        $select = $conn->prepare("SELECT cs_img, cs_cer FROM course WHERE cs_id = :check_id");
        $select->bindParam(':check_id', $check_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['cs_img'] != '') {
            unlink($file_location . $row['cs_img']);
        }

        if ($row['cs_cer'] != '') {
            unlink($file_location . $row['cs_cer']);
        }

        $delete_cr = $conn->prepare("DELETE FROM course_register WHERE cs_id = :check_id");
        $delete_cr->bindParam(':check_id', $check_id);
        $delete_cr->execute();

        $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE cs_id = :check_id");
        $delete_cl->bindParam(':check_id', $check_id);
        $delete_cl->execute();

        $delete_c = $conn->prepare("DELETE FROM course WHERE cs_id = :check_id");
        $delete_c->bindParam(':check_id', $check_id);
        $delete_c->execute();

        if ($delete_cr && $delete_cl && $delete_c) {

            echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "ลบข้อมูล เรียบร้อย...!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=course.php?course\">";
            exit;
        } else {

            echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                    });
                </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=course.php?course\">";
            exit;
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}

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

                    <!-- START Button  -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-5">

                        </div>
                        <div class="col-sm-12 col-md-7 ml-auto text-right">
                            <button type="button" class="btn btn-sm btn-success waves-effect waves-themed" data-toggle="modal" data-target="#add-modal">
                                <span class="fal fa-plus mr-1"></span> เพิ่มข้อมูล
                            </button>
                        </div>
                    </div>
                    <!-- END Button  -->

                    <!-- START Table  -->
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">No.</th>
                                        <th style="width:5%; text-align: center; vertical-align: middle;">รหัสคอร์ส</th>
                                        <th style="width:15%; vertical-align: middle;">ชื่อคอร์ส</th>
                                        <th style="width:20%; vertical-align: middle;">รายละเอียด</th>
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

                                    $select = $conn->prepare("SELECT c.* ,(SELECT count(cs_id) FROM course_lesson WHERE cs_id = c.cs_id) AS cl_count 
                                                                FROM course c 
                                                                LIMIT :start_from, :per_page");
                                    $select->bindParam(':start_from', $start_from, PDO::PARAM_INT);
                                    $select->bindParam(':per_page', $per_page, PDO::PARAM_INT);
                                    $select->execute();

                                    $i = 1;
                                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                                        if ($row['cs_for'] == 1) {
                                            $txt_for = 'ม.1';
                                        } else if ($row['cs_for'] == 2) {
                                            $txt_for = 'ม.2';
                                        } else if ($row['cs_for'] == 3) {
                                            $txt_for = 'ม.3';
                                        } else if ($row['cs_for'] == 4) {
                                            $txt_for = 'ม.4';
                                        } else if ($row['cs_for'] == 5) {
                                            $txt_for = 'ม.5';
                                        } else if ($row['cs_for'] == 6) {
                                            $txt_for = 'ม.6';
                                        } else if ($row['cs_for'] == 7) {
                                            $txt_for = 'ป.ตรี';
                                        } else {
                                            $txt_for = 'ทั้งหมด';
                                        }

                                        if ($row['cs_pay_status'] == 0) {
                                            $show_cs_pay_status = 'ฟรี';
                                        } else {
                                            $show_cs_pay_status = 'ไม่ฟรี';
                                        }

                                        if ($row['cs_status'] == '0') {
                                            $show_status = 'ปิด';
                                        } else {
                                            $show_status = 'เปิด';
                                        }
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
                                            <td style="text-align: center; vertical-align: middle;"><?= $txt_for; ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?= $row['k_hour']; ?> ชม. <?= $row['k_minute']; ?> น.</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php if ($row['cs_pay_status'] == 1) { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-danger badge-pill"><?= $row['cs_pay_num']; ?> บ.</span>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-success badge-pill"><?= $show_cs_pay_status; ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php if ($row['cs_status'] == 0) { ?>
                                                    <span class="badge badge-danger badge-pill"><?= $show_status; ?></span>
                                                    </span>
                                                <?php } else { ?>
                                                    <span class="chip purple lighten-5">
                                                        <span class="badge badge-success badge-pill"><?= $show_status; ?></span>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row['cs_id']; ?>"><i class="fal fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row['cs_id']; ?>"><i class="fal fa-times"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit-modal<?= $row['cs_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">

                                                    <form action="" method="post" enctype="multipart/form-data">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title">
                                                                แก้ไขข้อมูล
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body bg-faded">

                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">รหัสคอร์สเรียน : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" id="" name="cs_code" class="form-control" value="<?= $row['cs_code']; ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คอร์สเรียน : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" id="" name="cs_name" class="form-control" value="<?= $row['cs_name']; ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                                                                <div class="col-lg-9">
                                                                    <textarea class="form-control" id="editor2" name="cs_detail" rows="3"><?= $row['cs_detail']; ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">

                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ระยะเวลาเรียน ชั่วโมง : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-3">
                                                                    <input type="number" id="" name="k_hour" class="form-control" value="<?= $row['k_hour']; ?>" min="0" max="999" required>
                                                                </div>

                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">นาที : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-3">
                                                                    <input type="number" id="" name="k_minute" class="form-control" value="<?= $row['k_minute']; ?>" min="0" max="59" required>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">

                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ค่าธรรมเนียม : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-3">
                                                                    <select class="custom-select form-control" id="cs_pay_status2" name="cs_pay_status" required>
                                                                        <option value="<?= $row['cs_pay_status']; ?>">-- <?= $show_cs_pay_status; ?> --</option>
                                                                        <option value="0">ฟรี</option>
                                                                        <option value="1">ไม่ฟรี</option>
                                                                    </select>
                                                                </div>

                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนเงิน : <span class="text-danger">(กรณีไม่ฟรี)</span></label>
                                                                <div class="col-lg-3">
                                                                    <input type="number" id="cs_pay_num2" name="cs_pay_num" class="form-control" min="0" max="999999" value="<?= $row['cs_pay_num']; ?>" disabled>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">

                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">เหมาะสำหรับ : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-3">
                                                                    <select class="custom-select form-control" id="" name="cs_for" required>
                                                                        <option value="<?= $row['cs_for']; ?> ">-- <?= $txt_for; ?> --</option>
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

                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะ เปิด/ปิด : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-3">
                                                                    <select class="custom-select form-control" id="" name="cs_status" required>
                                                                        <option value="<?= $row['cs_status']; ?>">-- <?= $show_status; ?> --</option>
                                                                        <option value="0">ค่าเริ่มต้น ปิด</option>
                                                                        <option value="1">เปิด</option>
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รูปภาพ : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <img src="upload/courses/<?= $row['cs_img']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px">
                                                                    <input type="hidden" name="cs_img_befor" value="<?= $row['cs_img']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดใหม่:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="file" id="" name="cs_img" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ใบเกียรติบัตร : <span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <img src="upload/courses/<?= $row['cs_cer']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px">
                                                                    <input type="hidden" name="cs_cer_befor" value="<?= $row['cs_cer']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดใหม่:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="file" id="" name="cs_cer" class="form-control" value="">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                            <button type="submit" name="btn_update" value="<?= $row['cs_id']; ?>" class="btn btn-warning">อัพเดทข้อมูล</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Alert Delete -->
                                        <div class="modal fade" id="del-modal<?= $row['cs_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="" method="post" enctype="multipart/form-data">

                                                        <div class="modal-header">
                                                            <h4 class="modal-title">
                                                                ลบข้อมูล
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body bg-faded">
                                                            <h4>คุณแน่ใจใช่มั้ย ว่าต้องการลบข้อมูลนี้</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                            <button type="submit" name="btn_del" value="<?= $row['cs_id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันลบข้อมูล</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Alert Image -->
                                        <div class="modal fade" id="img-modal<?= $row['cs_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                        <img src="upload/courses/<?= $row['cs_img']; ?>" alt="Image" class="img-fluid">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Alert Cer -->
                                        <div class="modal fade" id="cer-modal<?= $row['cs_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">
                                                            ใบเกียรติบัตร
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-faded">
                                                        <img src="upload/courses/<?= $row['cs_cer']; ?>" alt="Image" class="img-fluid">
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
                        </div>
                    </div>
                    <!-- END Table -->

                    <!-- START Pagination -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info">
                                กำลังแสดง <?= (($page - 1) * $per_page) + 1 ?> ถึง <?= min($page * $per_page, $total_records) ?> จาก <?= $total_records ?> รายการ
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <?php if ($page > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="index.php?course&page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                                        </li>
                                    <?php else : ?>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="index.php?course&page=<?= $i ?>">
                                                <?= $i ?>
                                                <?php if ($i == $page) : ?>
                                                    <span class="sr-only">(current)</span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $total_pages) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="index.php?course&page=<?= $page + 1 ?>">ถัดไป</a>
                                        </li>
                                    <?php else : ?>
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ถัดไป</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- END Pagination -->

                </div>
            </div>



        </div>
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
                            <input type="text" id="" name="cs_code" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คอร์สเรียน : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="cs_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor1" name="cs_detail" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ระยะเวลาเรียน ชั่วโมง : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="" name="k_hour" class="form-control" min="0" max="999" required>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">นาที : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="" name="k_minute" class="form-control" min="0" max="59" required>
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ค่าธรรมเนียม : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="cs_pay_status1" name="cs_pay_status" required>
                                <option value="">-- เลือก --</option>
                                <option value="0">ฟรี</option>
                                <option value="1">ไม่ฟรี</option>
                            </select>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนเงิน : <span class="text-danger">(กรณีไม่ฟรี)</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="cs_pay_num1" name="cs_pay_num" class="form-control" min="0" max="999999" disabled>
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">เหมาะสำหรับ : <span class="text-danger">*</span></label>
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

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะ เปิด/ปิด : <span class="text-danger">*</span></label>
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
                            <input type="file" id="" name="cs_img" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดใบเกียรติบัตร : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="cs_cer" class="form-control" required>
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