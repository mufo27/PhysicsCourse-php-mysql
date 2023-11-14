<div class="modal fade" id="del-modal<?= $row['cs_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แจ้งเตือน รหัส : <?= $row['cs_code']; ?> | คอร์สเรียน : <?= $row['cs_name']; ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">
                    <h4>คุณแน่ใจแล้วใช่หรือไม่ ว่าต้องการลบคอร์สเรียนนี้..!! <span class="text-danger">*ข้อมูลทั้งหมดที่มีความเกี่ยวข้อง กับคอร์สเรียนนี้จะถูกลบทิ้ง*</span></h4>
                    <hr>
                    <h4>บทเรียน : <?= $row['check_count_in_cl']; ?> รายการ</h4>
                    <h4>ลงทะเบียน : <?= $row['check_count_in_cr']; ?> รายการ</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" name="btn_del" value="<?= $row['cs_id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันลบข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>