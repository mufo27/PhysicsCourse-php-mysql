<div class="modal fade" id="edit-modal<?= $row['ls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="check_ls_name" value="<?= $row['ls_name']; ?>">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แบบฟอร์ม แก้ไขบทเรียน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="ls_id2">รหัส : </label>
                        <div class="col-lg-9">
                            <input type="text" id="ls_id2" name="ls_id" class="form-control" value="<?= $row['ls_id']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="ls_name2">บทเรียน : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="ls_name2" name="ls_name" class="form-control" value="<?= $row['ls_name']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="editor2">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea id="editor2" class="form-control" name="ls_detail" rows="3"><?= $row['ls_detail']; ?></textarea>
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