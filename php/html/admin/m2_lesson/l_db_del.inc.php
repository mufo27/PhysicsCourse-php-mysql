<?php

if (isset($_POST['btn_del'])) {


    $check_ls_id = $_POST['btn_del'];

    try {
        // Delete records
        $listTableName = ['course_lesson', 'lesson'];

        $result = array_reduce($listTableName, function ($carry, $tableName) use ($conn, $check_ls_id) {
            $delete = $conn->prepare("DELETE FROM $tableName WHERE ls_id = :ls_id");
            $delete->bindParam(':ls_id', $check_ls_id);
            $delete->execute();
            return $carry && ($delete->rowCount() > 0);
        }, true);

        if ($result) {
            displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", "?active=lesson&lesson");
        } else {
            displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=lesson&lesson");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // $check_ls_id = $_POST['btn_del'];

    // try {

    //     $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE ls_id = :ls_id");
    //     $delete_cl->bindParam(':ls_id', $check_ls_id);
    //     $delete_cl->execute();

    //     $delete_l = $conn->prepare("DELETE FROM lesson WHERE ls_id = :ls_id");
    //     $delete_l->bindParam(':ls_id', $check_ls_id);
    //     $delete_l->execute();

    //     if ($delete_cl && $delete_l) {
    //         displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", "?active=lesson&lesson");
    //     } else {
    //         displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=lesson&lesson");
    //     }
    // } catch (PDOException $e) {

    //     echo $e->getMessage();
    // }
    
}
