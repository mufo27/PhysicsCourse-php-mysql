<?php

while ($row_cos = $select_cos->fetch(PDO::FETCH_ASSOC)) {
    $select_like = $conn->prepare("SELECT count(*) AS like_num FROM press_heart WHERE cs_id=:cs_id");
    $select_like->bindParam(':cs_id', $row_cos['cs_id']);
    $select_like->execute();
    $row_like = $select_like->fetch(PDO::FETCH_ASSOC);

    $select_like2 = $conn->prepare("SELECT ph_id FROM press_heart WHERE cs_id=:cs_id AND u_id=:u_id");
    $select_like2->bindParam(':cs_id', $row_cos['cs_id']);
    $select_like2->bindParam(':u_id', $_SESSION['id']);
    $select_like2->execute();
    $row_like2 = $select_like2->fetch(PDO::FETCH_ASSOC);

    if ($row_cos['cs_pay_status'] === 0) {
        $pay_cos = '<span>ค่าธรรมเนียม : ฟรี</span>';
    } else {
        $pay_cos = '<span>ค่าธรรมเนียม : ' . $row_cos['cs_pay_num'] . ' บาท</span>';
    }

    if ($row_cos['cs_img'] != '') {
        $show_img_cos = '../admin/course/upload/' . $row_cos['cs_img'];
    } else {
        $show_img_cos = '../img-test/cos-1.png';
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
                <form action="" method="post">
                    <?php if (isset($row_like2['ph_id'])) { ?>
                        <button type="submit" name="btn_like2" class="btn btn-danger" value="<?= $row_like2['ph_id']; ?>">
                            <i class="bi bi-heart"></i> <?= $lk_num; ?> คน
                        </button>
                    <?php } else { ?>
                        <button type="submit" name="btn_like" class="btn btn-outline-danger" value="<?= $row_cos['cs_id']; ?>">
                            <i class="bi bi-heart"></i> <?= $lk_num; ?> คน
                        </button>
                    <?php }  ?>
                </form>
            </div>
            <div class="card-footer">
                <a href="?cr_course_detail=<?= $row_cos['cs_id']; ?>&cr_id=<?= $cr_id; ?>" class="w-100 btn btn-warning">เลือก</a>
            </div>
        </div>
    </div>

<?php } ?>


<?php

if (isset($_POST['btn_like'])) {

    $cs_id = $_POST['btn_like'];
    $u_id = $_SESSION['id'];

    $insert_ph = $conn->prepare("INSERT INTO press_heart (cs_id, u_id) VALUES (:cs_id, :u_id)");
    $insert_ph->bindParam(':cs_id',  $cs_id);
    $insert_ph->bindParam(':u_id',  $u_id);
    $insert_ph->execute();

    if ($insert_ph) {

        if (isset($_GET['cr_course'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?cr_course=$cr_id\">";
            exit;
        } else if (isset($_GET['course'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?course\">";
            exit;
        } else {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?main\">";
            exit;
        }
        
    } else {

        echo "<script>alert('error..!!')</script>";
        echo "<script>window.location='javascript:history.back(-1)';</script>";
        exit;
    }
}

if (isset($_POST['btn_like2'])) {

    $ph_id = $_POST['btn_like2'];

    $delete_ph = $conn->prepare("DELETE FROM press_heart WHERE ph_id = :ph_id");
    $delete_ph->bindParam(':ph_id', $ph_id);
    $delete_ph->execute();

    if ($delete_ph) {

        if (isset($_GET['cr_course'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?cr_course=$cr_id\">";
            exit;
        } else if (isset($_GET['course'])) {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?course\">";
            exit;
        } else {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?main\">";
            exit;
        }
    } else {

        echo "<script>alert('error..!!')</script>";
        echo "<script>window.location='javascript:history.back(-1)';</script>";
        exit;
    }
}

?>