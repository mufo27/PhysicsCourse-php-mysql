<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ประชาสัมพันธ์</li>
    </ol>
</nav>

<div class="align-items-center p-2 my-3 text-white rounded shadow-sm bg-purple">
    <div class="row">
        <div class="col-md-6 mb-2">
            <div class="lh-1">
                <h1 class="h1 mb-0 text-white lh-1">ประชาสัมพันธ์ (News)</h1>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <form class="d-flex" action="" method="post">
                <input class="form-control me-2" type="search" placeholder="กรอกตัวอักษร..." aria-label="Search">
                <button class="btn btn-warning" type="submit">ค้นหา</button>
            </form>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
    $select_n = $conn->prepare("SELECT * FROM news where n_status = 1 ");
    $select_n->execute();
    while ($row_n = $select_n->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="col">
            <div class="card h-100">
                <img src="img-test/cos-1.png" class="card-img-top" alt="" height="200px">
                <div class="card-body">
                    <h5 class="card-title"><?= $row_n['n_top']; ?></h5>
                </div>
                <div class="card-footer">
                    <a href="?news_detail=<?= $row_n['n_id']; ?>" class="w-100 btn btn-info">อ่านเพิ่มเติม</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>