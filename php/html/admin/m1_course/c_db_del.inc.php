<?php
if (isset($_POST['btn_del'])) {
    $check_id = $_POST['btn_del'];

    $file_path = "upload/courses/";

    try {

        $select_f = $conn->prepare("SELECT cs_img, cs_cer FROM course WHERE cs_id = :cs_id");
        $select_f->bindParam(':cs_id', $check_id);
        $select_f->execute();
        $row_f = $select_f->fetch(PDO::FETCH_ASSOC);

        // Delete from course_register
        $delete_cr = $conn->prepare("DELETE FROM course_register WHERE cs_id = :cs_id");
        $delete_cr->bindParam(':cs_id', $check_id);
        $delete_cr_result = $delete_cr->execute();

        // Delete from course_lesson
        $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE cs_id = :cs_id");
        $delete_cl->bindParam(':cs_id', $check_id);
        $delete_cl_result = $delete_cl->execute();

        if ($delete_cr_result && $delete_cl_result) {

            foreach (['cs_img', 'cs_cer'] as $fileType) {
                if (!empty($row_f[$fileType]) && file_exists($file_path . $row_f[$fileType])) {
                    unlink($file_path . $row_f[$fileType]);
                }
            }

            // Delete from course
            $delete_c = $conn->prepare("DELETE FROM course WHERE cs_id = :cs_id");
            $delete_c->bindParam(':cs_id', $check_id);
            $delete_c_result = $delete_c->execute();

            if ($delete_cr_result) {
                displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", $url_prefix);
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถลบข้อมูลได้", $url_prefix);
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
