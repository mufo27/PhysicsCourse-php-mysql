<?php
if (isset($_POST['btn_save'])) {

    $check_cs_id = $_POST['btn_save'];
    $check_ls_id = $_POST['ls_id'];

    if (empty($_POST['check']) || $_POST['check'] == 0) {
        displayMessage("error", "Error", "โปรดเลือกอย่างน้อย 1 รายการ", "?active=course&course_lesson=$check_cs_id");
    } else {

        try {

            foreach ($_POST['check'] as $key) {
                $insert = $conn->prepare("INSERT INTO course_lesson (cs_id, ls_id) VALUES (:cs_id, :ls_id)");
                $insert->bindParam(':cs_id',  $check_cs_id);
                $insert->bindParam(':ls_id',  $check_ls_id[$key]);
                $insert->execute();
            }
            if ($insert) {
                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", "?active=course&course_lesson=$check_cs_id");
            } else {
                displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=course&course_lesson=$check_cs_id");
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
