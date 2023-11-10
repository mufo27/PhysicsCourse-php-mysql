<?php
require_once('include/auth.inc.php');
require_once('../config/con_db.php');

$cs_id = $_GET['course_lesson'];

$select_check_cs_name = $conn->prepare("SELECT cs_name FROM course c WHERE c.cs_id = '$cs_id'");
$select_check_cs_name->execute();
$row_cs_name = $select_check_cs_name->fetch(PDO::FETCH_ASSOC);

$select_cs_lesson  = $conn->prepare("SELECT csl_id, ls_id, (SELECT ls_name FROM lesson l WHERE l.ls_id = cl.ls_id) AS lesson_name FROM course_lesson cl WHERE cl.cs_id = '$cs_id'");                       
$select_cs_lesson->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        เพิ่มบทเรียน | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์

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
                        <li class="breadcrumb-item">คอร์สเรียน</li>
                        <li class="breadcrumb-item"><?= $row_cs_name['cs_name']; ?></li>
                        <li class="breadcrumb-item active">เพิ่มบทเรียน</li>
                    </ol>

                    <div class="row">

                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">

                                <div class="panel-hdr">
                                    <h2 class="text-info">
                                        แสดงข้อมูล : คอร์สเรียน
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
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">บทเรียน* : <span class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
                                                            <select class="custom-select form-control" id="" name="ls_id" required>
                                                            <option value="">-- เลือก --</option>
                                                            <?php 
                                                                $select_add = $conn->prepare("SELECT ls_id, ls_name FROM lesson");                       
                                                                $select_add->execute();
                                                            
                                                                $i = 1;
                                                                while($row_add = $select_add->fetch(PDO::FETCH_ASSOC))  { 
                                                            ?>
                                                            <option value="<?= $row_add['ls_id']; ?>"><?= $row_add['ls_name']; ?>
                                                            </option>
                                                            <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <button type="submit" name="btn_save" value="<?= $cs_id; ?>" class="btn btn-success">บันทึกข้อมูล</button>
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
                                                    <th style="width:30%; text-align: left; vertical-align: middle;">ชื่อบทเรียน</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $i = 1;
                                                    while($row_cs_lesson = $select_cs_lesson->fetch(PDO::FETCH_ASSOC))  { 
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row_cs_lesson['lesson_name']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row_cs_lesson['csl_id']; ?>"><i class="fal fa-times"></i></button>
                                                        </td>
                                                    </tr>


                                                    <!-- Modal Alert Delete -->
                                                    <div class="modal fade" id="del-modal<?= $row_cs_lesson['csl_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="" method="post" enctype="multipart/form-data">

                                                                    <input type="hidden" name="cs_id" value="<?= $cs_id; ?>">
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
                                                                        <button type="submit" name="btn_del" value="<?= $row_cs_lesson['csl_id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันลบข้อมูล</button>
                                                                    </div>
                                                                </form>

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

                        <div class="col-xl-12">
                                <a href="course.php?course" class="btn btn-sm btn-danger"><span class="fal fa-step-backward mr-1"></span> ย้อนกลับ</a>
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

        $check_cs_id = $_POST['btn_save'];
        $check_ls_id      = $_POST['ls_id'];
        $save_date  =  date('d-m-Y');

        $select = $conn->prepare("SELECT count(*) AS check_num FROM course_lesson WHERE cs_id = :cs_id AND ls_id = :ls_id");
        $select->bindParam(':cs_id'     ,  $check_cs_id); 
        $select->bindParam(':ls_id'     ,  $check_ls_id); 
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['check_num'] > 0) {


            echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "error",
                        title: "**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=course_lesson.php?course_lesson=$check_cs_id\">";
            exit;

        } else {

            try {
                
                $insert = $conn->prepare("INSERT INTO course_lesson (cs_id, ls_id, save_date) VALUES (:cs_id, :ls_id, :save_date)");
                $insert->bindParam(':cs_id'     ,  $check_cs_id); 
                $insert->bindParam(':ls_id'     ,  $check_ls_id); 
                $insert->bindParam(':save_date' ,  $save_date); 
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
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=course_lesson.php?course_lesson=$check_cs_id\">";
                    exit;

                } else {

                    echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "error..!!", 
                                showConfirmButton: false,
                                timer: 2000
                            });
                            </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=course_lesson.php?course_lesson=$check_cs_id\">";
                    exit;

                }  

            } catch (PDOException $e) {

                echo $e->getMessage();

            }
        }

        
    }


    if (isset($_POST['btn_del'])) {

        $check_csl_id = $_POST['btn_del'];
        $check_cs_id = $_POST['cs_id'];

        try {

            $delete_t1 = $conn->prepare("DELETE FROM course_lesson WHERE csl_id = :check_id");
            $delete_t1->bindParam(':check_id' , $check_csl_id);
            $delete_t1->execute();

            if ($delete_t1->execute()) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ลบข้อมูลทิ้ง เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=course_lesson.php?course_lesson=$check_cs_id\">";
                exit;

            } else {

                echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                        });
                    </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=course_lesson.php?course_lesson=$check_cs_id\">";
                exit;

            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }
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