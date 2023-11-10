<?php

    $select_banner1 = $conn->prepare("SELECT * FROM web_banner");
    $select_banner1->execute();

    $select_banner2 = $conn->prepare("SELECT * FROM web_banner");
    $select_banner2->execute();

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">หน้าแรก</li>
    </ol>
</nav>

<section class="mt-5">

    <div class="row">
        <div class="col-12 col-sm-7 mb-3">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">

                    <?php
                    $bn1 = 0;
                    while ($row_banner1 = $select_banner1->fetch(PDO::FETCH_ASSOC)) {
                        $actives1 = '';
                        if ($bn1 === 0) {
                            $actives1 = 'active';
                        }
                    ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $bn1; ?>" class="<?= $actives1; ?>"></button>
                    <?php $bn1++;
                    } ?>

                </div>
                <div class="carousel-inner">

                    <?php
                    $bn2 = 0;
                    while ($row_banner2 = $select_banner2->fetch(PDO::FETCH_ASSOC)) {
                        $actives2 = '';
                        if ($bn2 === 0) {
                            $actives2 = 'active';
                        }
                    ?>
                        <div class="carousel-item <?= $actives2; ?>">
                            <img src="../admin/banner/upload/<?= $row_banner2['bn_img']; ?>" class="d-block w-100" alt="" style="height: 350px;">
                        </div>
                    <?php
                        $bn2++;
                    }
                    ?>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-12 col-sm-5 mb-3">

            <div class="card h-100">
                <h4 class="card-header text-white bg-purple"><i class="bi bi-newspaper"></i> ประชาสัมพันธ์ (News)</h4>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <?php
                            $select_n = $conn->prepare("SELECT * FROM news where n_status = 1 limit 5");
                            $select_n->execute();

                            $i = 1;
                            while ($row_n = $select_n->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td style="width:10%; text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                    <td style="width:70%; vertical-align: middle;"><i class="bi bi-volume-up-fill text-warning"></i> <?= $row_n['n_top']; ?></td>
                                    <td style="width:20%; text-align: center; vertical-align: middle;"><a href="?news_detail=<?= $row_n['n_id']; ?>"><small>อ่านเพิ่มเติม</small></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</section>

<?php

for ($x = 1; $x <= 3; $x++) {

    if ($x == 1) {

        $txt_top = 'คอร์สเรียนแนะนำ (Recommended Course)';

        $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num,
                                            (SELECT count(crr.cs_id)  FROM course_register crr WHERE crr.cs_id = c.cs_id AND crr.cr_id IS NOT NULL) AS num_all
                                            FROM course c 
                                            WHERE c.rcm_status = 1 AND c.cs_status = 1 
                                            ORDER BY c.cs_id ASC
                                        ");
        $select_cos->execute();
    } else if ($x == 2) {

        $txt_top = 'คอร์สเรียนมาใหม่ (New Course)';

        $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num,
                                            (SELECT count(crr.cs_id)  FROM course_register crr WHERE crr.cs_id = c.cs_id AND crr.cr_id IS NOT NULL) AS num_all
                                            FROM course c 
                                            WHERE c.cs_status = 1 
                                            ORDER BY c.cs_id DESC LIMIT 6
                                        ");
        $select_cos->execute();
    } else {

        $txt_top = 'คอร์สเรียนยอดนิยม (Popular Courses)';

        $select_cos = $conn->prepare(
            "SELECT c.cs_name, c.cs_detail, c.cs_img, c.cs_for, c.cs_pay_status , c.cs_pay_num, cr.rs_id , cr.cs_id, 
                                            (SELECT count(crr.cs_id) FROM course_register crr WHERE crr.cs_id = cr.cs_id AND crr.cr_id IS NOT NULL) AS num_all
                                            FROM course_register cr INNER JOIN course c ON cr.cs_id = c.cs_id
                                            WHERE cr.cr_id IS NOT NULL 
                                            GROUP BY cr.cs_id LIMIT 6"
        );
        $select_cos->execute();
    }
?>

    <!-- Strat Show Course -->
    <section class="bg-light mt-5">

        <div class="d-flex align-items-center p-2 my-3 text-white rounded shadow-sm bg-purple">
            <div class="lh-1">
                <h1 class="h3 mb-0 text-white lh-1"><i class="bi bi-laptop"></i> <?= $txt_top; ?></h1>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php include('course_show.php'); ?>
        </div>

    </section>
    <!-- End Show Course -->

<?php } ?>