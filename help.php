<?php

require_once 'config/con_db.php';

$select = $conn->prepare("SELECT * FROM web_page WHERE id = 3");
$select->execute();
$row = $select->fetch(PDO::FETCH_ASSOC);

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ช่วยเหลือ</li>
    </ol>
</nav>

<div class="d-flex align-items-center p-2 my-3 text-white rounded shadow-sm bg-purple">
    <div class="lh-1 mt-1">
        <h1 class="h1 mb-0 text-white lh-1">ช่วยเหลือ (Help)</h1>
    </div>
</div>

<div class="row align-items-md-stretch">
    <div class="col-md-12">
        <div class="h-100 p-5 bg-light border rounded-3">

        <img src="admin/page-other/upload/<?= $row['img']; ?>" class="img-fluid" alt="">

        </div>
    </div>
   
</div>