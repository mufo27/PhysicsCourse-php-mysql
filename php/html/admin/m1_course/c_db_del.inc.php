<?php
if (isset($_POST['btn_del'])) {

    $check_id = $_POST['btn_del'];

    try {

        $file_location  = "upload/courses/";

        $select = $conn->prepare("SELECT cs_img, cs_cer FROM course WHERE cs_id = :check_id");
        $select->bindParam(':check_id', $check_id);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['cs_img'] != '') {
            unlink($file_location . $row['cs_img']);
        }

        if ($row['cs_cer'] != '') {
            unlink($file_location . $row['cs_cer']);
        }

        $delete_cr = $conn->prepare("DELETE FROM course_register WHERE cs_id = :check_id");
        $delete_cr->bindParam(':check_id', $check_id);
        $delete_cr->execute();

        $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE cs_id = :check_id");
        $delete_cl->bindParam(':check_id', $check_id);
        $delete_cl->execute();

        $delete_c = $conn->prepare("DELETE FROM course WHERE cs_id = :check_id");
        $delete_c->bindParam(':check_id', $check_id);
        $delete_c->execute();

        if ($delete_cr && $delete_cl && $delete_c) {
            // echo '<script type="text/javascript">
            //         Swal.fire({
            //             icon: "success",
            //             title: "ลบข้อมูล เรียบร้อย...!!", 
            //             showConfirmButton: false,
            //             timer: 2000
            //         });
            //         </script>';
            // echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
            // exit;
            displayMessage("success", "Success", "ลบข้อมูล เรียบร้อย...!!", "?active=course&course");
        } else {
            // echo '<script type="text/javascript">
            //         Swal.fire({
            //         icon: "error",
            //         title: "ล้มเหลว",
            //         text: "โปรด ลองใหม่อีกครั้ง..!!"
            //         });
            //     </script>';
            // echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
            // exit;
            displayMessage("error", "Error", "โปรด ลองใหม่อีกครั้ง..!!", "?active=course&course");
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}
