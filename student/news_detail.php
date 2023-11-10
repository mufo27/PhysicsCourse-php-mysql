<?php

if (isset($_GET['news_detail'])) {

    $n_id = $_GET['news_detail'];

    $select = $conn->prepare("SELECT  * FROM news WHERE n_id=:n_id");
    $select->bindParam(':n_id',  $n_id);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);
}


?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?news">ประชาสัมพันธ์</a></li>
        <li class="breadcrumb-item active" aria-current="page">รายละเอียด</li>
    </ol>
</nav>

<div class="d-flex align-items-center p-2 my-3 text-white rounded shadow-sm  bg-purple">
    <div class="lh-1">
        <h1 class="h1 mb-0 text-white lh-1">รายละเอียด (Detail)</h1>
    </div>
</div>

<div class="row">

    <div class="col-12 col-sm-7 mb-3">

        <div class="row">
            <div class="col">
                <div class="card h-100">
                    <img src="../admin/news/upload/<?= $row['n_img']; ?>" class="card-img-top" alt="" height="350px">
                    <div class="card-body">
                        <h1 class="card-title"><?= $row['n_top']; ?></h1>
                        <p class="card-text"><?= $row['n_detail']; ?></p>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="col-12 col-sm-5 mb-3">
        <div class="card h-100">
            <h4 class="card-header text-white bg-purple"><i class="bi bi-newspaper"></i> ประชาสัมพันธ์ อื่นๆ (News Other)</h4>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <?php
                        $select2 = $conn->prepare("SELECT  * FROM news WHERE n_status = 1 LIMIT 4");
                        $select2->execute();

                        $i = 1;
                        while ($row2 = $select2->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td style="width:10%; text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                <td style="width:70%; vertical-align: middle;"><i class="bi bi-volume-up-fill text-warning"></i> <?= $row2['n_top']; ?></td>
                                <td style="width:20%; text-align: center; vertical-align: middle;"><a href="?news_detail=<?= $row2['n_id']; ?>"><small>อ่านเพิ่มเติม</small></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>