<?php
if (isset($_POST['btn_del'])) {

    $check_csl_id = $_POST['btn_del'];
    $check_cs_id = $_POST['cs_id'];

    try {

        $delete_t1 = $conn->prepare("DELETE FROM course_lesson WHERE csl_id = :check_id");
        $delete_t1->bindParam(':check_id' , $check_csl_id);
        $delete_t1->execute();

        if ($delete_t1->execute()) {
            displayMessage("success", "Success", "ลบข้อมูลทิ้ง เรียบร้อย...!!", "?active=course&course_lesson=$check_cs_id");
        } else {
            displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=course&course_lesson=$check_cs_id");
        }

    } catch (PDOException $e) {

        echo $e->getMessage();

    }

}
