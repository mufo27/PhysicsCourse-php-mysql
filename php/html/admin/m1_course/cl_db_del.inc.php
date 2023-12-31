<?php
if (isset($_POST['btn_del'])) {

    $check_csl_id = $_POST['btn_del'];
    $check_cs_id = $_POST['cs_id'];

    try {
        $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE csl_id = :csl_id");
        $delete_cl->bindParam(':csl_id', $check_csl_id);
        $result_cl = $delete_cl->execute();

        if ($result_cl) {
            displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", $url_prefix);
        } else {
            displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถลบข้อมูลได้", $url_prefix);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
