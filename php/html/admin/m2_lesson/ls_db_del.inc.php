<?php


if (isset($_POST['btn_del'])) {

    $check_id = $_POST['btn_del'];

    try {
        $file_location = "upload/lesson_sub/";

        $select = $conn->prepare("SELECT sls_img, sls_sheet, sls_answer FROM sub_lesson WHERE sls_id = :check_id");
        $select->bindParam(':check_id', $check_id);
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
        deleteFile($row['sls_img']);
        deleteFile($row['sls_sheet']);
        deleteFile($row['sls_answer']);

        // Delete records
        $deleteQueries = ['progress', 'ex_status', 'qz_answer', 'qz_point', 'sub_lesson'];

        foreach ($deleteQueries as $tableName) {
            $deleteQuery = $conn->prepare("DELETE FROM $tableName WHERE sls_id = :sls_id");
            $deleteQuery->bindParam(':sls_id', $check_id);
            $deleteQuery->execute();
        }

        // Check if any record was deleted successfully
        $deleteSuccess = array_reduce($deleteQueries, function ($carry, $tableName) use ($conn, $check_id) {
            $deleteQuery = $conn->prepare("DELETE FROM $tableName WHERE sls_id = :sls_id");
            $deleteQuery->bindParam(':sls_id', $check_id);
            $deleteQuery->execute();
            return $carry && ($deleteQuery->rowCount() > 0);
        }, true);

        if ($deleteSuccess) {
            displayMessage("success", "Success", "แก้ไขข้อมูล เรียบร้อย...!!", "?active=lesson&lesson_sub=$ls_id");
        } else {
            displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=lesson&lesson_sub=$ls_id");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // $check_id = $_POST['btn_del'];

    // try {

    //     $file_location  = "upload/lesson_sub/";

    //     $select = $conn->prepare("SELECT sls_img, sls_sheet, sls_answer FROM sub_lesson WHERE sls_id = :check_id");
    //     $select->bindParam(':check_id', $check_id);
    //     $select->execute();
    //     $row = $select->fetch(PDO::FETCH_ASSOC);

    //     if ($row['sls_img'] != '' && file_exists($file_location . $row['sls_img'])) {
    //         unlink($file_location . $row['sls_img']);
    //     }

    //     if ($row['sls_sheet'] != '' && file_exists($file_location . $row['sls_sheet'])) {
    //         unlink($file_location . $row['sls_sheet']);
    //     }

    //     if ($row['sls_answer'] != '' && file_exists($file_location . $row['sls_answer'])) {
    //         unlink($file_location . $row['sls_answer']);
    //     }

    //     $delete_pg = $conn->prepare("DELETE FROM progress WHERE sls_id = :sls_id");
    //     $delete_pg->bindParam(':sls_id', $check_id);
    //     $delete_pg->execute();

    //     $delete_exe_status = $conn->prepare("DELETE FROM ex_status WHERE sls_id = :sls_id");
    //     $delete_exe_status->bindParam(':sls_id', $check_id);
    //     $delete_exe_status->execute();

    //     $delete_qza = $conn->prepare("DELETE FROM qz_answer WHERE sls_id = :sls_id");
    //     $delete_qza->bindParam(':sls_id', $check_id);
    //     $delete_qza->execute();

    //     $delete_qzp = $conn->prepare("DELETE FROM qz_point WHERE sls_id = :sls_id");
    //     $delete_qzp->bindParam(':sls_id', $check_id);
    //     $delete_qzp->execute();

    //     $delete_sls = $conn->prepare("DELETE FROM sub_lesson  WHERE sls_id = :sls_id");
    //     $delete_sls->bindParam(':sls_id', $check_id);
    //     $delete_sls->execute();

    //     if ($delete_pg && $delete_exe_status && $delete_qza && $delete_qzp && $delete_sls) {
    //         displayMessage("success", "Success", "แก้ไขข้อมูล เรียบร้อย...!!", "?active=lesson&lesson_sub=$ls_id");
    //     } else {
    //         displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=lesson&lesson_sub=$ls_id");
    //     }
    // } catch (PDOException $e) {

    //     echo $e->getMessage();
    // }
}
