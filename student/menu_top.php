<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation" style="background-color: #9f1ae2;" id="mainNav"> -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-gradient-primary-to-secondary" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <h6 class="display-6">
                <img src="../admin/web-name/upload/<?= $row_data['wn_logo']; ?>" alt="" width="40px" height="32px" class="">
                <?= $row_data['wn_name']; ?>
            </h6>
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_GET['cr_lesson']) || isset($_GET['cr_query']) || isset($_GET['cr_report']) || isset($_GET['cr_exe']) || isset($_GET['cr_quiz']) || isset($_GET['cr_quiz_start']) || isset($_GET['cr_quiz_sum_point'])) { ?>
                    <li class="nav-item me-5">
                        <a class="btn btn-danger me-2" href="?cr_course"><i class="bi bi-box-arrow-in-right"></i> ออกจากห้องเรียน </a>
                    </li>
                <?php } else { ?>
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

                    <?php if ($_SESSION['status'] === 1) { ?>
                        <li class="nav-item dropdown me-5">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">คอร์สเรียนของฉัน</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <?php
                                $select_wrm = $conn->prepare("SELECT cr.cr_id, concat('ห้อง ม.',cr.cr_level,'/',cr.cr_room,' - ',cr.cr_year) as room
                        FROM student_list sl INNER JOIn class_room cr On sl.cr_id = cr.cr_id
                        WHERE u_id = :id ");

                                $select_wrm->bindParam(':id', $_SESSION['id']);
                                $select_wrm->execute();

                                while ($row_wrm = $select_wrm->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <li>
                                        <a class="dropdown-item" href="?cr_course=<?= $row_wrm['cr_id']; ?>">
                                            <?= $row_wrm['room']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item me-5">
                            <a class="nav-link" href="?cr_course">คอร์สเรียนของฉัน </a>
                        </li>
                    <?php } ?>

                    <li class="nav-item dropdown me-2">
                        <a class="btn btn-danger me-2 dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i> <?= $_SESSION['fullname']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="?profile">ข้อมูลส่วนตัว</a></li>
                            <li><a class="dropdown-item" href="?certificate">ใบเกียรติบัตร</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-box-arrow-in-right"></i> ออกจากระบบ</a></li>
                        </ul>
                    </li>
                
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>