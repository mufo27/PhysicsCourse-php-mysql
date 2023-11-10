<?php

if (isset($_GET['cr_lesson'])) {

    $cs_id = $_GET['cr_lesson'];

    try {

        $select_cos = $conn->prepare("SELECT * FROM course WHERE cs_id=:cs_id");
        $select_cos->bindParam(':cs_id',  $cs_id);
        $select_cos->execute();
        $row_cos = $select_cos->fetch(PDO::FETCH_ASSOC);

        if (isset($_GET['show'])) {

            $sls_id = $_GET['show'];

            $select_show = $conn->prepare("SELECT * FROM sub_lesson WHERE sls_id = :sls_id");
            $select_show->bindParam(':sls_id', $sls_id);
            $select_show->execute();
            $row_show = $select_show->fetch(PDO::FETCH_ASSOC);

            $select_pg = $conn->prepare("SELECT count(pg_id) num_pg FROM progress WHERE cs_id=:cs_id AND sls_id=:sls_id AND u_id=:u_id");
            $select_pg->bindParam(':cs_id', $cs_id);
            $select_pg->bindParam(':sls_id', $sls_id);
            $select_pg->bindParam(':u_id', $_SESSION['id']);
            $select_pg->execute();
            $row_pg = $select_pg->fetch(PDO::FETCH_ASSOC);

            if($row_pg['num_pg'] < 1){

                $insert_pg = $conn->prepare("INSERT INTO progress (cs_id, sls_id, u_id) VALUES (:cs_id, :sls_id, :u_id)");
                $insert_pg->bindParam(':cs_id' ,  $cs_id);
                $insert_pg->bindParam(':sls_id',  $sls_id);
                $insert_pg->bindParam(':u_id'  ,  $_SESSION['id']);
                $insert_pg->execute();

            }
        

        }
    } catch (PDOException $e) {

        $e->getMessage();
    }
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?course">คอร์สเรียนของฉัน</a></li>
        <li class="breadcrumb-item active" aria-current="page">ห้องเรียน</li>
    </ol>
</nav>

<div class="d-flex align-items-center p-2 my-3 text-white rounded shadow-sm  bg-purple">
    <div class="lh-1">
        <h1 class="h1 mb-0 text-white lh-1">ห้องเรียน</h1>
    </div>
</div>

<div class="row">

    <div class="col-12 col-sm-4 mb-3">

        <div class="card h-100">
            <h4 class="card-header">เลือกรายการ</h4>
            <div class="card-body">
                <?php

                $selectls = $conn->prepare("SELECT cl.*, (SELECT l.ls_name FROM lesson l where l.ls_id = cl.ls_id ) AS lson_name FROM course_lesson cl where cl.cs_id = :cs_id ");
                $selectls->bindParam(':cs_id',  $cs_id);
                $selectls->execute();

                $i = 1;
                while ($rowls = $selectls->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <ol class="list-group mb-3">
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
                                <a href="?cr_lesson=<?= $cs_id; ?>&show=<?= $rowsls['sls_id']; ?>" class="">
                                    <span class="badge bg-danger py-2 rounded-pill"><i class="bi bi-play-circle-fill"></i> เล่น</span>
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
            <div class="card-footer">
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-success" href="?cr_query=<?= $cs_id; ?>">แบบสอบถาม</a>
                    <a class="btn btn-lg btn-danger" href="?cr_report=<?= $cs_id; ?>">สรุปผลการเรียน</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-8 mb-3">
        <?php if (isset($_GET['show'])) { ?>
            <div class="card h-100">
                <h4 class="card-header">แสดงเนื้อหา</h4>
                <div class="card-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/<?= $row_show['sls_youtube']; ?>" title="YouTube video" allowfullscreen></iframe>
                    </div>
                    <div class="image mt-5">
                        <h4 class="">ใบความรู้เสริม</h4>
                        <img src="../admin/sub-lessons/upload/<?= $row_show['sls_img']; ?>" class="img-fluid rounded mx-auto d-block" alt="" width="" height="">
                    </div>
                    <div class="action mt-5">

                        <h4 class="">เอกสารประกอบ</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <a href="../admin/sub-lessons/upload/<?= $row_show['sls_sheet']; ?>" target="_bank" class="w-100 btn btn-lg btn-dark mb-3">
                                    ใบความรู้
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <a href="../admin/sub-lessons/upload/<?= $row_show['sls_answer']; ?>" target="_bank" class="w-100 btn btn-lg btn-dark mb-3">
                                    ใบเฉลยแบบฝึกหัด
                                </a>
                            </div>
                        </div>

                        <h4 class="">กิจกรรม</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <a href="?cr_exe=<?= $row_show['sls_id']; ?>&cs_id=<?= $cs_id; ?>" class="w-100 btn btn-lg btn-warning mb-3">แบบฝึกหัด</a>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <a href="?cr_quiz=<?= $row_show['sls_id']; ?>&cs_id=<?= $cs_id; ?>" class="w-100 btn btn-lg btn-primary mb-3">แบบทดสอบ</a>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <h4 class="">อ้างอิง</h4>
                    <div class="row">
                        <div class="col-12 col-sm-12 mb-3">
                            <p><?= $row_show['sls_refer']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <?php } else { ?>
            <div class="card h-100">
                <h4 class="card-header">แสดงเนื้อหา</h4>
                <div class="card-body text-center">
                    <h1>โปรดเลือกรายการ</h1>
                </div>

            </div>
        <?php } ?>
    </div>
</div>