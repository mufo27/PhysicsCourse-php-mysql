<div class="modal fade" id="del-modal<?= $row['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แจ้งเตือน ลบหัวข้อย่อยในบทเรียน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">
                    <h4>รหัส : <?= $row['sls_id']; ?></h4>
                    <h4>คุณแน่ใจใช่มั้ย ว่าต้องการลบหัวข้อย่อยในบทเรียนนี้</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" name="btn_del" value="<?= $row['sls_id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันลบข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>