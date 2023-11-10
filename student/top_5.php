<?php

//ถ้าค้นหาข้อมูล
if (isset($_POST['btn_search'])) {

    //ข้อความที่ต้องการค้นหา
    $txt_search = $_POST['txt_search'];

    $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_img FROM course c
                                    WHERE c.cs_status = 1 AND cs_name LIKE '%" . $txt_search . "%'
                                ");
    $select_cos->execute();
} else {

    $select_cos = $conn->prepare("SELECT c.cs_id ,c.cs_name, c.cs_img FROM course c 
                                    WHERE c.cs_status = 1 
                                    ORDER BY c.cs_id ASC
                                ");
    $select_cos->execute();
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">5 อันดับคะแนน</li>
    </ol>
</nav>

<div class="align-items-center p-2 my-3 text-white rounded shadow-sm bg-purple">
    <div class="row mt-1">
        <div class="col-md-6 mb-2">
            <div class="lh-1">
                <h1 class="h1 mb-0 text-white lh-1">5 อันดับคะแนน (Top 5)</h1>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <form class="d-flex" action="" method="post">
                <?php if (!isset($txt_search)) { ?>
                    <input class="form-control me-2" type="search" name="txt_search" placeholder="กรอกตัวอักษร" aria-label="Search">
                <?php } else { ?>
                    <input class="form-control me-2" type="search" name="txt_search" value="<?= $txt_search; ?>" placeholder="กรอกตัวอักษร" aria-label="Search">
                <?php } ?>
                <button class="btn btn-warning" type="submit" name="btn_search">ค้นหา</button>
            </form>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php

    $cos_point = 0;

    while ($row_cos = $select_cos->fetch(PDO::FETCH_ASSOC)) {

        if ($row_cos['cs_img'] != '') {
            $show_img_cos = '../admin/course/upload/' . $row_cos['cs_img'];
        } else {
            $show_img_cos = '../img-test/cos-1.png';
        }

        $select_max = $conn->prepare(
            "SELECT SUM(sls_count) as sum_point 
            FROM (
                SELECT COUNT(sls_id) as sls_count 
                FROM sub_lesson 
                WHERE ls_id IN (
                    SELECT ls_id 
                    FROM course_lesson 
                    WHERE cs_id = :cs_id
                )
            ) as subquery
            "
        );
        $select_max->bindParam(':cs_id', $row_cos['cs_id']);
        $select_max->execute();
        $row_max = $select_max->fetch(PDO::FETCH_ASSOC);
        $max_point = $row_max['sum_point'] * 100;

    ?>
        <div class="col">
            <div class="card h-100">
                <img src="<?= $show_img_cos; ?>" class="card-img-top" alt="" height="200px">
                <div class="card-body">

                    <div class="row mt-3">
                        <div class="col-6">
                            <h5 class="card-title"><?= $row_cos['cs_name']; ?></h5>
                        </div>
                        <div class="col-6 text-end">
                            <h5 class="card-title">คะแนนเต็ม : <?= $max_point; ?></h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead class="">
                            <tr>
                                <th style="width:10%; text-align: center; vertical-align: middle;">#</th>
                                <th style="width:40%; text-align: center; vertical-align: middle;">ชื่อ-นามสกุล</th>
                                <th style="width:20%; text-align: center; vertical-align: middle;">คะแนนรวม</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $select_name = $conn->prepare(
                                "SELECT cs_id, (SELECT concat(u.pkname,'',u.fname,' ',u.lname) FROM users u WHERE u.id = u_id) as users_fullname, SUM(qz.p_point + qz.k_point) as total_point
                                    FROM qz_point qz
                                    JOIN sub_lesson sls ON sls.sls_id = qz.sls_id
                                    JOIN course_lesson cl ON cl.ls_id = sls.ls_id
                                    JOIN users u ON u.id = qz.u_id
                                    WHERE qz.qz_use = 1 AND cl.cs_id = :cs_id
                                    GROUP BY users_fullname
                                    ORDER BY total_point DESC
                                    LIMIT 5
                                    "
                            );

                            $select_name->bindParam(':cs_id', $row_cos['cs_id']);
                            $select_name->execute();

                            $i = 1;
                            while ($row_name = $select_name->fetch(PDO::FETCH_ASSOC)) {

                                echo "<tr style='text-align: center; vertical-align: middle;'>";
                                echo "<td>" . $i++ . "</td>";
                                echo "<td>" . $row_name['users_fullname'] . "</td>";
                                echo "<td>" . $row_name['total_point'] . "</td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    <?php } ?>
</div>