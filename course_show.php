<?php

while ($row_cos = $select_cos->fetch(PDO::FETCH_ASSOC)) {
    $select_like = $conn->prepare("SELECT count(*) AS like_num FROM press_heart WHERE cs_id=:cs_id");
    $select_like->bindParam(':cs_id', $row_cos['cs_id']);
    $select_like->execute();
    $row_like = $select_like->fetch(PDO::FETCH_ASSOC);

    if ($row_cos['cs_pay_status'] === 0) {
        $pay_cos = '<span>ค่าธรรมเนียม : ฟรี</span>';
    } else {
        $pay_cos = '<span>ค่าธรรมเนียม : ' . $row_cos['cs_pay_num'] . ' บาท</span>';
    }

    if ($row_cos['cs_img'] != '') {
        $show_img_cos = 'admin/course/upload/' . $row_cos['cs_img'];
    } else {
        $show_img_cos = 'img-test/cos-1.png';
    }

    if ($row_cos['num_all'] > 0) {
        $numbers = $row_cos['num_all'];
    } else {
        $numbers = '-';
    }

    if ($row_like['like_num'] > 0) {
        $lk_num = $row_like['like_num'];
    } else {
        $lk_num = '0';
    }
?>

    <div class="col">
        <div class="card h-100">
            <img src="<?= $show_img_cos; ?>" class="card-img-top" alt="" height="200px">
            <div class="card-body">
                <h4 class="card-title"><?= $row_cos['cs_name']; ?></h4>
                <h5 class="card-text"><?= $row_cos['cs_detail']; ?></h5>
                <h6 class="text-muted"><i class="bi bi-currency-bitcoin"></i> <?= $pay_cos; ?></h6>
                <h6 class="text-muted"><i class="bi bi-person-check"></i> ลงทะเบียน : <?= $numbers; ?> คน</h6>
                <h6 class="text-muted"><i class="bi bi-check-square"></i> เหมาะสำหรับ : <?= setFor($row_cos['cs_for']); ?></h6>
                <h6 class="text-muted"><i class="bi bi-heart-fill text-danger"></i> <?= $lk_num; ?> คน</h6>
            </div>
            <div class="card-footer">
                <a href="?course_detail=<?= $row_cos['cs_id']; ?>" class="w-100 btn btn-warning">เลือก</a>
            </div>
        </div>
    </div>

<?php } ?>