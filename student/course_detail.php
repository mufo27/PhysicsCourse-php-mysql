<?php

if (isset($_GET['course_detail'])) {

    $cs_id = $_GET['course_detail'];

    try {

        $select_cos = $conn->prepare("SELECT * FROM course WHERE cs_id=:cs_id");
        $select_cos->bindParam(':cs_id',  $cs_id);
        $select_cos->execute();
        $row_cos = $select_cos->fetch(PDO::FETCH_ASSOC);

        if ($row_cos['cs_for'] === 1) {
            $show_for = 'ม.1';
        } else if ($row_cos['cs_for'] === 2) {
            $show_for = 'ม.2';
        } else if ($row_cos['cs_for'] === 3) {
            $show_for = 'ม.3';
        } else if ($row_cos['cs_for'] === 4) {
            $show_for = 'ม.4';
        } else if ($row_cos['cs_for'] === 5) {
            $show_for = 'ม.5';
        } else if ($row_cos['cs_for'] === 6) {
            $show_for = 'ม.6';
        } else if ($row_cos['cs_for'] === 7) {
            $show_for = 'ป.ตรี';
        } else {
            $show_for = 'ทั้งหมด';
        }

        if ($row_cos['cs_img'] != '') {
            $show_img_cos = '../admin/course/upload/' . $row_cos['cs_img'];
        } else {
            $show_img_cos = '../img-test/cos-1.png';
        }
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียน</a></li>
        <li class="breadcrumb-item active" aria-current="page">รายละเอียด</li>
    </ol>
</nav>

<div class="d-flex align-items-center p-2 my-3 text-white rounded shadow-sm  bg-purple">
    <div class="lh-1">
        <h1 class="h1 mb-0 text-white lh-1">รายละเอียด (Detail)</h1>
    </div>
</div>

<div class="row">

    <div class="col-12 col-sm-8 mb-3">
        <div class="card h-100">
            <img src="<?= $show_img_cos; ?>" class="card-img-top" alt="" height="450px">
            <div class="card-body">
                <h5 class="card-title"><?= $row_cos['cs_name']; ?></h5>
                <p class="card-text"><?= $row_cos['cs_detail']; ?></p>
            </div>
            <div class="card-body">
                <?php

                $selectls = $conn->prepare("SELECT cl.*, (SELECT l.ls_name FROM lesson l where l.ls_id = cl.ls_id ) AS lson_name FROM course_lesson cl where cl.cs_id = :cs_id ");
                $selectls->bindParam(':cs_id',  $cs_id);
                $selectls->execute();

                $i = 1;
                while ($rowls = $selectls->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <ol class="list-group  mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-start active">
                            <div class="ms-2 me-auto">
                                <h5>บทที่ <?= $i++; ?> : <?= $rowls['lson_name']; ?></h5>
                            </div>
                        </li>
                        <?php

                        $ls_id =  $rowls['ls_id'];
                        $selectsls = $conn->prepare("SELECT *  FROM sub_lesson WHERE ls_id = :ls_id");
                        $selectsls->bindParam(':ls_id', $ls_id);
                        $selectsls->execute();

                        $n = 1;
                        while ($rowsls = $selectsls->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <?= $n++; ?> : <?= $rowsls['sls_name']; ?>
                                </div>
                                <a href="#" class="">
                                    <span class="badge bg-primary py-2 rounded-pill"><i class="bi bi-play-circle-fill"></i></span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ol>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-4 mb-3">
        <div class="card h-40">
            <div class="card-body">
                <h4 class="card-title mb-3"><i class="bi bi-check-square"></i> สำหรับ : <?= $show_for; ?></h4>
                <h4 class="card-title mb-3"><i class="bi bi-alarm"></i> ใช้เวลาเรียน : <?= $row_cos['k_hour']; ?> ชม. <?= $row_cos['k_minute']; ?> น.</h4>
                <h4 class="card-title mb-3">
                    <i class="bi bi-currency-bitcoin"></i>
                    <?php if ($row_cos['cs_pay_status'] === 0) { ?>
                        ค่าธรรมเนียม : ฟรี
                    <?php } else { ?>
                        ค่าธรรมเนียม : <?= $row_cos['cs_pay_num']; ?> บาท
                    <?php } ?>
                </h4>

            </div>
            <div class="card-footer">
                <div class="d-grid gap-2">
                    <?php
                    if ($_SESSION['status'] == 0) {

                        $select_check = $conn->prepare("SELECT * FROM course_register WHERE cs_id=:cs_id AND u_id=:u_id");
                        $select_check->bindParam(':cs_id',  $cs_id);
                        $select_check->bindParam(':u_id',  $_SESSION['id']);
                        $select_check->execute();
                        $row_check = $select_check->fetch(PDO::FETCH_ASSOC);

                        if (isset($row_check['approve_status'])) {
                            if ($row_check['approve_status'] === 0) {

                                echo '<div class="d-grid gap-2">
                                        <button type="button" class="btn btn-warning">
                                            <h2 class="card-title"> รออนุมัติ</h2>
                                        </button>
                                    </div>
                                    <form action="" method="post">
                                        <input type="hidden" name="rs_id" value="'.$row_check['rs_id'].'">
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-outline-danger" name="btn_cancel_cos">
                                                <h2 class="card-title"> ยกเลิก</h2>
                                            </button>
                                        </div>
                                    </form>';
                            } else {

                                echo '<div class="d-grid gap-2">
                                        <a href="?cr_course" class="btn btn-success">
                                            <h2 class="card-title"> อนุมัติเรียบร้อย</h2>
                                        </a>
                                    </div>';
                            }
                        } else {
                            echo '<form action="" method="post">
                                        <input type="hidden" name="u_id" value="'.$_SESSION['id'].'">
                                        <input type="hidden" name="cs_id" value="'.$cs_id.'">
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary" name="btn_regis_cos">
                                                <h2 class="card-title"> ลงทะเบียน</h2>
                                            </button>
                                        </div>
                                    </form>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['btn_regis_cos'])) {

    $u_id      = $_POST['u_id'];
    $cs_id     = $_POST['cs_id'];
    $approve_status = 0;

    $select = $conn->prepare("SELECT count(*) AS check_num FROM course_register WHERE u_id = :u_id AND cs_id = :cs_id");
    $select->bindParam(':u_id',  $u_id);
    $select->bindParam(':cs_id',  $cs_id);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row['check_num'] > 0) {

        echo '<script type="text/javascript">
                Swal.fire({
                icon: "error",
                title: "ล้มเหลว",
                text: "**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!."
                });
            </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?course_detail=$cs_id\">";
        exit;
    } else {

        try {

            $insert = $conn->prepare("INSERT INTO course_register (u_id, cs_id, approve_status) 
            VALUES (:u_id, :cs_id, :approve_status)");
            $insert->bindParam(':u_id',  $u_id);
            $insert->bindParam(':cs_id',  $cs_id);
            $insert->bindParam(':approve_status',  $approve_status);
            $insert->execute();

            if ($insert) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ลงทะเบียนคอร์สเรียน เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?course_detail=$cs_id\">";
                exit;
            } else {

                echo "<script>alert('error..!!')</script>";
                echo "<script>window.location='javascript:history.back(-1)';</script>";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}

if (isset($_POST['btn_cancel_cos'])) {

    $rs_id      = $_POST['rs_id'];
    
    try {

        $delete_cr = $conn->prepare("DELETE FROM course_register WHERE rs_id=:rs_id");
        $delete_cr->bindParam(':rs_id' , $rs_id);
        $delete_cr->execute();

        if ($delete_cr) {

            echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "ยกเลิก เรียบร้อย...!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?course_detail=$cs_id\">";
            exit;
        } else {

            echo "<script>alert('error..!!')</script>";
            echo "<script>window.location='javascript:history.back(-1)';</script>";
            exit;
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
   
}
?>