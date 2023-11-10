<?php

if (isset($_GET['cr_query'])) {

    $cs_id = $_GET['cr_query'];

    try {

        $select = $conn->prepare("SELECT cs_name FROM course WHERE cs_id = :cs_id");
        $select->bindParam(':cs_id',  $cs_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        $select_status = $conn->prepare("SELECT count(*) AS check_num FROM reply_questionnaire WHERE cs_id=:cs_id AND u_id=:u_id");
        $select_status->bindParam(':cs_id', $cs_id);
        $select_status->bindParam(':u_id', $_SESSION['id']);
        $select_status->execute();
        $row_status = $select_status->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item"><a href="?cr_lesson=<?= $cs_id; ?>">ห้องเรียน</a></li>
        <li class="breadcrumb-item active" aria-current="page">แบบสอบถาม : <?= $row['cs_name']; ?></li>
    </ol>
</nav>

<div class="row">
    <div class="col-12 col-sm-12 mb-3">

        <?php if ($row_status['check_num'] > 0) { ?>

            <div class="card h-100">
                <h4 class="card-header text-white bg-purple"> แบบสอบถาม </h4>
                <div class="card-body">
                    <h1 class="text-center">คุณได้ทำแบบสอบถามนี้ เรียบร้อย</h1>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a class="btn btn-lg btn-warning" href="?cr_lesson=<?= $cs_id; ?>">เสร็จสิ้น</a>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="card h-100">
                <h4 class="card-header text-white bg-purple">แบบสอบถาม</h4>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <dl class="row">
                            <dd class="col-sm-12">
                                <h1 class="text-center">แบบประเมินความพึงพอใจการใช้บทเรียนออนไลน์</h1>
                            </dd>

                            <dt class="col-sm-2"></dt>
                            <dd class="col-sm-10">
                                <h4 class="">
                                    <B><U>คำชี้แจง</U></B>
                                    <small>แบบประเมินฉบับนี้มีวัตถุประสงค์เพื่อสอบถามความพึงพอใจในการใช้บทเรียนออนไลน์</small>
                                </h4>
                            </dd>

                            <dt class="col-sm-1"></dt>
                            <dt class="col-sm-11">
                                <h4 class="">
                                    <small>เรื่องขั้นตอนการทำโครงงาน โดยแบบประเมินความพึงพอใจ แบ่งออกเป็น 3 ตอน ดังนี้</small>
                                </h4>
                            </dt>

                            <dt class="col-sm-2"></dt>
                            <dd class="col-sm-10">
                                <h4 class="">
                                    <B>ตอนที่ 1</B>
                                    <small>ข้อมูลทั่วไปของผู้ตอบแบบประเมิน</small>
                                </h4>
                            </dd>

                            <dt class="col-sm-2"></dt>
                            <dd class="col-sm-10">
                                <h4 class="">
                                    <B>ตอนที่ 2</B>
                                    <small>ความพึงพอใจในการใช้บทเรียนออนไลน์ ในการตอบแบบประเมินโปรดแสดงความคิดเห็น</small>
                                </h4>
                            </dd>

                            <dt class="col-sm-1"></dt>
                            <dt class="col-sm-11">
                                <h4 class="">
                                    <small>ของท่าน โดยทำเครื่องหมาย <i class="bi bi-check-circle-fill"></i> ลงในช่องระดับความพึงพอใจ</small>
                                </h4>
                            </dt>

                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9">
                                <h4 class=""><small>ระดับ 1 หมายถึง พึงพอใจอยู่ในระดับน้อยที่สุด</small></h4>
                            </dd>

                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9">
                                <h4 class=""><small>ระดับ 2 หมายถึง พึงพอใจอยู่ในระดับน้อย</small></h4>
                            </dd>

                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9">
                                <h4 class=""><small>ระดับ 3 หมายถึง พึงพอใจอยู่ในระดับปานกลาง</small></h4>
                            </dd>

                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9">
                                <h4 class=""><small>ระดับ 4 หมายถึง พึงพอใจอยู่ในระดับมาก</small></h4>
                            </dd>

                            <dt class="col-sm-3"></dt>
                            <dd class="col-sm-9">
                                <h4 class=""><small>ระดับ 5 หมายถึง พึงพอใจอยู่ในระดับมากที่สุด</small></h4>
                            </dd>

                            <dt class="col-sm-2"></dt>
                            <dd class="col-sm-10">
                                <h4 class="">
                                    <B>ตอนที่ 3</B>
                                    <small>ข้อเสนอแนะ</small>
                                </h4>
                            </dd>

                            <hr>

                            <dt class="col-sm-1"></dt>
                            <dd class="col-sm-11">
                                <h4 class="">
                                    <B>ตอนที่ 1</B>
                                    <small>ข้อมูลทั่วไปของผู้ตอบแบบประเมิน</small>
                                </h4>

                            </dd>

                            <dt class="col-sm-2"></dt>
                            <dd class="col-sm-10">
                                <h4 class="">
                                    <B><?= $_SESSION['fullname']; ?></B>
                                </h4>

                            </dd>

                            <dt class="col-sm-1"></dt>
                            <dd class="col-sm-10">
                                <h4 class="">
                                    <B>ตอนที่ 2</B>
                                    <small>ความพึงพอใจในการใช้บทเรียนออนไลน์เรื่องขั้นตอนการทาโครงงาน</small>
                                </h4>
                            </dd>

                        </dl>

                <form action="" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-sm-12">

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:5%; text-align: center; vertical-align: middle;">ลำดับ</th>
                                            <th style="width:45%; text-align: center; vertical-align: middle;">รายการประเมิน</th>
                                            <th style="width:10%; text-align: center; vertical-align: middle;">มากที่สุด</th>
                                            <th style="width:10%; text-align: center; vertical-align: middle;">มาก</th>
                                            <th style="width:10%; text-align: center; vertical-align: middle;">ปานกลาง</th>
                                            <th style="width:10%; text-align: center; vertical-align: middle;">น้อย</th>
                                            <th style="width:10%; text-align: center; vertical-align: middle;">น้อยที่สุด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select = $conn->prepare("SELECT * FROM top_questionnaire WHERE del_status = 0");
                                        $select->execute();

                                        $no = 0;
                                        $y = 0;
                                        $i = 1;
                                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                            $no = $i++;
                                        ?>
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <?= $no; ?>
                                                    <input type="hidden" name="tp_id[]" value="<?= $row['tp_id']; ?>">
                                                    <input type="hidden" name="checks[]" value="<?= $y++; ?>">
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <p><?= $row['tp_name']; ?></p>
                                                </td>

                                                <?php

                                                $val = 5;
                                                for ($k = 1; $k <= 5; $k++) {
                                                ?>

                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <label>
                                                            <input type="radio" class="form-check-input" name="txt_<?= $no; ?>" value="<?= $val--; ?>" required="">
                                                            <span></span>
                                                        </label>
                                                       
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="cs_id" value="<?= $cs_id; ?>">
                    <input type="hidden" name="u_id" value="<?= $_SESSION['id']; ?>">

                    <div class="card-footer">
                        <div class="row">
                            <div class="d-grid gap-2 col-9 mx-auto">
                                <button type="submit" name="btn_send" class="btn btn-lg btn-primary">
                                    บันทึกข้อมูล
                                </button>
                            </div>
                            <div class="d-grid gap-2 col-3 mx-auto">
                                <button type="reset" class="btn btn-lg btn-secondary">
                                    ล้าง
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>

    </div>
</div>




<?php

if (isset($_POST['btn_send'])) {


    $checks = $_POST['checks'];
    $tp_id = $_POST['tp_id'];
    $cs_id = $_POST['cs_id'];
    $u_id = $_POST['u_id'];
    
    try {

        foreach ($checks as $key) {

            $txt = $_POST['txt_' . ($key + 1)];

            $insert = $conn->prepare("INSERT INTO reply_questionnaire (tp_id, cs_id, u_id, ry_number) VALUES (:tp_id, :cs_id, :u_id, :ry_number)");
            $insert->bindParam(':tp_id', $tp_id[$key]);
            $insert->bindParam(':cs_id', $cs_id);
            $insert->bindParam(':u_id', $u_id);
            $insert->bindParam(':ry_number',  $txt);
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
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?cr_query=$cs_id\">";
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