<?php 
    require_once '../config/con_db.php';

    if(isset($_GET['cr_sub_lesson'])){

        $ls_id = $_GET['cr_sub_lesson'];

        try {

            $select_cl = $conn->prepare("SELECT c.cs_name, l.ls_name 
            FROM course_lesson cl 
            INNER JOIN course c ON cl.cs_id = c.cs_id
            INNER JOIN lesson l ON cl.ls_id = l.ls_id
            WHERE cl.ls_id = :ls_id");
            $select_cl->bindParam(':ls_id',  $ls_id); 
            $select_cl->execute();
            $row_cl = $select_cl->fetch(PDO::FETCH_ASSOC);

            if(isset($_GET['show'])){

                $sls_id = $_GET['show'];

                $select_show= $conn->prepare("SELECT * FROM sub_lesson WHERE sls_id = :sls_id");
                $select_show->bindParam(':sls_id', $sls_id ); 
                $select_show->execute();

                $row_show = $select_show->fetch(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $e) {

            $e->getMessage();

        }
    }

?>
<div class="row">

    <div class="col s12 m1 l1"></div>

    <div class="col s12 m10 l10">

        <div class="section section-data-tables">

            <div class="row">
                <div class="pt-1 pb-0" id="breadcrumbs-wrapper">

                    <div class="container">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="breadcrumbs-title"><span> <?= $row_cl['ls_name']; ?></span></h5>
                            </div>
                            <div class="col s12 m6 l6 right-align-md">
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item">คอร์สเรียนของฉัน</li>
                                    <li class="breadcrumb-item">คอร์ส : <?= $row_cl['cs_name']; ?></li>
                                    <li class="breadcrumb-item active">บทเรียน : <?= $row_cl['ls_name']; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col s12 m3">
                    <div id="videos" class="card card-tabs">
                        <div class="card-content">

                            <div class="row">

                                <div class="col s12 m12">
                                    <ul class="collection with-header">

                                        <h5><I>รายการหัวข้อย่อย</I></h5>

                                        <li class="collection-header"></li>

                                        <?php 


                                            $select = $conn->prepare("SELECT sls_id, sls_name  FROM sub_lesson WHERE ls_id = :ls_id");
                                            $select->bindParam(':ls_id', $ls_id ); 
                                            $select->execute();

                                            $i = 1;
                                            while($row = $select->fetch(PDO::FETCH_ASSOC))
                                            {
                                                if($row['sls_id'] != $sls_id){
                                                    $li = '<li class="collection-item">';
                                                } else { 
                                                    $li = '<li class="collection-item active">';
                                                }
                                        ?>

                                        <?= $li; ?>
                                        <div>
                                            <?= $i++; ?> - <?= $row['sls_name']; ?>
                                            <a href="?cr_sub_lesson=<?= $ls_id; ?>&show=<?= $row['sls_id']; ?>"
                                                class="secondary-content">
                                                <i class="material-icons">send</i>
                                            </a>
                                        </div>
                                        </li>

                                        <?php } ?>


                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <?php if(isset($_GET['show'])){ ?>

                <div class="col s12 m9 animate fadeUp">
                    <div class="card">
                        <div class="card-content">

                            <h5><I>วิดีโอสื่อการเรียนการสอน</I></h5>

                            <div class="row">
                                <div class="col s12">
                                    <div class="video-container">
                                        <iframe width="640" height="360"
                                            src="https://www.youtube.com/embed/<?= $row_show['sls_youtube']; ?>"
                                            allowfullscreen=""></iframe>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-3">

                            <h5><I>กิจกรรม</I></h5>

                            <div class="row">

                                <div class="col s12 m6 mt-1">
                                    <a href="?cr_exe=<?= $row_show['sls_id']; ?>&back=<?= $check_id; ?>" class="btn btn-block btn-large
                            gradient-45deg-green-teal">
                                        ทำแบบฝึกหัด
                                    </a>
                                </div>
                                <div class="col s12 m6 mt-1">
                                    <a href="?cr_quiz=<?= $row_show['sls_id']; ?>&back=<?= $check_id; ?>" class="btn btn-block btn-large
                            gradient-45deg-deep-purple-blue">
                                        ทำแบบทดสอบ
                                    </a>
                                </div>
                            </div>

                            <hr class="mt-3">

                            <h5><I>เอกสารประกอบ</I></h5>

                            <div class="row">
                                <div class="col s12 m4 mt-1">
                                    <a href="../admin/sub-lessons/upload/<?= $row_show['sls_img']; ?>" target="_bank"
                                        class="btn btn-block btn-large gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">
                                        รูปภาพ
                                    </a>
                                </div>
                                <div class="col s12 m4 mt-1">
                                    <a href="../admin/sub-lessons/upload/<?= $row_show['sls_sheet']; ?>" target="_bank"
                                        class="btn btn-block btn-large gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">
                                        ใบความรู้
                                    </a>
                                </div>
                                <div class="col s12 m4 mt-1">
                                    <a href="../admin/sub-lessons/upload/<?= $row_show['sls_answer']; ?>" target="_bank"
                                        class="btn btn-block btn-large gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1">
                                        ใบเฉลยแบบฝึกหัด
                                    </a>
                                </div>
                            </div>

                            <hr class="mt-3">

                            <h5><I>อ้างอิง</I></h5>

                            <div class="row">
                                <div class="col s12">

                                    <p><?= $row_show['sls_refer']; ?></p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <?php } else { ?>

                <div class="col s12 m9 animate fadeUp">
                    <div id="videos" class="card card-tabs">
                        <div class="card-content">
                            <h4>คลิก...!! เลือกหัวข้อย่อย เพื่อเริ่มการเรียนรู้กันเลย</h4>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>

        </div>

    </div>

    <div class="col s12 m1 l1"></div>

</div>