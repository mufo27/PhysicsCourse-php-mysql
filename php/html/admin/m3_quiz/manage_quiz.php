<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item">หน้าแรก </li>
    <li class="breadcrumb-item">แบบทดสอบ </li>
    <li class="breadcrumb-item active">จัดการแบบทดสอบ</li>
</ol>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-12" class="panel">

            <div class="panel-hdr">
                <h2>
                    รูปแบบคำถาม
                </h2>
                <div class="panel-toolbar"></div>
            </div>

            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">

                        <div class="col-sm-2">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-objective-tab" data-toggle="pill" href="#v-pills-objective" role="tab" aria-controls="v-pills-objective" aria-selected="true">
                                    <i class="fal fa-angle-right"></i>
                                    <span class="hidden-sm-down ml-1"> ปรนัย</span>
                                </a>
                                <a class="nav-link" id="v-pills-subjective-tab" data-toggle="pill" href="#v-pills-subjective" role="tab" aria-controls="v-pills-subjective" aria-selected="false">
                                    <i class="fal fa-angle-right"></i>
                                    <span class="hidden-sm-down ml-1"> อัตนัย</span>
                                </a>
                                <a class="nav-link" id="v-pills-choice-tab" data-toggle="pill" href="#v-pills-choice" role="tab" aria-controls="v-pills-choice" aria-selected="false">
                                    <i class="fal fa-angle-right"></i>
                                    <span class="hidden-sm-down ml-1"> 2 ตัวเลือก</span>
                                </a>
                                <a class="nav-link" id="v-pills-example-tab" data-toggle="pill" href="#v-pills-example" role="tab" aria-controls="v-pills-example" aria-selected="false">
                                    <i class="fal fa-exclamation-circle"></i>
                                    <span class="hidden-sm-down ml-1"> ตัวอย่าง</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-10">
                            <div class="tab-content" id="v-pills-tabContent">

                                <?php
                                    include 'mq_tab_objective.inc.php';

                                    include 'mq_tab_subjective.inc.php';

                                    include 'mq_tab_choice.inc.php';

                                    include 'mq_tab_example.inc.php';
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>