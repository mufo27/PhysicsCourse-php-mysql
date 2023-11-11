<?php
require_once('include/auth.inc.php');
require_once('../config/con_db.php');


$select = $conn->prepare("SELECT l.*, (SELECT count(ls_id)  FROM sub_lesson sb WHERE sb.ls_id = l.ls_id) AS sls_count FROM lesson l");
$select->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

    บทเรียน | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์

    </title>

    <?php include('include/header.inc.php') ?>

    <link rel="stylesheet" media="screen, print" href="assets/dist/css/datagrid/datatables/datatables.bundle.css">

    <style>
        /* #container {
            width: 1000px;
            margin: 20px auto;
        } */
        .ck-editor__editable[role="textbox"] {
            min-height: 200px;
        }
        /* .ck-content .image {
            max-width: 80%;
            margin: 20px auto;
        } */
    </style>

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
                        <li class="breadcrumb-item active">บทเรียน</li>
                    </ol>

                    <div class="row">

                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">

                                <div class="panel-hdr">
                                    <h2 class="text-info">
                                        แสดงข้อมูล : บทเรียน
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
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">บทเรียน : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="" name="ls_name" class="form-control" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                                                        <div class="col-lg-9">
                                                            <textarea id="editor1" class="form-control" id="" name="ls_detail" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- <div id="container">
                                                        <div id="editor">
                                                        </div>
                                                    </div> -->
                                                    

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
                                                    <th style="width:15%; vertical-align: middle;">ชื่อบทเรียน</th>
                                                    <th style="width:50%; vertical-align: middle;">รายละเอียด</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">หัวข้อย่อย</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $i = 1;
                                                    while($row = $select->fetch(PDO::FETCH_ASSOC))  { 
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row['ls_name']; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row['ls_detail']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <a href="lesson_sub.php?lesson_sub=<?= $row['ls_id']; ?>" class="btn btn-sm btn-info waves-effect waves-themed">
                                                                <span class="fal fa-plus mr-1"></span>
                                                                เพิ่ม (<?= $row['sls_count']; ?>)
                                                                </ฟ>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row['ls_id']; ?>"><i class="fal fa-edit"></i></button>
                                                            
                                                            <?php if($row['sls_count'] < 1){?>
                                                                <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row['ls_id']; ?>"><i class="fal fa-times"></i></button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="edit-modal<?= $row['ls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">รหัสบทเรียน : </label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="" name="ls_id" class="form-control" value="<?= $row['ls_id']; ?>" readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">บทเรียน : <span class="text-danger">*</span></label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="" name="ls_name" class="form-control" value="<?= $row['ls_name']; ?>" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                                                                            <div class="col-lg-9">
                                                                                <textarea id="editor2" class="form-control" id="" name="ls_detail" rows="3"><?= $row['ls_detail']; ?></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" name="btn_update" class="btn btn-warning">อัพเดทข้อมูล</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal Alert Delete -->
                                                    <?php if($row['sls_count'] < 1){?>
                                                        <div class="modal fade" id="del-modal<?= $row['ls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                            <button type="submit" name="btn_del" value="<?= $row['ls_id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันลบข้อมูล</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

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

    if(isset($_POST['btn_save'])){

        $ls_name   = $_POST['ls_name'];
        $ls_detail = $_POST['ls_detail'];

        $select = $conn->prepare("SELECT count(*) AS check_num FROM lesson WHERE ls_name = '$ls_name'");
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['check_num'] > 0) {

            echo "<script>alert('**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!')</script>";
            echo"<script>window.location='javascript:history.back(-1)';</script>";
            exit;

        } else {

            try {
                
                $insert = $conn->prepare("INSERT INTO lesson (ls_name, ls_detail) VALUES (:ls_name, :ls_detail)");
                $insert->bindParam(':ls_name' , $ls_name); 
                $insert->bindParam(':ls_detail',  $ls_detail); 
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
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=lessons.php?lessons\">";
                    exit;

                } else {

                    echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "error",
                            title: "ล้มเหลว",
                            text: "โปรด ลองใหม่อีกครั้ง..!!"
                            });
                        </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=lessons.php?lessons\">";
                    exit;

                }  

            } catch (PDOException $e) {

                echo $e->getMessage();

            }
        }

        
    }

    if(isset($_POST['btn_update'])){

        $ls_id     = $_POST['ls_id'];  
        $ls_name   = $_POST['ls_name'];  
        $ls_detail = $_POST['ls_detail'];  

        try {

            $update = $conn->prepare("UPDATE lesson SET ls_name=:ls_name, ls_detail=:ls_detail WHERE ls_id=:ls_id");
            $update->bindParam(':ls_id'     , $ls_id); 
            $update->bindParam(':ls_name'   , $ls_name); 
            $update->bindParam(':ls_detail' , $ls_detail); 
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
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=lessons.php?lessons\">";
                exit;

            } else {

                echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                        });
                    </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=lessons.php?lessons\">";
                exit;

            }  
        
        }  catch (PDOException $e) {

            echo $e->getMessage();

        }
        
    }

    if (isset($_POST['btn_del'])) {


        $check_ls_id = $_POST['btn_del'];
         
        try {

            $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE ls_id = :ls_id");
            $delete_cl->bindParam(':ls_id' , $check_ls_id);
            $delete_cl->execute();

            $delete_l = $conn->prepare("DELETE FROM lesson WHERE ls_id = :ls_id");
            $delete_l->bindParam(':ls_id' , $check_ls_id);
            $delete_l->execute();
            
            if ($delete_cl && $delete_l) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ลบข้อมูล เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=lessons.php?lessons\">";
                exit;

            } else {

                echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                        });
                    </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=lessons.php?lessons\">";
                exit;

            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }

?>

    <?php include('ckeditor.php'); ?>
    

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