<div class="modal fade" id="show1-modal<?= $row_sls_lesson['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    แสดงรูปภาพ รหัส : <?= $row_sls_lesson['sls_id']; ?> 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body bg-faded">
                <img src="upload/sub-lessons/<?= $row_sls_lesson['sls_img'];  ?>" alt="Image" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>