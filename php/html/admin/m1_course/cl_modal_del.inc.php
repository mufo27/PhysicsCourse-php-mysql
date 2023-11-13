<div class="modal fade" id="del-modal<?= $row_cs_lesson['csl_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="cs_id" value="<?= $cs_id; ?>">
                <div class="modal-header">
                    <h4 class="modal-title">
                        แจ้งเตือน ยกเลิกบทเรียนในคอร์สเรียน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">
                    <h3>รหัส : <?= $row_cs_lesson['ls_id']; ?></h3>
                    <h4>คุณแน่ใจใช่มั้ย ว่าต้องการยกเลิกบทเรียนในคอร์สเรียนนี้</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" name="btn_del" value="<?= $row_cs_lesson['csl_id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันยกเลิกข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>