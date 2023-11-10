<div class="p-3 bg-gradient-primary-to-secondary rounded shadow-sm text-white">
    <?php if (isset($_GET['cr_lesson']) || isset($_GET['cr_query']) || isset($_GET['cr_report']) || isset($_GET['cr_exe']) || isset($_GET['cr_quiz']) || isset($_GET['cr_quiz_start']) || isset($_GET['cr_quiz_sum_point'])) { ?>
        <div class="row">
            <div class="col-md-12">
                <h4>หมายเหตุ นักเรียนต้องเรียนให้ครบทุก หัวข้อย่อย ทำแบบฝึกหัด แบบทดสอบ และแบบสอบถาม ถึงจะได้รับใบเกียรติบัตร</h4>
            </div>
        </div>
    <?php } else { ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5 text-white">
            <div class="col d-flex align-items-start">
                <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                    <use xlink:href="#bootstrap" />
                </svg>
                <div>
                    <h4 class="fw-bold mb-0">วัตถุประสงค์</h4>
                    <?php
                    $select_obj = $conn->prepare("SELECT * FROM web_obj");
                    $select_obj->execute();

                    $obj = 1;
                    while ($row_obj = $select_obj->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <p><?= $obj++; ?>. <?= $row_obj['obj_name']; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                    <use xlink:href="#cpu-fill" />
                </svg>
                <div>
                    <h4 class="fw-bold mb-0">หมวดหมู่คอร์สเรียน</h4>
                    <p>• คอร์สเรียน สำหรับ ม.1</p>
                    <p>• คอร์สเรียน สำหรับ ม.2</p>
                    <p>• คอร์สเรียน สำหรับ ม.3</p>
                    <p>• คอร์สเรียน สำหรับ ม.4</p>
                    <p>• คอร์สเรียน สำหรับ ม.5</p>
                    <p>• คอร์สเรียน สำหรับ ม.6</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                    <use xlink:href="#calendar3" />
                </svg>
                <div>
                    <h4 class="fw-bold mb-0">ข้อมูลเพิ่มเติม</h4>
                    <p>• คอร์สเรียน</p>
                    <p>• 5 อันดับคะแนนสูงสุด</p>
                    <p>• ประชาสัมพันธ์</p>
                    <p>• วิธีสมัครเสมาชิก</p>
                    <p>• วิธีลงทะเบียนคอร์สเรียน</p>
                    <p>• เกี่ยวกับเรา</p>
                    <p>• คำถามที่พบ่อย</p>
                    <p>• ช่วยเหลือ</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                    <use xlink:href="#home" />
                </svg>
                <div>
                    <h4 class="fw-bold mb-0">ช่องทางติดต่อ</h4>
                    <?php
                    $select_ct = $conn->prepare("SELECT * FROM web_contact");
                    $select_ct->execute();

                    $ct = 1;
                    while ($row_ct = $select_ct->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <p><?= $ct++; ?>. <?= $row_ct['ct_name']; ?></p>
                    <?php } ?>
                </div>
            </div>

        </div>
    <?php } ?>

</div>

<footer class="bg-black text-center py-5">
    <div class="container px-5">
        <div class="text-white-50 small">
            <div class="mb-2">&copy; เว็บไซต์ของคุณ 2022 สงวนลิขสิทธิ์</div>
        </div>
    </div>
</footer>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/dist/js/offcanvas.js"></script>

<!-- <script src="jquery-3.6.1.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> -->
<!-- <script src="OwlCarousel2/dist/owl.carousel.min.js"></script> -->

<!-- <script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
</script> -->

<script>
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
        alert("เว็บไซต์นี้ไม่อนุญาตให้คลิกขวา");
    });
    document.addEventListener("keydown", function(e) {
        if (e.keyCode == 123) {
            e.preventDefault();
            alert("เว็บไซต์นี้ไม่อนุญาตให้ กด F12");

        }
    });
</script>