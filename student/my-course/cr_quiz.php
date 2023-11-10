<?php

if (isset($_GET['cr_quiz'])) {

    $sls_id = $_GET['cr_quiz'];
    $cs_id = $_GET['cs_id'];

    try {

        $select = $conn->prepare("SELECT sls_id, sls_name, z_id FROM sub_lesson WHERE sls_id = :sls_id");
        $select->bindParam(':sls_id',  $sls_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        $select_qz = $conn->prepare("SELECT * FROM quiz WHERE z_id = :z_id");
        $select_qz->bindParam(':z_id',  $row['z_id']);
        $select_qz->execute();
        $row_qz = $select_qz->fetch(PDO::FETCH_ASSOC);

        $select_p1 = $conn->prepare("SELECT count(qzq_id) as num_p1 FROM qz_question WHERE z_id=:z_id AND tyz_id=1 AND tyq_id=1");
        $select_p1->bindParam(':z_id',  $row['z_id']);
        $select_p1->execute();
        $row_p1 = $select_p1->fetch(PDO::FETCH_ASSOC);

        $select_p2 = $conn->prepare("SELECT count(qzq_id) as num_p2 FROM qz_question WHERE z_id=:z_id AND tyz_id=1 AND tyq_id=2");
        $select_p2->bindParam(':z_id',  $row['z_id']);
        $select_p2->execute();
        $row_p2 = $select_p2->fetch(PDO::FETCH_ASSOC);

        $select_p3 = $conn->prepare("SELECT count(qzq_id) as num_p3 FROM qz_question WHERE z_id=:z_id AND tyz_id=1 AND tyq_id=3");
        $select_p3->bindParam(':z_id',  $row['z_id']);
        $select_p3->execute();
        $row_p3 = $select_p3->fetch(PDO::FETCH_ASSOC);

        $select_k1 = $conn->prepare("SELECT count(qzq_id) as num_k1 FROM qz_question WHERE z_id=:z_id AND tyz_id=2 AND tyq_id=1");
        $select_k1->bindParam(':z_id',  $row['z_id']);
        $select_k1->execute();
        $row_k1 = $select_k1->fetch(PDO::FETCH_ASSOC);

        $select_k2 = $conn->prepare("SELECT count(qzq_id) as num_k2 FROM qz_question WHERE z_id=:z_id AND tyz_id=2 AND tyq_id=2");
        $select_k2->bindParam(':z_id',  $row['z_id']);
        $select_k2->execute();
        $row_k2 = $select_k2->fetch(PDO::FETCH_ASSOC);

        $select_k3 = $conn->prepare("SELECT count(qzq_id) as num_k3 FROM qz_question WHERE z_id=:z_id AND tyz_id=2 AND tyq_id=3");
        $select_k3->bindParam(':z_id',  $row['z_id']);
        $select_k3->execute();
        $row_k3 = $select_k3->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item"><a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>">ห้องเรียน </a></li>
        <li class="breadcrumb-item active" aria-current="page">หัวข้อย่อย: <?= $row['sls_name']; ?> / แบบทดสอบ: <?= $row_qz['z_name']; ?></li>
    </ol>
</nav>

<div class="row">

    <div class="col-12 col-sm-12 mb-5">
        <div class="card h-100">

            <h4 class="card-header text-white bg-purple">แบบทดสอบ / <?= $row_qz['z_name']; ?></h4>


            <div class="card-body">

                <dl class="row">
                    <dd class="col-sm-12">
                        <h1 class="text-center">แบบทดสอบ<?= $row_qz['z_name']; ?></h1>
                    </dd>

                    <dt class="col-sm-1"></dt>
                    <dd class="col-sm-2">
                        <h4 class="">
                            <B><U>คำอธิบาย:</U></B>
                        </h4>
                    </dd>
                    <dd class="col-sm-9">
                        <h4 class="">
                            <small><?= $row_qz['z_detail']; ?></small>
                        </h4>
                    </dd>

                    <dt class="col-sm-1"></dt>
                    <dd class="col-sm-2">
                        <h4 class="">
                            <B><U>1. ข้อสอบด้าน P:</U></B>
                        </h4>
                    </dd>
                    <dd class="col-sm-9">
                        <dl>
                            <h4 class=""><small><B>แบบปรนัย :</B> <?= $row_p1['num_p1']; ?> ข้อ</small>
                        </dl>
                        <dl>
                            <h4 class=""><small><B>แบบอัตรนัย :</B> <?= $row_p2['num_p2']; ?> ข้อ</small>
                        </dl>
                        <dl>
                            <h4 class=""><small><B>แบบถูกหรือผิด :</B> <?= $row_p3['num_p3']; ?> ข้อ</small>
                        </dl>
                    </dd>

                    <dt class="col-sm-1"></dt>
                    <dd class="col-sm-2">
                        <h4 class="">
                            <B><U>2. ข้อสอบด้าน K:</U></B>
                        </h4>
                    </dd>
                    <dd class="col-sm-9">
                        <dl>
                            <h4 class=""><small><B>แบบปรนัย :</B> <?= $row_k1['num_k1']; ?> ข้อ</small>
                        </dl>
                        <dl>
                            <h4 class=""><small><B>แบบอัตรนัย :</B> <?= $row_k2['num_k2']; ?> ข้อ</small>
                        </dl>
                        <dl>
                            <h4 class=""><small><B>แบบถูกหรือผิด :</B> <?= $row_k3['num_k3']; ?> ข้อ</small>
                        </dl>
                    </dd>

                    <dt class="col-sm-1"></dt>
                    <dd class="col-sm-2">
                        <h4 class="">
                            <B><U>ให้เวลาทำข้อสอบ:</U></B>
                        </h4>
                    </dd>
                    <dd class="col-sm-9">
                        <h4 class="">
                            <small><?= $row_qz['k_hour']; ?> ชั่วโมง <?= $row_qz['k_minute']; ?> นาที</small>
                        </h4>
                    </dd>

                </dl>


            </div>

            <div class="card-footer">

                <div class="d-grid gap-2 col-9 mx-auto">
                    <a href="?cr_quiz_start=<?= $row_qz['z_id']; ?>&sls_id=<?= $sls_id; ?>&cs_id=<?= $cs_id; ?>" class="btn btn-lg btn-warning">
                        เริ่มทำทำข้อสอบ
                    </a>
                </div>

            </div>

        </div>
    </div>

    <div class="col-12 col-sm-12 mb-3">
        <div class="card h-100">

            <h4 class="card-header text-white bg-purple">ประวัติ</h4>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%; text-align: center; vertical-align: middle;">ครั้งที่</th>
                                <th style="width:10%; text-align: center; vertical-align: middle;">ใช้ผลคะแนน</th>
                                <th style="width:15%; text-align: center; vertical-align: middle;">ด้าน P</th>
                                <th style="width:15%; text-align: center; vertical-align: middle;">ด้าน K</th>
                                <th style="width:15%; text-align: center; vertical-align: middle;">เวลาบันทึก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            

                            $select_pk = $conn->prepare("SELECT * FROM qz_point WHERE sls_id=:sls_id AND u_id=:u_id ORDER BY qzp_id ASC");
                            $select_pk->bindParam(':sls_id',  $sls_id);
                            $select_pk->bindParam(':u_id' ,  $_SESSION['id']);
                            $select_pk->execute();

                            $i = 1;
                            while ($row_pk = $select_pk->fetch(PDO::FETCH_ASSOC)) {

                                if ($row_pk['p_point'] >= $row_qz['z_criteria']) {
                                    $p_show = 'ผ่าน';
                                } else {
                                    $p_show = 'ไม่ผ่าน';
                                }

                                if ($row_pk['k_point'] >= $row_qz['z_criteria']) {
                                    $k_show = 'ผ่าน';
                                } else {
                                    $k_show = 'ไม่ผ่าน';
                            }
                            ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php  if($row_pk['qz_use'] === 1) {?>
                                           <i class="bi bi-check-square text-primary"></i>
                                        <?php } ?>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row_pk['p_point']; ?> % = <?= $p_show; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row_pk['k_point']; ?> % = <?= $k_show; ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $row_pk['save_date']; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>

                    </table>
                </div>

            </div>

            <div class="card-footer">

            </div>

        </div>
    </div>

    <div class="col-12 col-sm-12 mb-3 text-end mt-5">

        <a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>" class="">
            ย้อนกลับ
        </a>
    </div>

</div>