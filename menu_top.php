<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation" style="background-color: #9f1ae2;" id="mainNav"> -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-gradient-primary-to-secondary" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <h6 class="display-6">
                <img src="admin/web-name/upload/<?= $row_data['wn_logo']; ?>" alt="" width="40px" height="32px" class="">
                <?= $row_data['wn_name']; ?>
            </h6>
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?news">ประชาสัมพันธ์</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?course">คอร์สเรียน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?top_5">5 อันดับคะแนน</a>
                </li>
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">อื่นๆ</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="?about">เกี่ยวกับเรา</a></li>
                        <li><a class="dropdown-item" href="?faq">คำถามที่พบบ่อย</a></li>
                        <li><a class="dropdown-item" href="?help">ช่วยเหลือ</a></li>
                    </ul>
                </li>

                <!-- <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">บัญชีผู้ใช้งาน</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li><a class="dropdown-item" href="?profile">ข้อมูลส่วนตัว</a></li>
                        <li><a class="dropdown-item" href="?course">คอร์สเรียนของฉัน</a></li>
                        <li><a class="dropdown-item" href="?certificate">ใบเกียรติบัตร</a></li>
                    </ul>
                </li> -->


                <li class="nav-item">
                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i class="bi bi-r-circle"></i> สมัครสมาชิก
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-box-arrow-in-right"></i> เข้าสู่ระบบ
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Login-->
<?php include('modal_login.php'); ?>

<!-- Modal Register-->
<?php include('modal_register.php'); ?>