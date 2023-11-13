<?php
if (isset($_POST['btn_del'])) {

    $check_id = $_POST['btn_del'];

    try {
        $file_location = "upload/courses/";

        $select = $conn->prepare("SELECT cs_img, cs_cer FROM course WHERE cs_id = :cs_id");
        $select->bindParam(':cs_id', $check_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        // Function to delete a file if it exists
        function deleteFile($file)
        {
            global $file_location;
            if (!empty($file) && file_exists($file_location . $file)) {
                unlink($file_location . $file);
            }
        }

        // Delete files
        deleteFile($row['cs_img']);
        deleteFile($row['cs_cer']);

        // Delete records
        $listTableName = ['course_register', 'course_lesson', 'course'];

        $result = array_reduce($listTableName, function ($carry, $tableName) use ($conn, $check_id) {
            $delete = $conn->prepare("DELETE FROM $tableName WHERE cs_id = :cs_id");
            $delete->bindParam(':cs_id', $check_id);
            $delete->execute();
            return $carry && ($delete->rowCount() > 0);
        }, true);

        if ($result) {
            displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", "?active=course&course");
        } else {
            displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=course&course");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // $check_id = $_POST['btn_del'];

    // try {

    //     $file_location  = "upload/courses/";

    //     $select = $conn->prepare("SELECT cs_img, cs_cer FROM course WHERE cs_id = :cs_id");
    //     $select->bindParam(':cs_id', $check_id);
    //     $select->execute();
    //     $row = $select->fetch(PDO::FETCH_ASSOC);

    //     if ($row['cs_img'] != '' && file_exists($file_location . $row['cs_img'])) {
    //         unlink($file_location . $row['cs_img']);
    //     }

    //     if ($row['cs_cer'] != '' && file_exists($file_location . $row['cs_cer'])) {
    //         unlink($file_location . $row['cs_cer']);
    //     }

    //     $delete_cr = $conn->prepare("DELETE FROM course_register WHERE cs_id = :cs_id");
    //     $delete_cr->bindParam(':cs_id', $check_id);
    //     $delete_cr->execute();

    //     $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE cs_id = :cs_id");
    //     $delete_cl->bindParam(':cs_id', $check_id);
    //     $delete_cl->execute();

    //     $delete_c = $conn->prepare("DELETE FROM course WHERE cs_id = :cs_id");
    //     $delete_c->bindParam(':cs_id', $check_id);
    //     $delete_c->execute();

    //     if ($delete_cr && $delete_cl && $delete_c) {
    //         displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", "?active=course&course");
    //     } else {
    //         displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=course&course");
    //     }
    // } catch (PDOException $e) {

    //     echo $e->getMessage();
    // }
}
