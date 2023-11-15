<div class="modal fade" id="edit-modal<?= $row['ls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" id="" name="check_ls_name" value="<?= $row['ls_name']; ?>">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แบบฟอร์ม แก้ไขแบบทดสอบ
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="z_id2">รหัส : </label>
                        <div class="col-lg-9">
                            <input type="text" id="z_id2" name="z_id" class="form-control" value="<?= $row['ls_id']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="z_name2">แบบทดสอบ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="z_name2" name="z_name" class="form-control" value="<?= $row['ls_id']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-4 col-form-label text-left text-sm-right" for="k_hour2">เวลาทำแบบทดสอบ (ชั่วโมง) : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="k_hour2" name="k_hour" class="form-control" min="0" max="999" value="<?= $row['ls_id']; ?>" required>
                        </div>
                  
                        <label class="form-label col-sm-2 col-form-label text-left text-sm-right" for="k_minute2">(นาที) : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="k_minute2" name="k_minute" class="form-control" min="0" max="999" value="<?= $row['ls_id']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="z_criteria2">เกณฑ์ผ่าน (%) : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="number" id="z_criteria2" name="z_criteria" class="form-control" min="0" max="999" value="<?= $row['ls_id']; ?>"required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="editor2">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea id="editor2" class="form-control" name="z_detail" rows="3"><?= $row['ls_id']; ?></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" name="btn_update" class="btn btn-warning">อัพเดทข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>