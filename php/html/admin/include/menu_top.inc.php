<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="../assets/dist/img/logo.png" alt="" aria-roledescription="logo">
            <span class="page-logo-text mr-1">Physics Course Information Management System</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>

    <div class="search">
        <h4>Physics Course Information Management System</h4>
    </div>

    <div class="ml-auto d-flex">


        <!-- app user menu -->
        <div>
            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="../my-icon/profile/user.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">ฉัน : AAA<?php //$_SESSION['username']; 
                                                                                                    ?></span>
                <i class="ni ni-chevron-down hidden-xs-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <img src="../my-icon/profile/user.png" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">ผู้ดูแลระบบ</div>
                            <span class="text-truncate text-truncate-md opacity-80">ID : AAA<?php //$_SESSION['username']; 
                                                                                            ?></span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a href="profile.php?profile" class="dropdown-item">
                    <span data-i18n="">ข้อมูลส่วนตัว</span>
                </a>

                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item fw-500 pt-3 pb-3" href="../login/logout.php">
                    <span data-i18n="drpdwn.page-logout">ออกจากระบบ</span>
                </a>
            </div>
        </div>

    </div>
</header>
<!-- END Page Header -->