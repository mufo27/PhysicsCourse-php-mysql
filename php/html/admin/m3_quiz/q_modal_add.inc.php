<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แบบฟอร์ม เพิ่มแบบทดสอบ
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="z_name">แบบทดสอบ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="z_name" name="z_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-4 col-form-label text-left text-sm-right" for="k_hour">เวลาทำแบบทดสอบ (ชั่วโมง) : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="k_hour" name="k_hour" class="form-control" min="0" max="999" required>
                        </div>
                  
                        <label class="form-label col-sm-2 col-form-label text-left text-sm-right" for="k_minute">(นาที) : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="k_minute" name="k_minute" class="form-control" min="0" max="999" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="z_criteria">เกณฑ์ผ่าน (%) : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="number" id="z_criteria" name="z_criteria" class="form-control" min="0" max="999" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea id="editor1" class="form-control" name="z_detail" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" name="btn_save" class="btn btn-success">บันทึกข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>