<?php

if (isset($_GET['cr_exe'])) {

    $sls_id = $_GET['cr_exe'];
    $cs_id = $_GET['cs_id'];

    try {

        $select = $conn->prepare("SELECT sls_id, sls_name, ex_id, ls_id FROM sub_lesson WHERE sls_id = :sls_id");
        $select->bindParam(':sls_id',  $sls_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        $select_exe = $conn->prepare("SELECT * FROM exercises WHERE ex_id = :ex_id");
        $select_exe->bindParam(':ex_id',  $row['ex_id']);
        $select_exe->execute();
        $row_exe = $select_exe->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        $e->getMessage();
    }
}


if (isset($_POST['btn_send'])) {

    $sls_id    = $_POST['sls_id'];
    $ex_id     = $_POST['ex_id'];
    $u_id      = $_SESSION['id'];

    $select_status = $conn->prepare("SELECT count(*) as status_num FROM ex_status WHERE sls_id=:sls_id AND ex_id=:ex_id AND u_id=:u_id");
    $select_status->bindParam(':sls_id',  $sls_id);
    $select_status->bindParam(':ex_id',  $ex_id);
    $select_status->bindParam(':u_id',  $u_id);
    $select_status->execute();
    $row_status = $select_status->fetch(PDO::FETCH_ASSOC);

    try {

        if ($row_status['status_num'] === 0) {

            $insert = $conn->prepare("INSERT INTO ex_status (sls_id, ex_id, u_id) VALUES (:sls_id, :ex_id, :u_id)");
            $insert->bindParam(':sls_id',  $sls_id);
            $insert->bindParam(':ex_id',  $ex_id);
            $insert->bindParam(':u_id',  $u_id);
            $insert->execute();

            if ($insert) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ตรวจคำตอบและบันทึกสถานะ เรียบร้อย...!!",
                            timer: 2000
                        });
                        </script>';
                // echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?cr_exe=$cs_id&back=$back&answer=1\">";
                // exit;

            } else {

                echo "<script>alert('error..!!')</script>";
                echo "<script>window.location='javascript:history.back(-1)';</script>";
                exit;
            }
        } else {

            echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ตรวจคำตอบ เรียบร้อย...!!",
                            timer: 2000
                        });
                        </script>';
            // echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?cr_exe=$cs_id&back=$back&answer=1\">";
            // exit;

        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}


?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item"><a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>">ห้องเรียน</a></li>
        <li class="breadcrumb-item active" aria-current="page">หัวข้อย่อย: <?= $row['sls_name']; ?> / แบบฝึกหัด: <?= $row_exe['ex_name']; ?></li>
    </ol>
</nav>

<div class="row">

    <form action="" method="post" enctype="multipart/form-data">
        <?php
        $select_type = $conn->prepare("SELECT tyq_id FROM ex_question WHERE ex_id = :ex_id GROUP BY tyq_id");
        $select_type->bindParam(':ex_id',  $row_exe['ex_id']);
        $select_type->execute();

        $i = 1;
        while ($row_type = $select_type->fetch(PDO::FETCH_ASSOC)) {

            // $num = $i++;

            if ($row_type['tyq_id'] === 1) {
                $txt_top = 'ส่วนที่ ' . $i++ . ' คำถามแบบปรนัย : <small>ข้อสอบปรนัย ให้นักเรียนเลือกคำตอบที่ถูกต้อง</small>';
            } else if ($row_type['tyq_id'] === 2) {
                $txt_top = 'ส่วนที่ ' . $i++ . ' คำถามแบบอัตรนัย : <small>ข้อสอบอัตนัย ให้นักเรียนเติมคำตอบที่ถูกต้องลงในช่องคำตอบ</small>';
            } else {
                $txt_top = 'ส่วนที่ ' . $i++ . ' คำถามแบบเลือกตอบ (ถูกหรือผิด) : <small>ข้อสอบถูกหรือผิด ให้นักเรียนเลือกคำตอบ "ถูก" สำหรับข้อที่ถูกต้อง และเลือกคำตอบ "ผิด" สำหรับข้อที่ไม่ถูกต้อง</small>';
            }
        ?>
            <div class="col-12 col-sm-12 mb-3">
                <div class="card h-100">

                    <h4 class="card-header text-white bg-purple"><?= $txt_top; ?></h4>

                    <input type="hidden" name="tyq_id<?= $row_type['tyq_id']; ?>" value="<?= $row_type['tyq_id']; ?>">

                    <div class="card-body">

                        <?php
                        if ($row_type['tyq_id'] === 1) {

                            $select_exe_t1 = $conn->prepare("SELECT * FROM ex_question WHERE ex_id = :ex_id AND tyq_id = :tyq_id");
                            $select_exe_t1->bindParam(':ex_id',  $row['ex_id']);
                            $select_exe_t1->bindParam(':tyq_id',  $row_type['tyq_id']);
                            $select_exe_t1->execute();

                            $check_true_frm1 = 0;

                            $k = 1;
                            while ($row_exe_t1 = $select_exe_t1->fetch(PDO::FETCH_ASSOC)) {
                                $val = $k++;

                                if (isset($_POST['btn_send'])) {

                                    $ans = $_POST['opt_' . $val];
                                } else {
                                    $ans = '';
                                }
                        ?>


                                <div class="row mb-5">
                                    <div class="col-12 col-sm-1">
                                        <h6>ข้อที่ <?= $val; ?></h6>
                                    </div>
                                    <div class="col-12 col-sm-11">
                                        <h6><?= $row_exe_t1['exq_name']; ?></h6>
                                        <img src="../admin/exercises/upload/<?= $row_exe_t1['exq_image']; ?>" class="img-fluid rounded mx-auto d-block" alt="" width="" height="">
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <table class="table">
                                            <tbody>

                                                <?php
                                                for ($j = 1; $j <= 5; $j++) {
                                                    include('check_ans.php');
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>

                                    <?php if ($ans != '') { ?>
                                        <div class="col-12 col-sm-6 mb-2">
                                            <a href="../admin/exercises/upload/<?= $row_exe_t1['exq_sheet']; ?>" target="_bank" class="btn btn-success">
                                                คลิกดูไฟล์เฉลย...!!
                                            </a>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <a href="https://www.youtube.com/watch?v=<?= $row_exe_t1['exq_youtube']; ?>" target="_bank" class="btn btn-warning">
                                                คลิกดูคลิปเฉลย...!!
                                            </a>
                                        </div>
                                    <?php } ?>

                                </div>

                                <hr class="text-dark " style="height: 5px;">

                            <?php
                            }
                        } else if ($row_type['tyq_id'] === 2) {

                            $select_exe_t2 = $conn->prepare("SELECT * FROM ex_question WHERE ex_id = :ex_id AND tyq_id = :tyq_id");
                            $select_exe_t2->bindParam(':ex_id',  $row['ex_id']);
                            $select_exe_t2->bindParam(':tyq_id',  $row_type['tyq_id']);
                            $select_exe_t2->execute();

                            $check_true_frm2 = 0;

                            $kk = 1;
                            while ($row_exe_t2 = $select_exe_t2->fetch(PDO::FETCH_ASSOC)) {
                                $val2 = $kk++;

                                if (isset($_POST['btn_send'])) {

                                    $ans2 = $_POST['txt_answer_' . $val2];
                                    $check_ans2 = '<p>' . $ans2 . '</p>';

                                    if (trim($row_exe_t2['exq_answer']) === trim($check_ans2)) {
                                        $check_true_frm2++;
                                        $sh_icon2 = '<h1 class="mt-4"><i class="bi bi-check-lg text-success"></i></h1>';
                                    } else {
                                        $check_true_frm2 = $check_true_frm2;
                                        $sh_icon2 = '<h1 class="mt-4"><i class="bi bi-x-lg text-danger"></i></h1>';
                                    }
                                } else {
                                    $ans2 = '';
                                }
                            ?>
                                <div class="row mb-5">

                                    <div class="col-12 col-sm-1">
                                        <h6>ข้อที่ <?= $val2; ?></h6>
                                    </div>
                                    <div class="col-12 col-sm-11">
                                        <h6><?= $row_exe_t2['exq_name']; ?></h6>
                                        <img src="../admin/exercises/upload/<?= $row_exe_t2['exq_image']; ?>" class="img-fluid rounded mx-auto d-block" alt="" width="" height="">
                                    </div>

                                    <div class="col-12 col-sm-10">
                                        <label for="" class="form-label">คำตอบ <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" name="txt_answer_<?= $val2; ?>" value="<?= $ans2; ?>" required="">
                                    </div>

                                    <div class="col-12 col-sm-2">
                                        <?php if ($ans2 != '') { ?>
                                            <?= $sh_icon2; ?>
                                        <?php } ?>
                                    </div>

                                    <?php if ($ans2 != '') { ?>
                                        <div class="col-12 col-sm-12 mb-2">
                                            <a href="../admin/exercises/upload/<?= $row_exe_t2['exq_sheet']; ?>" target="_bank" class="btn btn-success">
                                                คลิกดูไฟล์เฉลย...!!
                                            </a>
                                        </div>

                                        <div class="col-12 col-sm-12">
                                            <a href="https://www.youtube.com/watch?v=<?= $row_exe_t2['exq_youtube']; ?>" target="_bank" class="btn btn-warning">
                                                คลิกดูคลิปเฉลย...!!
                                            </a>
                                        </div>
                                    <?php } ?>

                                </div>

                                <hr class="text-dark " style="height: 5px;">


                            <?php
                            }
                        } else {

                            $select_exe_t3 = $conn->prepare("SELECT * FROM ex_question WHERE ex_id = :ex_id AND tyq_id = :tyq_id");
                            $select_exe_t3->bindParam(':ex_id',  $row['ex_id']);
                            $select_exe_t3->bindParam(':tyq_id',  $row_type['tyq_id']);
                            $select_exe_t3->execute();

                            $check_true_frm3 = 0;

                            $kkk = 1;
                            while ($row_exe_t3 = $select_exe_t3->fetch(PDO::FETCH_ASSOC)) {
                                $val3 = $kkk++;

                                if (isset($_POST['btn_send'])) {

                                    $ans3 = $_POST['txt_yn_' . $val3];
                                    $title = $ans3;

                                    if (trim($row_exe_t3['exq_answer']) === trim($ans3)) {
                                        $check_true_frm3++;
                                        $sh_icon3 = '<h1 class="mt-4"><i class="bi bi-check-lg text-success"></i></h1>';
                                    } else {
                                        $check_true_frm3 = $check_true_frm3;
                                        $sh_icon3 = '<h1 class="mt-4"><i class="bi bi-x-lg text-danger"></i></h1>';
                                    }
                                } else {
                                    $ans3 = '';
                                    $title = 'เลือก';
                                }

                            ?>

                                <div class="row mb-5">

                                    <div class="col-12 col-sm-1">
                                        <h6>ข้อที่ <?= $val3; ?></h6>
                                    </div>
                                    <div class="col-12 col-sm-11">
                                        <h6><?= $row_exe_t3['exq_name']; ?></h6>
                                        <img src="../admin/exercises/upload/<?= $row_exe_t3['exq_image']; ?>" class="img-fluid rounded mx-auto d-block" alt="" width="" height="">
                                    </div>

                                    <div class="col-12 col-sm-10">
                                        <label for="" class="form-label">คำตอบ <small class="text-danger">*</small></label>
                                        <select class="form-select" id="" name="txt_yn_<?= $val3; ?>" required>
                                            <option selected disabled value="">-- <?= $title; ?> --</option>
                                            <option value="ถูก">ถูก</option>
                                            <option value="ผิด">ผิด</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-2">
                                        <?php if ($ans3 != '') { ?>
                                            <?= $sh_icon3; ?>
                                        <?php } ?>
                                    </div>

                                    <?php if ($ans3 != '') { ?>

                                        <div class="col-12 col-sm-12 mb-2">
                                            <a href="../admin/exercises/upload/<?= $row_exe_t3['exq_sheet']; ?>" target="_bank" class="btn btn-success">
                                                คลิกดูไฟล์เฉลย...!!
                                            </a>
                                        </div>

                                        <div class="col-12 col-sm-12">
                                            <a href="https://www.youtube.com/watch?v=<?= $row_exe_t3['exq_youtube']; ?>" target="_bank" class="btn btn-warning">
                                                คลิกดูคลิปเฉลย...!!
                                            </a>
                                        </div>

                                    <?php } ?>


                                </div>

                                <hr class="text-dark " style="height: 5px;">


                        <?php }
                        } ?>

                    </div>

                    <div class="card-footer">

                    </div>

                </div>
            </div>
        <?php } ?>


        <div class="row">

            <?php if (!isset($_POST['btn_send'])) { ?>

                <input type="hidden" name="sls_id" value="<?= $sls_id; ?>">
                <input type="hidden" name="ex_id" value="<?= $row['ex_id']; ?>">

                <div class="d-grid gap-2 col-9 mx-auto">
                    <button type="submit" name="btn_send" class="btn btn-lg btn-primary">
                        ตรวจคำตอบ
                    </button>
                </div>
                <div class="d-grid gap-2 col-3 mx-auto">
                    <button type="reset" name="btn_reset" class="btn btn-lg btn-secondary">
                        ล้าง
                    </button>
                </div>
            <?php

            } else {

                $tyq_id1 = $_POST['tyq_id1'];
                $tyq_id2 = $_POST['tyq_id2'];
                $tyq_id3 = $_POST['tyq_id3'];

                $total_1 = $val;
                $total_2 = $val2;
                $total_3 = $val3;

                $check_false_frm1 = $total_1 - $check_true_frm1;
                $check_false_frm2 = $total_2 - $check_true_frm2;
                $check_false_frm3 = $total_3 - $check_true_frm3;

            ?>

                <div class="col-12 col-sm-12 mb-3">
                    <div class="card h-100">

                        <h4 class="card-header text-white bg-warning">สรุปรายงานผล</h4>

                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:30%; text-align: center; vertical-align: middle;">รูปแบบ</th>
                                        <th style="width:20%; text-align: center; vertical-align: middle;">ทั้งหมด</th>
                                        <th style="width:20%; text-align: center; vertical-align: middle;">ถูก</th>
                                        <th style="width:20%; text-align: center; vertical-align: middle;">ผิด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if ($tyq_id1 === '1') {
                                        echo '<tr>
                                                    <td>แบบปรนัย</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $total_1 . '</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $check_true_frm1 . '</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $check_false_frm1 . '</td>
                                                </tr>';
                                    }

                                    if ($tyq_id2 === '2') {
                                        echo '<tr>
                                                    <td>แบบอัตรนัย</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $total_2 . '</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $check_true_frm2 . '</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $check_false_frm2 . '</td>
                                                </tr>';
                                    }

                                    if ($tyq_id3 === '3') {
                                        echo '<tr>
                                                    <td>แบบถูกหรือผิด</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $total_3 . '</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $check_true_frm3 . '</td>
                                                    <td style="text-align: center; vertical-align: middle;">' . $check_false_frm3 . '</td>
                                                </tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto">
                    <a href="?cr_exe=<?= $sls_id; ?>&cs_id=<?= $cs_id; ?>" class="btn btn-lg btn-info">
                        เริ่มทำไหม่
                    </a>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>" class="btn btn-lg btn-danger">
                        เสร็จสิ้น
                    </a>
                </div>

            <?php } ?>
        </div>


    </form>


    <div class="col-12 col-sm-12 mb-3 text-end mt-5">

        <a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>" class="">
            ย้อนกลับ
        </a>
    </div>

</div>