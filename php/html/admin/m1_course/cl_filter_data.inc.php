<div class="accordion accordion-hover" id="js_demo_accordion-5">
    <div class="card">
        <div class="card-header">
            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#js_demo_accordion-5a" aria-expanded="false">
                <i class="fal fa-filter width-2 fs-xl"></i>
                กรองข้อมูล
                <span class="ml-auto">
                    <span class="collapsed-reveal">
                        <i class="fal fa-chevron-up fs-xl"></i>
                    </span>
                    <span class="collapsed-hidden">
                        <i class="fal fa-chevron-down fs-xl"></i>
                    </span>
                </span>
            </a>
        </div>
        <div id="js_demo_accordion-5a" class="collapse" data-parent="#js_demo_accordion-5">
            <div class="card-body">

                <form action="" method="GET" enctype="multipart/form-data">

                    <input type="hidden" id="" name='course_lesson' value="<?= $cs_id; ?>">
                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">แสดงข้อมูล</span>
                                </div>
                                <select class="custom-select" id="" name="fd_per_page">

                                    <option value="<?= $v_per_page; ?>"><?= $s_per_page; ?></option>

                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="all">ทั้งหมด</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">รหัส</span>
                                </div>
                                <input type="text" class="form-control" id="" name="fd_ls_id" value="<?= $v_ls_id; ?>">
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">บทเรียน</span>
                                </div>
                                <input type="text" class="form-control" id="" name="fd_ls_name" value="<?= $v_ls_name; ?>">
                            </div>
                        </div>

                        <div class="col-md-1 mb-3">
                            <button class="btn btn-outline-info btn-block waves-effect waves-themed" type="submit" name="btn_filter">ยืนยันข้อมูล</button>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button class="btn btn-outline-warning btn-block waves-effect waves-themed" type="reset" name="btn_filter">ล้างข้อมูล</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>