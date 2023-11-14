<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" id="" name="ls_id" value="<?= $ls_id?>">

                <div class="modal-header">
                    <h4 class="modal-title">
                        แบบฟอร์ม เพิ่มหัวข้อย่อยในบทเรียน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หัวข้อย่อย : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="sls_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor1" name="sls_detail" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คลิปวิดีโอ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="sls_youtube" class="form-control" placeholder="ใส่เฉพาะ Key หลัง เครื่องหมาย = เช่น https://www.youtube.com/watch?v=(คีย์ที่ต้องการนำมาใส่)" required>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">แบบฝึกหัด : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select class="custom-select form-control" id="" name="ex_id" required>
                                <option value="">-- เลือก --</option>
                                <?php
                                $sql_ex = $conn->prepare("SELECT ex_id, ex_name FROM exercises ORDER BY ex_name ASC");
                                $sql_ex->execute();
                                while ($row_ex = $sql_ex->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $row_ex['ex_id']; ?>"><?= $row_ex['ex_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">แบบทดสอบ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select class="custom-select form-control" id="" name="z_id" required>
                                <option value="">-- เลือก --</option>
                                <?php
                                $sql_qz = $conn->prepare("SELECT z_id, z_name FROM quiz ORDER BY z_name ASC");
                                $sql_qz->execute();
                                while ($row_qz = $sql_qz->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $row_qz['z_id']; ?>"><?= $row_qz['z_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดรูปภาพ :</label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="sls_img" class="form-control" accept="image/jpeg, image/png, image/gif">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดไฟล์แบบฝึกหัด :</label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="sls_sheet" class="form-control" accept=".pdf, .docx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดไฟล์เฉลยแบบฝึกหัด :</label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="sls_answer" class="form-control" accept=".pdf, .docx">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อ้างอิง : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor2" name="sls_refer" rows="3"></textarea>
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