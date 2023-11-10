<?php

if ($_SESSION['status'] === 0) {

    $u_id = $_SESSION['id'];

    $select = $conn->prepare("SELECT c.* 
    FROM course_register cr 
    INNER JOIN course c ON cr.cs_id = c.cs_id 
    WHERE cr.u_id = :u_id AND approve_status = 1");
    $select->bindParam(':u_id',  $u_id);
    $select->execute();
} else {

    $u_id = $_SESSION['id'];

    $select_sl = $conn->prepare("SELECT cr_id FROM student_list WHERE u_id = :u_id ");
    $select_sl->bindParam(':u_id', $u_id);
    $select_sl->execute();
    $row_sl = $select_sl->fetch(PDO::FETCH_ASSOC);

    $cr_id = $row_sl['cr_id'];

    $select = $conn->prepare("SELECT c.* 
    FROM course_register cr INNER JOIN course c ON cr.cs_id = c.cs_id 
    WHERE cr.cr_id = :cr_id ");
    $select->bindParam(':cr_id',  $cr_id);
    $select->execute();
}

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ใบเกียรติบัตร</li>
    </ol>
</nav>

<div class="align-items-center p-2 my-3 text-white rounded shadow-sm  bg-purple">
    <div class="lh-1">
        <h1 class="h1 mb-0 text-white lh-1">ใบเกียรติบัตร (Certificate)</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead class="">
                        <tr>
                            <th style="width:10%; text-align: center; vertical-align: middle;">อับดับ</th>
                            <th style="width:20%; text-align: center; vertical-align: middle;">รหัส</th>
                            <th style="width:50%; vertical-align: middle;">คอร์สเรียน</th>
                            <th style="width:20%; text-align: center; vertical-align: middle;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        $i = 1;
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                            $cs_id = $row['cs_id'];

                            $select_ls = $conn->prepare("SELECT ls_id FROM course_lesson where cs_id = :cs_id ");
                            $select_ls->bindParam(':cs_id',  $cs_id);
                            $select_ls->execute();

                            $pg = 0;
                            $exe = 0;
                            $qzp = 0;
                            $loop = 0;

                            while ($row_ls = $select_ls->fetch(PDO::FETCH_ASSOC)) {


                                $ls_id = $row_ls['ls_id'];

                                $select_sls = $conn->prepare("SELECT sls_id FROM sub_lesson WHERE ls_id = :ls_id");
                                $select_sls->bindParam(':ls_id', $ls_id);
                                $select_sls->execute();

                                while ($row_sls = $select_sls->fetch(PDO::FETCH_ASSOC)) {

                                    $loop++;

                                    $sls_id = $row_sls['sls_id'];

                                    $select_pg = $conn->prepare("SELECT count(pg_id) as pg_num FROM progress WHERE cs_id=:cs_id AND sls_id=:sls_id AND u_id=:u_id");
                                    $select_pg->bindParam(':cs_id', $cs_id);
                                    $select_pg->bindParam(':sls_id', $sls_id);
                                    $select_pg->bindParam(':u_id', $u_id);
                                    $select_pg->execute();
                                    $row_pg = $select_pg->fetch(PDO::FETCH_ASSOC);

                                    if ($row_pg['pg_num'] > 0) {
                                        $pg++;
                                    }

                                    //เช็คแบบฝึกหัด
                                    $select_exe = $conn->prepare("SELECT count(exa_id) as exe_num FROM ex_status WHERE sls_id=:sls_id AND u_id=:u_id");
                                    $select_exe->bindParam(':sls_id', $sls_id);
                                    $select_exe->bindParam(':u_id', $u_id);
                                    $select_exe->execute();
                                    $row_exe = $select_exe->fetch(PDO::FETCH_ASSOC);
                                    if ($row_exe['exe_num'] > 0) {
                                        $exe++;
                                    }

                                    //เช็คแบบทดสอบ
                                    $select_qzp = $conn->prepare("SELECT count(qzp_id) as qzp_num FROM qz_point WHERE sls_id=:sls_id AND u_id=:u_id");
                                    $select_qzp->bindParam(':sls_id', $sls_id);
                                    $select_qzp->bindParam(':u_id', $u_id);
                                    $select_qzp->execute();
                                    $row_qzp = $select_qzp->fetch(PDO::FETCH_ASSOC);

                                    if ($row_qzp['qzp_num'] > 0) {
                                        $qzp++;
                                    }
                                }
                            }
                        ?>

                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                <td style="text-align: center; vertical-align: middle;"><?= $row['cs_code']; ?></td>
                                <td style="vertical-align: middle;"><?= $row['cs_name']; ?></td>
                                <td style="text-align: center; vertical-align: middle;">

                                    <?php //if ($pg === $loop && $exe === $loop && $qzp === $loop) { ?>
                                        <div class="d-grid gap-2">
                                            <a href="cer_create.php?cs=<?= $row['cs_id']; ?>&us=<?= $_SESSION['id']; ?>" class="btn btn-warning" target="_bank">ดาวน์โหลด</a>
                                        </div>
                                    <?php //} ?>
                                    
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>