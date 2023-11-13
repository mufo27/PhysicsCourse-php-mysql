<?php

if (isset($_POST['btn_del'])) {

    $check_id = $_POST['btn_del'];

    try {

        $file_location  = "upload/lesson_sub/";

        $select = $conn->prepare("SELECT sls_img, sls_sheet, sls_answer FROM sub_lesson WHERE sls_id = :check_id");
        $select->bindParam(':check_id', $check_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['sls_img'] != '') {
            unlink($file_location . $row['sls_img']);
        }

        if ($row['sls_sheet'] != '') {
            unlink($file_location . $row['sls_sheet']);
        }

        if ($row['sls_answer'] != '') {
            unlink($file_location . $row['sls_answer']);
        }

        $delete_pg = $conn->prepare("DELETE FROM progress WHERE sls_id = :sls_id");
        $delete_pg->bindParam(':sls_id', $check_id);
        $delete_pg->execute();

        $delete_exe_status = $conn->prepare("DELETE FROM ex_status WHERE sls_id = :sls_id");
        $delete_exe_status->bindParam(':sls_id', $check_id);
        $delete_exe_status->execute();

        $delete_qza = $conn->prepare("DELETE FROM qz_answer WHERE sls_id = :sls_id");
        $delete_qza->bindParam(':sls_id', $check_id);
        $delete_qza->execute();

        $delete_qzp = $conn->prepare("DELETE FROM qz_point WHERE sls_id = :sls_id");
        $delete_qzp->bindParam(':sls_id', $check_id);
        $delete_qzp->execute();

        $delete_sls = $conn->prepare("DELETE FROM sub_lesson  WHERE sls_id = :check_id");
        $delete_sls->bindParam(':check_id', $check_id);
        $delete_sls->execute();

        if ($delete_pg && $delete_exe_status && $delete_qza && $delete_qzp && $delete_sls) {

            echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ลบข้อมูล เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson_sub=$ls_id\">";
            exit;
        } else {

            echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                        });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson_sub=$ls_id\">";
            exit;
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}
