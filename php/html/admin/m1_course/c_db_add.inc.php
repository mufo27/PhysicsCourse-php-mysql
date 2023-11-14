<?php

if (isset($_POST['btn_save'])) {

    $cs_code       = trim($_POST['cs_code']);
    $cs_name       = trim($_POST['cs_name']);
    $cs_detail     = $_POST['cs_detail'];
    $k_hour        = $_POST['k_hour'];
    $k_minute      = $_POST['k_minute'];
    $cs_pay_status = $_POST['cs_pay_status'];
    $cs_pay_num    = $_POST['cs_pay_num'];
    $cs_for        = $_POST['cs_for'];
    $cs_status     = $_POST['cs_status'];

    $file_path = 'upload/courses/';

    $check_data = $conn->prepare("SELECT 
                                        (SELECT COUNT(*) FROM course WHERE cs_code = :cs_code) AS num_code,
                                        (SELECT COUNT(*) FROM course WHERE cs_name = :cs_name) AS num_name");
    $check_data->bindParam(':cs_code', $cs_code);
    $check_data->bindParam(':cs_name', $cs_name);
    $check_data->execute();
    $count_data = $check_data->fetch(PDO::FETCH_ASSOC);

    if ($count_data['num_code'] > 0) {
        displayMessage("error", "Error", "**ซ้ำ** มีรหัสคอร์สเรียนนี้ อยู่ในระบบแล้ว..!!", $url_prefix);
    } elseif ($count_data['num_name'] > 0) {
        displayMessage("error", "Error", "**ซ้ำ** มีชื่อคอร์สเรียนนี้ อยู่ในระบบแล้ว..!!", $url_prefix);
    } else {
        try {

            if (!empty($_FILES['cs_img']['tmp_name'])) {
                $new_img = checkFileUploadImage('cs_img', $url_prefix);
            }
            if (!empty($_FILES['cs_cer']['tmp_name'])) {
                $new_cer = checkFileUploadImage('cs_cer', $url_prefix);
            }

            $insert_c = $conn->prepare("INSERT INTO course (cs_code, cs_name, cs_detail, k_hour, k_minute, cs_pay_status, cs_pay_num, cs_status, cs_for, cs_img, cs_cer) 
            VALUES (:cs_code, :cs_name, :cs_detail, :k_hour, :k_minute, :cs_pay_status, :cs_pay_num, :cs_status, :cs_for, :cs_img, :cs_cer)");
            $insert_c->bindParam(':cs_code',  $cs_code);
            $insert_c->bindParam(':cs_name',  $cs_name);
            $insert_c->bindParam(':cs_detail',  $cs_detail);
            $insert_c->bindParam(':k_hour',  $k_hour);
            $insert_c->bindParam(':k_minute',  $k_minute);
            $insert_c->bindParam(':cs_pay_status',  $cs_pay_status);
            $insert_c->bindParam(':cs_pay_num',  $cs_pay_num);
            $insert_c->bindParam(':cs_status',  $cs_status);
            $insert_c->bindParam(':cs_for',  $cs_for);
            $insert_c->bindParam(':cs_img',  $new_img);
            $insert_c->bindParam(':cs_cer',  $new_cer);
            $insert_c->execute();

            if ($insert_c) {

                if (!empty($_FILES['cs_img']['tmp_name'])) {
                    move_uploaded_file($_FILES['cs_img']['tmp_name'], $file_path . $new_img);
                }
                if (!empty($_FILES['cs_cer']['tmp_name'])) {
                    move_uploaded_file($_FILES['cs_cer']['tmp_name'], $file_path . $new_cer);
                }

                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", $url_prefix);
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถบันทึกข้อมูลได้", $url_prefix);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
