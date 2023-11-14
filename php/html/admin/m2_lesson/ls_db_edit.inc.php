<?php

if (isset($_POST['btn_update'])) {

    $check_sls_name = trim($_POST['check_sls_name']);
    $sls_name      = trim($_POST['sls_name']);
    $sls_detail    = $_POST['sls_detail'];
    $sls_youtube   = trim($_POST['sls_youtube']);
    $sls_refer     = trim($_POST['sls_refer']);
    $sls_id        = $_POST['sls_id'];
    $ex_id         = $_POST['ex_id'];
    $z_id          = $_POST['z_id'];

    $select = $conn->prepare("SELECT count(*) AS check_num FROM sub_lesson WHERE ls_id=:ls_id AND sls_name=:sls_name");
    $select->bindParam(':ls_id', $ls_id);
    $select->bindParam(':sls_name', $sls_name);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row['check_num'] > 0 && $check_sls_name !== $sls_name) {

        displayMessage("error", "Error", "**ซ้ำ** มีชื่อหัวข้อย่อยในบทเรียนอยู่ในระบบแล้ว..!!", "?active=lesson&lesson_sub=$ls_id");

    } else {

        try {

            $file_location = "upload/lesson_sub/";

            // ใบความรู้รูปภาพ
            if ($_FILES['sls_img']['tmp_name'] == "") {
                $newfilename_img   = $_POST['sls_img2'];
            } else {

                $allowedExts_img    =   array("jpg,png");
                $temp_img           =   explode(".", $_FILES["sls_img"]["name"]);
                $source_file_img    =   $_FILES['sls_img']['tmp_name'];
                $size_file_img      =   $_FILES['sls_img']['size'];
                $extension_img      =   end($temp_img);
                $newfilename_img    =   'img_' . round(microtime(true)) . '.' . end($temp_img);

                unlink($file_location . $_POST['sls_img2']);
                move_uploaded_file($source_file_img, $file_location . $newfilename_img);
            }

            //ใบความรู้แบบฝึกหัด
            if ($_FILES['sls_sheet']['tmp_name'] == "") {
                $newfilename_sheet = $_POST['sls_sheet2'];
            } else {

                $allowedExts_sheet    =   array("pdf,docx");
                $temp_sheet           =   explode(".", $_FILES["sls_sheet"]["name"]);
                $source_file_sheet    =   $_FILES['sls_sheet']['tmp_name'];
                $size_file_sheet      =   $_FILES['sls_sheet']['size'];
                $extension_sheet      =   end($temp_sheet);
                $newfilename_sheet    =   'sheet_' . round(microtime(true)) . '.' . end($temp_sheet);

                unlink($file_location . $_POST['sls_sheet2']);
                move_uploaded_file($source_file_sheet, $file_location . $newfilename_sheet);
            }

            //ใบความรู้เฉลยแบบฝึกหัด
            if ($_FILES['sls_answer']['tmp_name'] == "") {
                $newfilename_answer = $_POST['sls_answer2'];
            } else {

                $allowedExts_answer    =   array("pdf,docx");
                $temp_answer           =   explode(".", $_FILES["sls_answer"]["name"]);
                $source_file_answer    =   $_FILES['sls_answer']['tmp_name'];
                $size_file_answer      =   $_FILES['sls_answer']['size'];
                $extension_answer      =   end($temp_answer);
                $newfilename_answer    =   'answer_' . round(microtime(true)) . '.' . end($temp_answer);

                unlink($file_location . $_POST['sls_answer2']);
                move_uploaded_file($source_file_answer, $file_location . $newfilename_answer);
            }

            $update = $conn->prepare("UPDATE sub_lesson SET sls_name    = :sls_name, 
                                                            sls_detail  = :sls_detail, 
                                                            sls_youtube = :sls_youtube, 
                                                            sls_refer   = :sls_refer, 
                                                            sls_img     = :sls_img, 
                                                            sls_sheet   = :sls_sheet, 
                                                            sls_answer  = :sls_answer, 
                                                            ex_id       = :ex_id,
                                                            z_id        = :z_id
                                                        WHERE sls_id = :sls_id");

            $update->bindParam(':sls_name',  $sls_name);
            $update->bindParam(':sls_detail',  $sls_detail);
            $update->bindParam(':sls_youtube',  $sls_youtube);
            $update->bindParam(':sls_refer',  $sls_refer);
            $update->bindParam(':sls_img',  $newfilename_img);
            $update->bindParam(':sls_sheet',  $newfilename_sheet);
            $update->bindParam(':sls_answer',  $newfilename_answer);
            $update->bindParam(':ex_id',  $ex_id);
            $update->bindParam(':z_id',  $z_id);
            $update->bindParam(':sls_id',  $sls_id);
            $update->execute();

            if ($update) {
                displayMessage("success", "Success", "แก้ไขข้อมูล เรียบร้อย...!!", "?active=lesson&lesson_sub=$ls_id");
            } else {
                displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=lesson&lesson_sub=$ls_id");
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
