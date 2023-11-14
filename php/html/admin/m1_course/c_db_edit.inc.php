<?php
if (isset($_POST['btn_update'])) {

    $cs_id         = $_POST['cs_id'];
    $check_cs_code = trim($_POST['check_cs_code']);
    $cs_code       = trim($_POST['cs_code']);
    $check_cs_name = trim($_POST['check_cs_name']);
    $cs_name       = trim($_POST['cs_name']);
    $cs_detail     = $_POST['cs_detail'];
    $k_hour        = $_POST['k_hour'];
    $k_minute      = $_POST['k_minute'];
    $cs_pay_status = $_POST['cs_pay_status'];
    $cs_pay_num    = $_POST['cs_pay_num'];
    $cs_for        = $_POST['cs_for'];
    $cs_status     = $_POST['cs_status'];

    $check_cs_img  = $_POST['check_cs_img'];
    $check_cs_cer  = $_POST['check_cs_cer'];

    $file_path  = "upload/courses/";

    $check_data = $conn->prepare("SELECT 
                                        (SELECT COUNT(*) FROM course WHERE cs_code = :cs_code) AS num_code,
                                        (SELECT COUNT(*) FROM course WHERE cs_name = :cs_name) AS num_name");
    $check_data->bindParam(':cs_code', $cs_code);
    $check_data->bindParam(':cs_name', $cs_name);
    $check_data->execute();
    $count_data = $check_data->fetch(PDO::FETCH_ASSOC);

    if ($count_data['num_code'] > 0 && $check_cs_code !== $cs_code) {
        displayMessage("error", "Error", "**ซ้ำ** มีรหัสคอร์สเรียนนี้ อยู่ในระบบแล้ว..!!", $url_prefix);
    } else if ($count_data['num_name'] > 0 && $check_cs_name !== $cs_name) {
        displayMessage("error", "Error", "**ซ้ำ** มีชื่อคอร์สเรียนนี้ อยู่ในระบบแล้ว..!!", $url_prefix);
    } else {
        try {

            if (!empty($_FILES['cs_img']['tmp_name'])) {
                $new_img = checkFileUploadImage('cs_img', $url_prefix);
            } else {
                $new_img = $check_cs_img;
            }

            if (!empty($_FILES['cs_cer']['tmp_name'])) {
                $new_cer = checkFileUploadImage('cs_cer', $url_prefix);
            } else {
                $new_cer = $check_cs_cer;
            }

            $update_c = $conn->prepare("UPDATE course SET cs_code = :cs_code, 
                                                    cs_name = :cs_name, 
                                                    cs_detail = :cs_detail, 
                                                    k_hour = :k_hour, 
                                                    k_minute = :k_minute, 
                                                    cs_pay_status = :cs_pay_status, 
                                                    cs_pay_num = :cs_pay_num, 
                                                    cs_status = :cs_status, 
                                                    cs_for = :cs_for, 
                                                    cs_img = :cs_img, 
                                                    cs_cer = :cs_cer 
                                                WHERE cs_id = :cs_id");

            $update_c->bindParam(':cs_id',  $cs_id);
            $update_c->bindParam(':cs_code',  $cs_code);
            $update_c->bindParam(':cs_name',  $cs_name);
            $update_c->bindParam(':cs_detail',  $cs_detail);
            $update_c->bindParam(':k_hour',  $k_hour);
            $update_c->bindParam(':k_minute',  $k_minute);
            $update_c->bindParam(':cs_pay_status',  $cs_pay_status);
            $update_c->bindParam(':cs_pay_num',  $cs_pay_num);
            $update_c->bindParam(':cs_status',  $cs_status);
            $update_c->bindParam(':cs_for',  $cs_for);
            $update_c->bindParam(':cs_img',  $new_img);
            $update_c->bindParam(':cs_cer',  $new_cer);
            $update_c->execute();

            if ($update_c) {

                if (!empty($_FILES['cs_img']['tmp_name'])) {
                    unlink($file_path . $check_cs_img);
                    move_uploaded_file($_FILES['cs_img']['tmp_name'], $file_path . $new_img);
                }
        
                if (!empty($_FILES['cs_cer']['tmp_name'])) {
                    unlink($file_path . $check_cs_cer);
                    move_uploaded_file($_FILES['cs_cer']['tmp_name'], $file_path . $new_cer);
                }

                displayMessage("success", "Success", "แก้ไขข้อมูล เรียบร้อย...!!", $url_prefix);
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถแก้ไขข้อมูลได้", $url_prefix);
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}

