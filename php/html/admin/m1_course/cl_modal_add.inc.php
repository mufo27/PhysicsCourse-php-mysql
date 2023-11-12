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

                    <table id="" class="table table-bordered table-striped w-100">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="width:10%; text-align: left; vertical-align: middle;">ลำดับ</th>
                                <th style="width:80%; text-align: left; vertical-align: middle;">บทเรียน</th>
                                <th style="width:10%; text-align: center; vertical-align: middle;">เลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $select_add = $conn->prepare("SELECT l.ls_id, l.ls_name 
                                                            FROM lesson l
                                                            LEFT JOIN course_lesson cl ON l.ls_id = cl.ls_id AND cl.cs_id = :cs_id
                                                            WHERE cl.ls_id IS NULL");
                            $select_add->bindParam(':cs_id', $cs_id, PDO::PARAM_INT);
                            $select_add->execute();

                            $ch = 0;
                            $k = 1;
                            while ($row_add = $select_add->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $k++; ?></td>
                                    <td style="text-align: left; vertical-align: middle;"><?= $row_add['ls_name']; ?></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <div class="form-check">
                                            <input type="hidden" name="ls_id[]" value="<?= $row_add['ls_id']; ?>">
                                            <input type="checkbox" class="form-check-input position-static" name="check[]" value="<?= $ch++; ?>">
                                        </div>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" name="btn_save" value="<?= $cs_id; ?>" class="btn btn-success">บันทึกข้อมูล</button>
                </div>
            </form>

        </div>
    </div>
</div>