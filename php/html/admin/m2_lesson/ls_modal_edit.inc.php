<div class="modal fade" id="edit-modal<?= $row['sls_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" id="" name="ls_id" value="<?= $row['ls_id']; ?>">
                <input type="hidden" id="" name="check_sls_name" value="<?= $row['sls_name']; ?>">
                <input type="hidden" id="" name="sls_img2" value="<?= $row['sls_img']; ?>">
                <input type="hidden" id="" name="sls_sheet2" value="<?= $row['sls_sheet']; ?>">
                <input type="hidden" id="" name="sls_answer2" value="<?= $row['sls_answer']; ?>">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แบบฟอร์ม แก้ไขหัวข้อย่อยในบทเรียน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">รหัส : </label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="sls_id" value="<?= $row['sls_id']; ?>" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หัวข้อย่อย : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="sls_name" value="<?= $row['sls_name']; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor3" name="sls_detail" rows="3"><?= $row['sls_detail']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คลิปวิดีโอ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="sls_youtube" value="<?= $row['sls_youtube']; ?>" class="form-control" placeholder="ใส่เฉพาะ Key หลัง เครื่องหมาย = เช่น https://www.youtube.com/watch?v=(คีย์ที่ต้องการนำมาใส่)" required>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">แบบฝึกหัด : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select class="custom-select form-control" id="" name="ex_id" required>

                                <option value="<?= $row['ex_id']; ?>">-- <?= $row['exe_name']; ?> --</option>

                                <?php
                                $sql_ex = $conn->prepare("SELECT ex_id, ex_name FROM exercises ORDER BY ex_name ASC");
                                $sql_ex->execute();
                                while ($row_ex = $sql_ex->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $row_ex['ex_id']; ?>"> <?= $row_ex['ex_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">แบบทดสอบ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select class="custom-select form-control" id="" name="z_id" required>

                                <option value="<?= $row['z_id']; ?>">-- <?= $row['qz_name']; ?> --</option>

                                <?php
                                $sql_qz = $conn->prepare("SELECT z_id, z_name FROM quiz ORDER BY z_name ASC");
                                $sql_qz->execute();
                                while ($row_qz = $sql_qz->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $row_qz['z_id']; ?>"> <?= $row_qz['z_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รูปภาพ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <img src="upload/lesson_sub/<?= $row['sls_img']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดรูปภาพ (ใหม่) : </label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="sls_img" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดไฟล์แบบฝึกหัด (ใหม่) : </label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="sls_sheet" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดไฟล์เฉลยแบบฝึกหัด (ใหม่) : </label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="sls_answer" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อ้างอิง : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor4" name="sls_refer" rows="3"><?= $row['sls_refer']; ?></textarea>
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