<div class="modal fade" id="show2-modal<?= $row['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                 แสดงคลิปวิดิโอ รหัส : <?= $row['sls_id']; ?> 
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body bg-faded">
                <iframe width="100%" height="600" src="https://www.youtube.com/embed/<?= $row['sls_youtube'];  ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>