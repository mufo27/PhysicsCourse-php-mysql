<?php

if (isset($_GET['cr_report'])) {

    $cs_id = $_GET['cr_report'];

    try {

        $select_cos = $conn->prepare("SELECT * FROM course WHERE cs_id=:cs_id");
        $select_cos->bindParam(':cs_id',  $cs_id);
        $select_cos->execute();
        $row_cos = $select_cos->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item"><a href="?cr_lesson=<?= $cs_id; ?>">ห้องเรียน</a></li>
        <li class="breadcrumb-item active" aria-current="page">สรุปผลการเรียน</li>
    </ol>
</nav>

<div class="row">
    <div class="col-12 col-sm-12 mb-3">

        <div class="card h-100">

            <h4 class="card-header text-white bg-purple">สรุปผลการเรียน / <?= $row_cos['cs_name']; ?></h4>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th rowspan="2" style="width:25%; text-align: center; vertical-align: middle;">เนื้อหา</th>
                                <th colspan="3" style="width:50%; text-align: center; vertical-align: middle;">ความคืบหน้า</th>
                                <th colspan="3" style="width:30%; text-align: center; vertical-align: middle;">คะแนนทดสอบ</th>
                            </tr>
                            <tr>
                                <th style="width:15%; text-align: center; vertical-align: middle;">การเรียน</th>
                                <th style="width:15%; text-align: center; vertical-align: middle;">แบบฝึกหัด</th>
                                <th style="width:15%; text-align: center; vertical-align: middle;">แบบทดสอบ</th>
                                <th style="width:10%; text-align: center; vertical-align: middle;">รอบปกติ</th>
                                <th style="width:10%; text-align: center; vertical-align: middle;">จำนวนครั้ง</th>
                                <th style="width:10%; text-align: center; vertical-align: middle;">รอบแก้ตัว</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $select_ls = $conn->prepare("SELECT cl.*, (SELECT l.ls_name FROM lesson l where l.ls_id = cl.ls_id ) AS lson_name FROM course_lesson cl where cl.cs_id = :cs_id ");
                            $select_ls->bindParam(':cs_id',  $row_cos['cs_id']);
                            $select_ls->execute();

                            $i = 1;
                            while ($row_ls = $select_ls->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr style="background-color: #e0cffc;">
                                    <td colspan="7" style="vertical-align: middle;">
                                        <?= $i++; ?> <?= $row_ls['lson_name']; ?>
                                    </td>
                                </tr>
                                <?php

                                $select_sls = $conn->prepare("SELECT *  FROM sub_lesson WHERE ls_id = :ls_id");
                                $select_sls->bindParam(':ls_id', $row_ls['ls_id']);
                                $select_sls->execute();

                                $n = 1;
                                while ($row_sls = $select_sls->fetch(PDO::FETCH_ASSOC)) {
 
                                    $select_pg = $conn->prepare("SELECT count(pg_id) as pg_num FROM progress WHERE cs_id=:cs_id AND sls_id=:sls_id AND u_id=:u_id");
                                    $select_pg->bindParam(':cs_id', $row_ls['cs_id']);
                                    $select_pg->bindParam(':sls_id', $row_sls['sls_id']);
                                    $select_pg->bindParam(':u_id', $_SESSION['id']);
                                    $select_pg->execute();
                                    $row_pg = $select_pg->fetch(PDO::FETCH_ASSOC);

                                    if ($row_pg['pg_num'] > 0) {
                                        $show_pg = '<span class="badge bg-primary">เรียนแล้ว</span>';
                                    } else {
                                        $show_pg = '<span class="badge bg-danger">ยังไม่เรียน</span>';
                                    }

                                    $select_exe = $conn->prepare("SELECT count(exa_id) as exe_num FROM ex_status WHERE sls_id=:sls_id AND u_id=:u_id");
                                    $select_exe->bindParam(':sls_id', $row_sls['sls_id']);
                                    $select_exe->bindParam(':u_id', $_SESSION['id']);
                                    $select_exe->execute();
                                    $row_exe = $select_exe->fetch(PDO::FETCH_ASSOC);

                                    if ($row_exe['exe_num'] > 0) {
                                        $show_exe = '<span class="badge bg-primary">ทำแล้ว</span>';
                                    } else {
                                        $show_exe = '<span class="badge bg-danger">ยังไม่ทำ</span>';
                                    }


                                    $select_qzp = $conn->prepare("SELECT count(qzp_id) as qzp_num FROM qz_point WHERE sls_id=:sls_id AND z_id=:z_id AND u_id=:u_id");
                                    $select_qzp->bindParam(':sls_id', $row_sls['sls_id']);
                                    $select_qzp->bindParam(':z_id', $row_sls['z_id']);
                                    $select_qzp->bindParam(':u_id', $_SESSION['id']);
                                    $select_qzp->execute();
                                    $row_qzp = $select_qzp->fetch(PDO::FETCH_ASSOC);

                                    if ($row_qzp['qzp_num'] > 0) {
                                        $show_qzp = '<span class="badge bg-primary">ทำแล้ว</span>';
                                    } else {
                                        $show_qzp = '<span class="badge bg-danger">ยังไม่ทำ</span>';
                                    }

                                    $select_no1 = $conn->prepare("SELECT qz_use FROM qz_point WHERE sls_id=:sls_id AND z_id=:z_id AND u_id=:u_id ORDER BY qzp_id ASC LIMIT 1");
                                    $select_no1->bindParam(':sls_id', $row_sls['sls_id']);
                                    $select_no1->bindParam(':z_id', $row_sls['z_id']);
                                    $select_no1->bindParam(':u_id', $_SESSION['id']);
                                    $select_no1->execute();
                                    $row_no1 = $select_no1->fetch(PDO::FETCH_ASSOC);

                                    if (isset($row_no1['qz_use'])) {
                                        $show_no1 = '<span class="badge bg-primary">ผ่าน</span>';
                                    } else {
                                        $show_no1 = '<span class="badge bg-danger">ไม่ผ่าน</span>';
                                    }

                                    $select_no2 = $conn->prepare("SELECT qz_use FROM qz_point WHERE sls_id=:sls_id AND z_id=:z_id AND u_id=:u_id ORDER BY qzp_id DESC LIMIT 1");
                                    $select_no2->bindParam(':sls_id', $row_sls['sls_id']);
                                    $select_no2->bindParam(':z_id', $row_sls['z_id']);
                                    $select_no2->bindParam(':u_id', $_SESSION['id']);
                                    $select_no2->execute();
                                    $row_no2 = $select_no2->fetch(PDO::FETCH_ASSOC);

                                    if (isset($row_no2['qz_use'])) {
                                        $show_no2 = '<span class="badge bg-primary">ผ่าน</span>';
                                    } else {
                                        $show_no2 = '<span class="badge bg-danger">ไม่ผ่าน</span>';
                                    }

                                ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= $n++; ?> <?= $row_sls['sls_name']; ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= $show_pg; ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= $show_exe; ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= $show_qzp; ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?php if ($row_qzp['qzp_num'] > 0) { ?>
                                                <?= $show_no1; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?= $row_qzp['qzp_num']; ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?php if ($row_qzp['qzp_num'] > 1) { ?>
                                                <?= $show_no2; ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                        </tbody>

                    </table>
                </div>
            </div>

            <div class="card-footer"></div>

        </div>

    </div>
    <div class="col-12 col-sm-12 mb-3 text-end">

        <a href="?cr_lesson=<?= $cs_id; ?>" class="">
            ย้อนกลับ
        </a>
    </div>

</div>