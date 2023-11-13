<?php

if (isset($_POST['btn_save'])) {

    $ls_name   = trim($_POST['ls_name']);
    $ls_detail = $_POST['ls_detail'];

    $select = $conn->prepare("SELECT count(*) AS check_num FROM lesson WHERE ls_name = :ls_name");
    $select->bindParam(':ls_name', $ls_name);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row['check_num'] > 0) {
        // echo '<script type="text/javascript">
        //         Swal.fire({
        //             icon: "error",
        //             title: "ล้มเหลว",
        //             text: "**ซ้ำ** มีบทเรียนอยู่ในระบบแล้ว..!!"
        //             });
        //         </script>';
        // echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson\">";
        // exit;
        displayMessage("error", "Error", "**ซ้ำ** มีบทเรียนอยู่ในระบบแล้ว..!!", "?active=lesson&lesson");
    } else {

        try {

            $insert = $conn->prepare("INSERT INTO lesson (ls_name, ls_detail) VALUES (:ls_name, :ls_detail)");
            $insert->bindParam(':ls_name', $ls_name);
            $insert->bindParam(':ls_detail',  $ls_detail);
            $insert->execute();

            if ($insert) {
                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", "?active=lesson&lesson");
            } else {
                displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=lesson&lesson");
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
