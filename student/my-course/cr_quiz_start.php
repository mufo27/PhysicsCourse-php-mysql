<?php

if (isset($_GET['cr_quiz_start'])) {

    $z_id = $_GET['cr_quiz_start'];
    $sls_id = $_GET['sls_id'];
    $cs_id = $_GET['cs_id'];

    try {
        $select = $conn->prepare("SELECT sls.sls_name, ls.ls_name, z.z_name, z.k_hour, z.k_minute
                                    FROM sub_lesson sls 
                                    INNER JOIN lesson ls ON sls.ls_id = ls.ls_id
                                    INNER JOIN quiz z ON sls.z_id = z.z_id
                                    WHERE sls.z_id = :z_id
                                ");
        $select->bindParam(':z_id',  $z_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        $time = ($row['k_hour'] * 60 * 60) + ($row['k_minute'] * 60);
        // $time = 10;

        if (!isset($_SESSION['timeend'])) {
            unset($_SESSION['timeend']);
            $endtime = time() + $time;
            $_SESSION['timeend'] = $endtime;
        }

        ($_SESSION['timeend'] - time()) < 0 ? $EndTime = 0 :  $EndTime = $_SESSION['timeend'] - time();

        if ($EndTime <= 0) {
            unset($_SESSION['timeend']);
            //session_destroy(); 
        }
        unset($_SESSION['timeend']);
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>



<style type="text/css">
    input.largerCheckbox {
        width: 20px;
        height: 20px;
    }
</style>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item"><a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>">ห้องเรียน </a></li>
        <li class="breadcrumb-item"><a href="?cr_quiz=<?= $sls_id ?>&cs_id=<?= $cs_id ?>">หัวข้อย่อย / แบบทดสอบ</a></li>
        <li class="breadcrumb-item active" aria-current="page">เริ่มทำ</li>
    </ol>
</nav>

<div class="alert alert-danger text-center mt-5" role="alert">
    <h3 id="timer"></h3>
</div>

<h3 class="mt-5">เรื่อง: <?= $row['z_name']; ?></h3>

<form id="form-send" action="" method="post" enctype="multipart/form-data">

    <input type="hidden" name="send" value="1">

    <input type="hidden" name="z_id" value="<?= $z_id; ?>">
    <input type="hidden" name="sls_id" value="<?= $sls_id; ?>">

    <div class="row mt-2">

        <?php

        //ตรวจสอบด้าน p=1, k=2
        $select_side = $conn->prepare("SELECT tyz_id FROM qz_question WHERE z_id = :z_id GROUP BY tyz_id");
        $select_side->bindParam(':z_id',  $z_id);
        $select_side->execute();

        // $number_side = 1;
        $s = 1; //แบบทดสอบ ด้าน P
        while ($row_side = $select_side->fetch(PDO::FETCH_ASSOC)) {

            $num = $s;

            if ($row_side['tyz_id'] === 1) {

                $title = $s++ . '. ' . 'แบบทดสอบ ด้าน P';

                $nm = 'txt_p_';
                $nmm = 'txt_pp_';

                //ตรวจสอบรูปแบบ ปรนัย=1, อัตรนัย=2, ถูกหรือผิด=3
                $select_type = $conn->prepare("SELECT tyq_id FROM qz_question WHERE z_id = :z_id AND tyz_id=:tyz_id GROUP BY tyq_id");
                $select_type->bindParam(':z_id',  $z_id);
                $select_type->bindParam(':tyz_id',  $row_side['tyz_id']);
                $select_type->execute();
            } else {

                $title =  $s++ . '. ' . 'แบบทดสอบ ด้าน K';

                $nm = 'txt_k_';
                $nmm = 'txt_kk_';

                //ตรวจสอบรูปแบบ ปรนัย=1, อัตรนัย=2, ถูกหรือผิด=3
                $select_type = $conn->prepare("SELECT tyq_id FROM qz_question WHERE z_id = :z_id AND tyz_id=:tyz_id GROUP BY tyq_id");
                $select_type->bindParam(':z_id',  $z_id);
                $select_type->bindParam(':tyz_id',  $row_side['tyz_id']);
                $select_type->execute();
            }

        ?>
 
            <div class="col-12 col-sm-12 mb-3">
                <div class="card h-100">

                    <h5 class="card-header text-white bg-purple"><?= $title; ?></h5>

                    <?php
                    $number_type = 1;
                    // $number_answer=1;
                    $n = 1; //ส่วนที่
                    $i = 1; //ข้อที่
                    while ($row_type = $select_type->fetch(PDO::FETCH_ASSOC)) {

                        if ($row_type['tyq_id'] === 1) {
                            $txt_top = 'ส่วนที่ ' . $n++ . ' คำถามแบบปรนัย : <small>ข้อสอบปรนัย ให้นักเรียนเลือกคำตอบที่ถูกต้อง</small>';
                        } else if ($row_type['tyq_id'] === 2) {
                            $txt_top = 'ส่วนที่ ' . $n++ . ' คำถามแบบอัตรนัย : <small>ข้อสอบอัตนัย ให้นักเรียนเติมคำตอบที่ถูกต้องลงในช่องคำตอบ</small>';
                        } else {
                            $txt_top = 'ส่วนที่ ' . $n++ . ' คำถามแบบเลือกตอบ (ถูกหรือผิด) : <small>ข้อสอบถูกหรือผิด ให้นักเรียนเลือกคำตอบ "ถูก" สำหรับข้อที่ถูกต้อง และเลือกคำตอบ "ผิด" สำหรับข้อที่ไม่ถูกต้อง</small>';
                        }
                    ?>
                        <div class="card-body">

                            <h5><?= $txt_top; ?></h5>

                            <?php

                            $select_qz = $conn->prepare("SELECT * FROM qz_question WHERE z_id=:z_id AND tyz_id=:tyz_id AND tyq_id=:tyq_id");
                            $select_qz->bindParam(':z_id',  $z_id);
                            $select_qz->bindParam(':tyz_id', $row_side['tyz_id']);
                            $select_qz->bindParam(':tyq_id', $row_type['tyq_id']);
                            $select_qz->execute();


                            $no = 1;

                            while ($row_qz = $select_qz->fetch(PDO::FETCH_ASSOC)) {

                                $sum = $i;
                            ?>

                                <div class="row mb-5">
                                    <div class="col-12 col-sm-1">
                                        <h6>ข้อที่ <?= $i++; ?></h6> 
                                    </div>
                                    <div class="col-12 col-sm-11">
                                        <h6><?= $row_qz['qzq_name']; ?></h6>
                                        <img src="../admin/quizs/upload/<?= $row_qz['qzq_image']; ?>" class="img-fluid rounded mx-auto d-block" alt="" width="" height="">
                                    </div>

                                    <?php if ($row_qz['tyq_id'] === 1) { ?>

                                        <input type="hidden" name="<?= $nmm . $sum; ?>" value="<?= $row_qz['qzq_answer']; ?>">

                                        <div class="col-12 col-sm-12">
                                            <table class="table">
                                                <tbody>

                                                    <?php for ($j = 1; $j <= 5; $j++) { ?>
                                                        <tr>
                                                            <td style="width:5%; text-align: center; vertical-align: middle;">
                                                                <?= $j; ?>.
                                                            </td>
                                                            <td style="width:15%; text-align: center; vertical-align: middle;">
                                                                <label>
                                                                    <input type="radio" class="largerCheckbox" name="<?= $nm . $sum; ?>" value="<?= $j; ?>">
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td style="width:80%; vertical-align: middle;">
                                                                <?= $row_qz['opt_' . $j]; ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else if ($row_qz['tyq_id'] === 2) { ?>

                                        <input type="hidden" name="<?= $nmm . $sum; ?>" value="<?= $row_qz['qzq_answer']; ?>">

                                        <div class="col-12 col-sm-12">
                                            <label for="" class="form-label">คำตอบ <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" name="<?= $nm . $sum; ?>">

                                        </div>
                                    <?php } else { ?>

                                        <input type="hidden" name="<?= $nmm . $sum; ?>" value="<?= $row_qz['qzq_answer']; ?>">

                                        <div class="col-12 col-sm-12">
                                            <label for="" class="form-label">คำตอบ <small class="text-danger">*</small></label>
                                            <select class="form-select" id="" name="<?= $nm . $sum; ?>">
                                                <option selected disabled value="">-- เลือก--</option>
                                                <option value="ถูก">ถูก</option>
                                                <option value="ผิด">ผิด</option>
                                            </select>

                                        </div>
                                    <?php } ?>

                                </div>
                                
                                <hr class="text-dark " style="height: 5px;">


                            <?php } ?>

                        </div>
                    <?php  } ?>

                    <input type="hidden" name="type_<?= $num; ?>" value="<?= $sum; ?>">

                    <div class="card-footer"></div>

                </div>
            </div>

        <?php  } ?>

        <div class="d-grid gap-2 col-9 mx-auto">
            <button type="submit" name="btn_send" class="btn btn-lg btn-primary">
                ยืนยันคำตอบ
            </button>
        </div>
        <div class="d-grid gap-2 col-3 mx-auto">
            <button type="reset" name="btn_reset" class="btn btn-lg btn-secondary">
                ล้าง
            </button>
        </div>

    </div>
</form>

<?php


if (isset($_POST['btn_send']) || isset($_POST['send'])) {

    $z_id    =  $_POST['z_id'];
    $sls_id  = $_POST['sls_id'];
    $u_id    = $_SESSION['id'];

    $p_val = 0;
    $k_val = 0;

    $p_point = 0;
    $k_point = 0;

    $side = 2;

    for ($x = 1; $x <= $side; $x++) {

        if ($x === 1) {

            $check_type1 = $_POST['type_' . $x];


            for ($y = 1; $y <= $check_type1; $y++) {

                $txt_p = $_POST['txt_p_' . $y];
                $txt_pp = $_POST['txt_pp_' . $y];

                if (trim($txt_p) === trim($txt_pp)) {
                    $p_val++;
                } else {
                    $p_val = $p_val;
                }
            }
        } else {

            $check_type2 = $_POST['type_' . $x];

            for ($z = 1; $z <= $check_type2; $z++) {

                $txt_k = $_POST['txt_k_' . $z];
                $txt_kk = $_POST['txt_kk_' . $z];

                if (trim($txt_k) === trim($txt_kk)) {
                    $k_val++;
                } else {
                    $k_val = $k_val;
                }
            }
        }
    }


    $p_point =  ($p_val * 100) / ($y - 1);
    $k_point =  ($k_val * 100) / ($z - 1);


    try {


        $insert = $conn->prepare("INSERT INTO qz_point (z_id, sls_id, u_id, p_point, k_point) VALUES (:z_id, :sls_id, :u_id, :p_point, :k_point)");
        $insert->bindParam(':sls_id', $sls_id);
        $insert->bindParam(':z_id', $z_id);
        $insert->bindParam(':u_id', $u_id);
        $insert->bindParam(':p_point',  $p_point);
        $insert->bindParam(':k_point',  $k_point);
        $insert->execute();
        $last_id = $conn->lastInsertId();

        if ($insert) {

            echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ตรวจคำตอบ เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?cr_quiz_sum_point=$last_id&cs_id=$cs_id\">";
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


<script type="text/javascript">
    var pastTime = <?= $EndTime; ?>;

    function mycountdown() {
        if (pastTime > 0) {

            pastTime -= 1;

            var hours = Math.floor(pastTime % (60 * 60 * 24) / (60 * 60));
            var minutes = Math.floor(pastTime % (60 * 60) / (60));
            var seconds = Math.floor(pastTime % 60);

            document.getElementById('timer').innerHTML = "เหลือเวลา " + hours + " ชั่วโมง " + minutes + " นาที " + seconds + " วินาที ";

        } else {

            Swal.fire({
                icon: "error",
                title: 'หมดเวลาทำแบบทดสอบ',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-send').submit();
                }
            })


        }
    }
    if (pastTime > 0) {
        setInterval(mycountdown, 1000);
    }
</script>