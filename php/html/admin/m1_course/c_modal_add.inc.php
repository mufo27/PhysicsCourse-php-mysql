<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title">
                        เพิ่มข้อมูล
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body bg-faded">

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">รหัสคอร์สเรียน : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="cs_code" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คอร์สเรียน : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" id="" name="cs_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด : </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" id="editor1" name="cs_detail" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ระยะเวลาเรียน ชั่วโมง : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="" name="k_hour" class="form-control" min="0" max="999" required>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">นาที : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <input type="number" id="" name="k_minute" class="form-control" min="0" max="59" required>
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ค่าธรรมเนียม : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="cs_pay_status1" name="cs_pay_status" required>
                                <option value="">-- เลือก --</option>
                                <option value="0">ฟรี</option>
                                <option value="1">ไม่ฟรี</option>
                            </select>
                        </div>

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนเงิน : <span class="text-danger">(กรณีไม่ฟรี)</span></label>
                        <div class="col-lg-3">
                            <!-- <input type="number" id="cs_pay_num1" name="cs_pay_num" class="form-control" min="0" max="999999" disabled> -->
                            <input type="number" id="cs_pay_num1" name="cs_pay_num" class="form-control" min="0" max="999999">
                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">เหมาะสำหรับ : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="" name="cs_for" required>
                                <option value="">-- เลือก --</option>
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

                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะ เปิด/ปิด : <span class="text-danger">*</span></label>
                        <div class="col-lg-3">
                            <select class="custom-select form-control" id="" name="cs_status" required>
                                <option value="">-- เลือก --</option>
                                <option value="0">ค่าเริ่มต้น ปิด</option>
                                <option value="1">เปิด</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดรูปภาพ : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="cs_img" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดใบเกียรติบัตร : <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="file" id="" name="cs_cer" class="form-control" required>
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