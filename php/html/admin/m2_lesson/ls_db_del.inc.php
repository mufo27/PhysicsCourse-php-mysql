<?php


if (isset($_POST['btn_del'])) {


    $check_id = $_POST['btn_del'];

    try {

        $file_location  = "upload/lesson_sub/";

        $select_f = $conn->prepare("SELECT sls_img, sls_sheet, sls_answer FROM sub_lesson WHERE sls_id = :check_id");
        $select_f->bindParam(':check_id', $check_id);
        $select_f->execute();
        $row_f = $select_f->fetch(PDO::FETCH_ASSOC);

        // Delete from progress
        $delete_p = $conn->prepare("DELETE FROM progress WHERE sls_id = :sls_id");
        $delete_p->bindParam(':sls_id', $check_id);
        $delete_p->execute();
        $delete_p_result = $delete_p->execute();

        // Delete from ex_status
        $delete_e = $conn->prepare("DELETE FROM ex_status WHERE sls_id = :sls_id");
        $delete_e->bindParam(':sls_id', $check_id);
        $delete_e->execute();
        $delete_e_result = $delete_e->execute();

        // Delete from qz_answer
        $delete_q = $conn->prepare("DELETE FROM qz_answer WHERE sls_id = :sls_id");
        $delete_q->bindParam(':sls_id', $check_id);
        $delete_q->execute();
        $delete_q_result = $delete_q->execute();

        // Delete from qz_point
        $delete_qz = $conn->prepare("DELETE FROM qz_point WHERE sls_id = :sls_id");
        $delete_qz->bindParam(':sls_id', $check_id);
        $delete_qz->execute();
        $delete_qz_result = $delete_qz->execute();

        if ($delete_p_result && $delete_e_result && $delete_q_result && $delete_qz_result) {

            foreach (['sls_img', 'sls_sheet', 'sls_answer'] as $fileType) {
                if (!empty($row_f[$fileType]) && file_exists($file_location . $row_f[$fileType])) {
                    unlink($file_location . $row_f[$fileType]);
                }
            }

            // Delete from sub_lesson
            $delete_sls = $conn->prepare("DELETE FROM sub_lesson  WHERE sls_id = :sls_id");
            $delete_sls->bindParam(':sls_id', $check_id);
            $delete_sls->execute();
            $delete_sls_result = $delete_sls->execute();

            if ($delete_sls_result) {
                displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", "?active=lesson&lesson_sub=$ls_id");
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถลบข้อมูลได้", "?active=lesson&lesson_sub=$ls_id");
            }
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}
