<div class="modal fade" id="show4-modal<?= $row_sls_lesson['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    แสดงไฟล์แบบฝึกหัด รหัส : <?= $row_sls_lesson['sls_id']; ?> 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body bg-faded">
                <?php if ($row_sls_lesson['sls_answer'] != null) { ?>
                    <iframe src="upload/lesson_sub/<?= $row_sls_lesson['sls_answer'];  ?>" width="100%" height="600px"></iframe>
                <?php } else { ?>
                    <h4>ไม่มีไฟล์</h4>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
<!-- </div> -->