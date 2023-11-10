<?php

if (isset($_GET['cr_quiz_sum_point'])) {

    $qzp_id = $_GET['cr_quiz_sum_point'];
    $cs_id = $_GET['cs_id'];


    try {

        $select_pk = $conn->prepare("SELECT * FROM qz_point WHERE qzp_id=:qzp_id");
        $select_pk->bindParam(':qzp_id',  $qzp_id);
        $select_pk->execute();
        $row_pk = $select_pk->fetch(PDO::FETCH_ASSOC);

        $select_qz = $conn->prepare("SELECT * FROM quiz WHERE z_id = :z_id");
        $select_qz->bindParam(':z_id',  $row_pk['z_id']);
        $select_qz->execute();
        $row_qz = $select_qz->fetch(PDO::FETCH_ASSOC);

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
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item"><a href="?cr_lesson=<?= $cs_id ?>&show=<?= $sls_id ?>">ห้องเรียน </a></li>
        <li class="breadcrumb-item"><a href="?cr_quiz=<?= $sls_id ?>&cs_id=<?= $cs_id ?>">หัวข้อย่อย / แบบทดสอบ</a></li>
        <li class="breadcrumb-item active" aria-current="page">สรุปรายงานผล</li>
    </ol>
</nav>

<div class="col-12 col-sm-12 mb-3">
    <div class="card h-100">

        <h4 class="card-header text-white bg-purple">สรุปรายงานผล</h4>

        <div class="card-body">

            <h1 class="text-center">แบบทดสอบ: <?= $row_qz['z_name']; ?></h1>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%; text-align: center; vertical-align: middle;">#</th>
                            <th style="width:20%; vertical-align: middle;">รายการ</th>
                            <th style="width:20%; text-align: center; vertical-align: middle;">เกณฑ์ผ่าน</th>
                            <th style="width:20%; text-align: center; vertical-align: middle;">ทำข้อสอบได้</th>
                            <th style="width:20%; text-align: center; vertical-align: middle;">สรุป</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="text-align: center; vertical-align: middle;">1</td>
                            <td style="vertical-align: middle;">แบบทดสอบด้าน P</td>
                            <td style="text-align: center; vertical-align: middle;"><?= $row_qz['z_criteria']; ?> %</td>
                            <td style="text-align: center; vertical-align: middle;"><?= $row_pk['p_point']; ?> %</td>
                            <td style="text-align: center; vertical-align: middle;"><?= $p_show; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">2</td>
                            <td style="vertical-align: middle;">แบบทดสอบด้าน K</td>
                            <td style="text-align: center; vertical-align: middle;"><?= $row_qz['z_criteria']; ?> %</td>
                            <td style="text-align: center; vertical-align: middle;"><?= $row_pk['k_point']; ?> %</td>
                            <td style="text-align: center; vertical-align: middle;"><?= $k_show; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <form action="" method="post">

                <div class="row">

                    <div class="d-grid gap-2 col-6 mx-auto">

                        <input type="hidden" name="sls_id" value='<?= $row_pk['sls_id']; ?>'>
                        <input type="hidden" name="z_id" value='<?= $row_pk['z_id']; ?>'>
                        <input type="hidden" name="cs_id" value='<?= $cs_id; ?>'>
                        <input type="hidden" name="qz_use" value='1'>
                        <button tye="submit" name="btn_send" value="<?= $row_pk['qzp_id']; ?>" class="btn btn-lg btn-primary">
                            ยืนยันผลคะแนน
                        </button>

                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="?cr_quiz_start=<?= $row_pk['z_id']; ?>&sls_id=<?= $row_pk['sls_id']; ?>&cs_id=<?= $cs_id; ?>" class="btn btn-lg btn-warning">
                            เริ่มทำไหม่
                        </a>
                    </div>
            </form>

        </div>
    </div>
</div>

<?php
if (isset($_POST['btn_send'])) {

    $qzp_id = $_POST['btn_send'];
    $sls_id = $_POST['sls_id'];
    $z_id   = $_POST['z_id'];
    $cs_id  = $_POST['cs_id'];
    $qz_use = $_POST['qz_use'];

    try {

        $update_tb1 = $conn->prepare("UPDATE qz_point SET qz_use=null WHERE sls_id=:sls_id AND z_id=:z_id AND u_id=:u_id");
        $update_tb1->bindParam(':sls_id',  $sls_id);
        $update_tb1->bindParam(':z_id'  ,  $z_id);
        $update_tb1->bindParam(':u_id'  ,  $_SESSION['id']);
        $update_tb1->execute();

        $update_tb2 = $conn->prepare("UPDATE qz_point SET qz_use=:qz_use WHERE qzp_id=:qzp_id");
        $update_tb2->bindParam(':qzp_id',  $qzp_id);
        $update_tb2->bindParam(':qz_use',  $qz_use);
        $update_tb2->execute();

        if ($update_tb1 && $update_tb2) {

            echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "ยืนยันผลคะแนน เรียบร้อย...!!", 
                                showConfirmButton: false,
                                timer: 2000
                            });
                            </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?cr_quiz=$sls_id&cs_id=$cs_id\">";
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