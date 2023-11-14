<?php

if (isset($_POST['btn_del'])) {

    $check_ls_id = $_POST['btn_del'];

    try {
 
        $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE ls_id = :ls_id");
        $delete_cl->bindParam(':ls_id', $check_ls_id);
        $delete_cl->execute();

        $delete_l = $conn->prepare("DELETE FROM lesson WHERE ls_id = :ls_id");
        $delete_l->bindParam(':ls_id', $check_ls_id);
        $delete_l->execute();

        if ($delete_cl && $delete_l) {
            displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", $url_prefix);
        } else {
            displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถลบข้อมูลได้", $url_prefix);
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
    
}
