<?php
if (isset($_POST['btn_save'])) {

    $check_cs_id = $_POST['btn_save'];
    $check_ls_id = $_POST['ls_id'];

    if (empty($_POST['check']) || $_POST['check'] == 0) {
        displayMessage("error", "Error", "โปรดเลือกอย่างน้อย 1 รายการ", "?active=course&course_lesson=$check_cs_id");
    } else {

        try {

            foreach ($_POST['check'] as $key) {
                $insert_cl = $conn->prepare("INSERT INTO course_lesson (cs_id, ls_id) VALUES (:cs_id, :ls_id)");
                $insert_cl->bindParam(':cs_id',  $check_cs_id);
                $insert_cl->bindParam(':ls_id',  $check_ls_id[$key]);
                $insert_cl->execute();
            }
            
            if ($insert_cl->rowCount() > 0) {
                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", "?active=course&course_lesson=$check_cs_id");
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถบันทึกข้อมูลได้", "?active=course&course_lesson=$check_cs_id");
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
