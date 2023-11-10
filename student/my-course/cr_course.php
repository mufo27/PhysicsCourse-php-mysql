<?php

//ถ้าค้นหาข้อมูล
if (isset($_POST['btn_search'])) {

    //ข้อความที่ต้องการค้นหา
    $txt_search = $_POST['txt_search'];

    if ($_SESSION['status'] === 0) {

        // $cr_id = $_GET['cr_course'];

        $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num,
                                        (SELECT count(crr.cs_id)  FROM course_register crr WHERE crr.cs_id = c.cs_id AND crr.cr_id IS NOT NULL) AS num_all 
                                        FROM course_register cr INNER JOIN course c ON cr.cs_id = c.cs_id 
                                        WHERE cr.u_id = :u_id 
                                        AND cr.approve_status = 1 
                                        AND c.cs_status = 1 
                                        AND c.cs_name LIKE '%" . $txt_search . "%'
                                    ");
        $select_cos->bindParam(':u_id',  $_SESSION['id']);
        $select_cos->execute();

    } else {

        $cr_id = $_GET['cr_course'];

        $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num,
                                        (SELECT count(crr.cs_id)  FROM course_register crr WHERE crr.cs_id = c.cs_id AND crr.cr_id IS NOT NULL) AS num_all 
                                        FROM course_register cr 
                                        INNER JOIN course c ON cr.cs_id = c.cs_id 
                                        WHERE cr.cr_id = :cr_id 
                                        AND c.cs_status = 1
                                        AND c.cs_name LIKE '%" . $txt_search . "%'
                                    ");
        $select_cos->bindParam(':cr_id',  $cr_id);
        $select_cos->execute();
    }

} else {

    if ($_SESSION['status'] === 0) {

        // $cr_id = $_GET['cr_course'];

        $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num,
                        (SELECT count(crr.cs_id)  FROM course_register crr WHERE crr.cs_id = c.cs_id AND crr.cr_id IS NOT NULL) AS num_all 
                        FROM course_register cr INNER JOIN course c ON cr.cs_id = c.cs_id 
                        WHERE cr.u_id = :u_id AND cr.approve_status = 1 AND c.cs_status = 1");
        $select_cos->bindParam(':u_id',  $_SESSION['id']);
        $select_cos->execute();

    } else {

        $cr_id = $_GET['cr_course'];

        $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num,
                        (SELECT count(crr.cs_id)  FROM course_register crr WHERE crr.cs_id = c.cs_id AND crr.cr_id IS NOT NULL) AS num_all 
                        FROM course_register cr 
                        INNER JOIN course c ON cr.cs_id = c.cs_id 
                        WHERE cr.cr_id = :cr_id AND c.cs_status = 1");
        $select_cos->bindParam(':cr_id',  $cr_id);
        $select_cos->execute();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">คอร์สเรียนของฉัน</li>
    </ol>
</nav>

<div class="align-items-center p-2 my-3 text-white rounded shadow-sm  bg-purple">
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="lh-1">
                <h1 class="h1 mb-0 text-white lh-1">คอร์สเรียนของฉัน (My Course)</h1>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <form class="d-flex" action="" method="post">
                <?php if (!isset($txt_search)) { ?>
                    <input class="form-control me-2" type="search" name="txt_search" placeholder="กรอกตัวอักษร" aria-label="Search">
                <?php } else { ?>
                    <input class="form-control me-2" type="search" name="txt_search" value="<?= $txt_search; ?>" placeholder="กรอกตัวอักษร" aria-label="Search">
                <?php } ?>
                <button class="btn btn-warning" type="submit" name="btn_search">ค้นหา</button>
            </form>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php include('cr_course_show.php'); ?>
</div>

