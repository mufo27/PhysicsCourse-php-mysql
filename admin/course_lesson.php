<?php
require_once('include/auth.inc.php');
require_once('../config/con_db.php');

$cs_id = isset($_GET['course_lesson']) ? $_GET['course_lesson'] : die('Invalid course lesson ID');

// ตั้งค่าหน้าที่ต้องการแสดง
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = 10;
$start_from = ($page - 1) * $per_page;

// ดึงข้อมูลหน้าละ 2 รายการ
$select_check_cs_name = $conn->prepare("SELECT cs_name FROM course c WHERE c.cs_id = :cs_id");
$select_check_cs_name->bindParam(':cs_id', $cs_id, PDO::PARAM_INT);
$select_check_cs_name->execute();
$row_cs_name = $select_check_cs_name->fetch(PDO::FETCH_ASSOC);

// นับจำนวนรายการทั้งหมด
$total_records = $conn->prepare("SELECT COUNT(*) FROM course_lesson cl WHERE cl.cs_id = :cs_id");
$total_records->bindParam(':cs_id', $cs_id, PDO::PARAM_INT);
$total_records->execute();
$total_records = $total_records->fetchColumn();
$total_pages = ceil($total_records / $per_page);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        เพิ่มบทเรียน | ระบบจัดการข้อมูลคอร์สเรียนฟิสิกส์

    </title>

    <?php include('include/header.inc.php') ?>

    <style>
        .form-check-input[type="checkbox"] {
            width: 30px;
            height: 30px;
            margin: center;
        }
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
                        <li class="breadcrumb-item">หน้าแรก</li>
                        <li class="breadcrumb-item">คอร์สเรียน</li>
                        <li class="breadcrumb-item active">เพิ่มบทเรียน</li>
                    </ol>

                    <!-- <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-home'></i> หน้าแรก
                        </h1>
                        <div class="subheader-block d-lg-flex align-items-center">
                        </div>
                    </div> -->

                    <div class="row">

                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">

                                <div class="panel-hdr">
                                    <h1>รายการบทเรียนใน <span class="fw-300 text-info"><i>คอร์สเรียน<?= $row_cs_name['cs_name']; ?></li></i></span></h1>
                                    <div class="panel-toolbar"></div>
                                </div>

                                <div class="panel-container show">
                                    <div class="panel-content">

                                        <!-- START Button  -->
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-md-5">
                                                <a href="course.php?course" class="btn btn-sm btn-secondary">
                                                    <span class="fal fa-step-backward mr-1"></span> ย้อนกลับ
                                                </a>
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
                                                <table id="" class="table table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width:10%; text-align: center; vertical-align: middle;">ลำดับ</th>
                                                            <th style="width:80%; text-align: left; vertical-align: middle;">ชื่อบทเรียน</th>
                                                            <th style="width:10%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            $select_cs_lesson = $conn->prepare("SELECT csl_id, ls_id, (SELECT ls_name FROM lesson l WHERE l.ls_id = cl.ls_id) AS lesson_name 
                                                                                                FROM course_lesson cl 
                                                                                                WHERE cl.cs_id = :cs_id LIMIT :start_from, :per_page");
                                                            $select_cs_lesson->bindParam(':cs_id', $cs_id, PDO::PARAM_INT);
                                                            $select_cs_lesson->bindParam(':start_from', $start_from, PDO::PARAM_INT);
                                                            $select_cs_lesson->bindParam(':per_page', $per_page, PDO::PARAM_INT);
                                                            $select_cs_lesson->execute();

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
                                                                <a class="page-link" href="?course_lesson=<?= $cs_id ?>&page=<?= $page - 1 ?>" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                                                            </li>
                                                        <?php else : ?>
                                                            <li class="page-item disabled">
                                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">ก่อนหน้า</a>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                                                <a class="page-link" href="?course_lesson=<?= $cs_id ?>&page=<?= $i ?>">
                                                                    <?= $i ?>
                                                                    <?php if ($i == $page) : ?>
                                                                        <span class="sr-only">(current)</span>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </li>
                                                        <?php endfor; ?>

                                                        <?php if ($page < $total_pages) : ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="?course_lesson=<?= $cs_id ?>&page=<?= $page + 1 ?>">ถัดไป</a>
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

                        <div class="col-xl-12">
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

                                        <table id="" class="table table-bordered table-striped w-100">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th style="width:10%; text-align: left; vertical-align: middle;">ลำดับ</th>
                                                    <th style="width:80%; text-align: left; vertical-align: middle;">บทเรียน</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เลือก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 

                                                    $select_add = $conn->prepare("SELECT l.ls_id, l.ls_name 
                                                                                FROM lesson l
                                                                                LEFT JOIN course_lesson cl ON l.ls_id = cl.ls_id AND cl.cs_id = :cs_id
                                                                                WHERE cl.ls_id IS NULL");
                                                    $select_add->bindParam(':cs_id', $cs_id, PDO::PARAM_INT);             
                                                    $select_add->execute();
                                                
                                                    $ch = 0;
                                                    $k = 1;
                                                    while($row_add = $select_add->fetch(PDO::FETCH_ASSOC))  { 
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $k++; ?></td>
                                                        <td style="text-align: left; vertical-align: middle;"><?= $row_add['ls_name']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <div class="form-check">
                                                                <input type="hidden" name="ls_id[]" value="<?= $row_add['ls_id']; ?>">
                                                                <input type="checkbox" class="form-check-input position-static" name="check[]" value="<?= $ch++; ?>">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                        <button type="submit" name="btn_save" value="<?= $cs_id; ?>" class="btn btn-success">บันทึกข้อมูล</button>
                                    </div>
                                </form>

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

        $check = $_POST['check'];
        $check_cs_id = $_POST['btn_save'];
        $check_ls_id = $_POST['ls_id'];

        if (empty($check) || $check == 0) {

            echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "โปรด ต้องเลือกอย่างน้อย 1 รายการ"
                    });
                </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=course_lesson.php?course_lesson=$check_cs_id\">";
            exit;

        } else {

            try {
                
                foreach ($check as $key) {
                    $insert = $conn->prepare("INSERT INTO course_lesson (cs_id, ls_id) VALUES (:cs_id, :ls_id)");
                    $insert->bindParam(':cs_id'     ,  $check_cs_id); 
                    $insert->bindParam(':ls_id'     ,  $check_ls_id[$key]); 
                    $insert->execute();
                }
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

</body>
<!-- END Body -->

</html>