<div class="modal fade" id="edit-modal<?= $row['cs_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <input type="hidden" name="cs_id" value="<?= $row['cs_id']; ?>">
                <input type="hidden" name="check_cs_code" value="<?= $row['cs_code']; ?>">
                <input type="hidden" name="check_cs_name" value="<?= $row['cs_name']; ?>">
                
                <div class="modal-header">
                    <h4 class="modal-title">
                        แบบฟอร์ม แก้ไขคอร์สเรียน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_code2">รหัส : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="cs_code2" name="cs_code" class="form-control" value="<?= $row['cs_code']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_name2">คอร์สเรียน : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="cs_name2" name="cs_name" class="form-control" value="<?= $row['cs_name']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="editor2">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor2" name="cs_detail" rows="3"><?= $row['cs_detail']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="k_hour2">ระยะเวลาเรียน ชั่วโมง : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="k_hour2" name="k_hour" class="form-control" value="<?= $row['k_hour']; ?>" min="0" max="999" required>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="k_minute2">นาที : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="k_minute2" name="k_minute" class="form-control" value="<?= $row['k_minute']; ?>" min="0" max="59" required>
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_pay_status2">ค่าธรรมเนียม : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="cs_pay_status2" name="cs_pay_status" required>
                                <option value="<?= $row['cs_pay_status']; ?>">-- <?= getPayStatusText($row['cs_pay_status']); ?> --</option>
                                <option value="0">ฟรี</option>
                                <option value="1">ไม่ฟรี</option>
                            </select>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_pay_num2">จำนวนเงิน : <span class="text-danger">(กรณีไม่ฟรี)</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="cs_pay_num2" name="cs_pay_num" class="form-control" min="0" max="999999" value="<?= $row['cs_pay_num']; ?>">
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_for2">เหมาะสำหรับ : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="cs_for2" name="cs_for" required>
                                <option value="<?= $row['cs_for']; ?> ">-- <?= getGradeText($row['cs_for']); ?> --</option>
                                <option value="1">ม.1</option>
                                <option value="2">ม.2</option>
                                <option value="3">ม.3</option>
                                <option value="4">ม.4</option>
                                <option value="5">ม.5</option>
                                <option value="6">ม.6</option>
                                <option value="7">ป.ตรี</option>
                                <option value="0">ทั้งหมด</option>
                            </select>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_status2">สถานะ เปิด/ปิด : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="cs_status2" name="cs_status" required>
                                <option value="<?= $row['cs_status']; ?>">-- <?= getStatusText($row['cs_status']); ?> --</option>
                                <option value="0">ค่าเริ่มต้น ปิด</option>
                                <option value="1">เปิด</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right">รูปภาพ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <img src="upload/courses/<?= $row['cs_img']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px">
                            <input type="hidden" name="cs_img_befor" value="<?= $row['cs_img']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_img2">อัพโหลดใหม่:</label>
                        <div class="col-lg-9">
                            <input type="file" id="cs_img2" name="cs_img" class="form-control" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right">ใบเกียรติบัตร : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <img src="upload/courses/<?= $row['cs_cer']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px">
                            <input type="hidden" name="cs_cer_befor" value="<?= $row['cs_cer']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="cs_cer2">อัพโหลดใหม่:</label>
                        <div class="col-lg-9">
                            <input type="file" id="cs_cer2" name="cs_cer" class="form-control" value="">
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