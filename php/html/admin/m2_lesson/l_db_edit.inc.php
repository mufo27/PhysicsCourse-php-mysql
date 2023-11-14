<?php

if (isset($_POST['btn_update'])) {

    $ls_id       = $_POST['ls_id'];
    $check_ls_name = trim($_POST['check_ls_name']);
    $ls_name     = trim($_POST['ls_name']);
    $ls_detail   = $_POST['ls_detail'];

    try {

        $check_data = $conn->prepare("SELECT COUNT(*) AS check_num FROM lesson WHERE ls_name = :ls_name AND ls_id != :ls_id");
        $check_data->bindParam(':ls_name', $ls_name);
        $check_data->bindParam(':ls_id', $ls_id);
        $check_data->execute();
        $count_data = $check_data->fetchColumn();

        if ($count_data > 0) {
            displayMessage("error", "Error", "**ซ้ำ** มีบทเรียนนี้ อยู่ในระบบแล้ว..!!", "?active=lesson&lesson");
        } else {

            $update_l = $conn->prepare("UPDATE lesson SET ls_name=:ls_name, ls_detail=:ls_detail WHERE ls_id=:ls_id");
            $update_l->bindParam(':ls_id', $ls_id);
            $update_l->bindParam(':ls_name', $ls_name);
            $update_l->bindParam(':ls_detail', $ls_detail);
            $update_l->execute();

            $result_rows = $update_l->rowCount();

            if ($result_rows > 0) {
                displayMessage("success", "Success", "แก้ไขข้อมูล เรียบร้อย...!!", "?active=lesson&lesson");
            } else {
                displayMessage("error", "Error", "โปรดตรวจสอบ..!! ไม่สามารถแก้ไขข้อมูลได้", "?active=lesson&lesson");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
