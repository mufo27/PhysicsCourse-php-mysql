<?php require_once('active.inc.php'); ?>

<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="../my-img/logo-5.png" alt="" aria-roledescription="logo">
            <span class="page-logo-text mr-1">Administrator</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">

        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <ul id="js-nav-menu" class="nav-menu">

            <li class="nav-title"><h5>รายงานข้อมูล</h5></li>

             <li class="<?= $main; ?>">
                <a href="main.php?main" title="" data-filter-tags="">
                    <i class="fal fa-analytics"></i><span class="nav-link-text" data-i18n="">หน้าแรก</span>
                </a>
            </li>

            <li class="<?= $summarys; ?>">
                <a href="summarys.php?summarys" title="" data-filter-tags="">
                    <i class="fal fa-analytics"></i><span class="nav-link-text" data-i18n="">รายงานผลการเรียน</span>
                </a>
            </li>

            <li class="<?= $ques; ?>">
                <a href="ques.php?ques" title="" data-filter-tags="">
                    <i class="fal fa-analytics"></i><span class="nav-link-text" data-i18n="">รายงานผลแบบสอบถาม</span>
                </a>
            </li>

            <li class="nav-title"><h5>จัดการข้อมูล</h5></li>

            <li class="<?= $course; ?>">
                <a href="course.php?course" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">1. คอร์สเรียน</span>
                </a>
            </li>

            <li class="<?= $lessons; ?>">
                <a href="lessons.php?lessons" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">2. บทเรียน</span>
                </a>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">3. แบบทดสอบ</span>
                </a>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">4. แบบฝึกหัด</span>
                </a>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">5. ห้องเรียน</span>
                </a>
            </li>

            <li class="<?= $account; ?>">
                <a href="#" title="" data-filter-tags="">
                    <i class="fal fa-store-alt"></i>
                    <span class="nav-link-text" data-i18n="">6. บัญชีผู้ใช้งาน</span>
                </a>
                <ul>
                    <li class="<?= $account_student; ?>">
                        <a href="student.php?student" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">นักเรียน</span>
                        </a>
                    </li>
                    <li class="<?= $account_member; ?>">
                        <a href="member.php?member" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">สมาชิก (บุคคลทั่วไป)</span>
                        </a>
                    </li>
                    
                   
                </ul>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">7. ประชาสัมพันธ์</span>
                </a>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">8. แนะนำคอร์สเรียน</span>
                </a>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">9. คำร้องขอลงทะเบียนใหม่</span>
                </a>
            </li>

            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">10. คำร้องขอรหัสผ่านใหม่</span>
                </a>
            </li>


            <li class="<?= $c_order; ?>">
                <a href="c_order.php?c_order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">10. การตั้งค่าเว็บไซต์</span>
                </a>
            </li>

            <!-- <li class="<?= $account; ?>">
                <a href="#" title="" data-filter-tags="">
                    <i class="fal fa-store-alt"></i>
                    <span class="nav-link-text" data-i18n="">11. การตั้งค่า</span>
                </a>
                <ul>
                    <li class="<?= $account_student; ?>">
                        <a href="student.php?student" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">ชื่อเว็บ & โลโก้เว็บ</span>
                        </a>
                    </li>
                    <li class="<?= $account_member; ?>">
                        <a href="member.php?member" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">เมนูอื่นๆ</span>
                        </a>
                    </li>
                    <li class="<?= $account_student; ?>">
                        <a href="student.php?student" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">ภาพสไลด์</span>
                        </a>
                    </li>
                    <li class="<?= $account_member; ?>">
                        <a href="member.php?member" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">วัตถุประสงค์</span>
                        </a>
                    </li>
                    <li class="<?= $account_student; ?>">
                        <a href="student.php?student" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">ช่องทางการติดต่อ</span>
                        </a>
                    </li>
                </ul>
            </li> -->
           
            

            <li class="nav-title"></li>

            <li>
                <a href="../login/logout.php" title="" data-filter-tags="">
                    <i class="fal fa-power-off"></i><span class="nav-link-text" data-i18n="">ออกจากระบบ</span>
                </a>
            </li>

            <!-- <li class="nav-title">Tools & Components</li> -->

        </ul>

        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->

</aside>