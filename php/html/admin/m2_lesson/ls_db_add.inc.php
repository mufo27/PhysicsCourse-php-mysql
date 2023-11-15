<?php

if (isset($_POST['btn_save'])) {

    $sls_name      = trim($_POST['sls_name']);
    $sls_detail    = $_POST['sls_detail'];
    $sls_youtube   = trim($_POST['sls_youtube']);
    $sls_refer     = trim($_POST['sls_refer']);
    $ls_id         = $_POST['ls_id'];
    $ex_id         = $_POST['ex_id'];
    $z_id          = $_POST['z_id'];
 
    $file_path = 'upload/lesson_sub/';

    $check_data = $conn->prepare("SELECT count(*) FROM sub_lesson WHERE ls_id=:ls_id AND sls_name=:sls_name");
    $check_data->bindParam(':ls_id', $ls_id);
    $check_data->bindParam(':sls_name', $sls_name);
    $check_data->execute();
    $count_data = $check_data->fetchColumn();
 
    if ($count_data > 0) {
        displayMessage("error", "Error", "**ซ้ำ** มีชื่อหัวข้อย่อยในบทเรียนอยู่ในระบบแล้ว..!!",  $url_prefix);
    } else {

        // มาทำต่อหน้านี้ ok
        try {

            if (!empty($_FILES['sls_img']['tmp_name'])) {
                $new_img = checkFileUploadImage('sls_img', $url_prefix);
            } else {
                $new_img = '';
            }

            if (!empty($_FILES['sls_sheet']['tmp_name'])) {
                $new_sheet = checkFileUploadDocument('sls_sheet', $url_prefix);
            } else {
                $new_sheet = '';
            }

            if (!empty($_FILES['sls_answer']['tmp_name'])) {
                $new_answer = checkFileUploadDocument('sls_answer', $url_prefix);
            } else {
                $new_answer = '';
            }


            $insert = $conn->prepare("INSERT INTO sub_lesson (sls_name, sls_detail, sls_youtube, sls_refer, sls_img, sls_sheet, sls_answer, ls_id, ex_id, z_id) 
                VALUES (:sls_name, :sls_detail, :sls_youtube, :sls_refer, :sls_img, :sls_sheet, :sls_answer, :ls_id, :ex_id, :z_id)");
            $insert->bindParam(':sls_name',  $sls_name);
            $insert->bindParam(':sls_detail',  $sls_detail);
            $insert->bindParam(':sls_youtube',  $sls_youtube);
            $insert->bindParam(':sls_refer',  $sls_refer);
            $insert->bindParam(':sls_img',  $newfilename_img);
            $insert->bindParam(':sls_sheet',  $newfilename_sheet);
            $insert->bindParam(':sls_answer',  $newfilename_answer);
            $insert->bindParam(':ls_id',  $ls_id);
            $insert->bindParam(':ex_id',  $ex_id);
            $insert->bindParam(':z_id',  $z_id);

            $insert->execute();

            if ($insert) {
                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", $url_prefix);
            } else {
                displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", $url_prefix);
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
