<?php

if (isset($_POST['btn_save'])) {

    $ls_name   = trim($_POST['ls_name']);
    $ls_detail = $_POST['ls_detail'];

    $check_data = $conn->prepare("SELECT count(*) FROM lesson WHERE ls_name = :ls_name");
    $check_data->bindParam(':ls_name', $ls_name);
    $check_data->execute();
    $count_data = $check_data->fetchColumn();

    if ($count_data > 0) {
        displayMessage("error", "Error", "**ซ้ำ** มีบทเรียนนี้ อยู่ในระบบแล้ว..!!", $url_prefix);
    } else {

        try {

            $insert_l = $conn->prepare("INSERT INTO lesson (ls_name, ls_detail) VALUES (:ls_name, :ls_detail)");
            $insert_l->bindParam(':ls_name', $ls_name);
            $insert_l->bindParam(':ls_detail',  $ls_detail);
            $insert_l->execute();

            if ($insert_l) {
                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", $url_prefix);
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถบันทึกข้อมูลได้", $url_prefix);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
