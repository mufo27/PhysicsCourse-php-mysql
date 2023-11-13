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

    $select_check = $conn->prepare("SELECT 
                                        (SELECT COUNT(*) FROM course WHERE cs_code = :cs_code) AS num_code,
                                        (SELECT COUNT(*) FROM course WHERE cs_name = :cs_name) AS num_name");
    $select_check->bindParam(':cs_code', $cs_code);
    $select_check->bindParam(':cs_name', $cs_name);
    $select_check->execute();
    $row_check = $select_check->fetch(PDO::FETCH_ASSOC);

    if ($row_check['num_code'] > 0) {
        // echo '<script type="text/javascript">
        //         Swal.fire({
        //         icon: "error",
        //         title: "ล้มเหลว",
        //         text: "**ซ้ำ** มีรหัสคอร์สเรียนอยู่ในระบบแล้ว..!!"
        //         });
        //     </script>';
        // echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
        // exit;
        displayMessage("error", "Error", "**ซ้ำ** มีรหัสคอร์สเรียนอยู่ในระบบแล้ว..!!", "?active=course&course");
    } else if ($row_check['num_name'] > 0) {
        // echo '<script type="text/javascript">
        //         Swal.fire({
        //         icon: "error",
        //         title: "ล้มเหลว",
        //         text: "**ซ้ำ** มีชื่อคอร์สเรียนอยู่ในระบบแล้ว..!!"
        //         });
        //     </script>';
        // echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
        // exit;
        displayMessage("error", "Error", "**ซ้ำ** มีชื่อคอร์สเรียนอยู่ในระบบแล้ว..!!", "?active=course&course");
    } else {

        try {

            $file_location  = "upload/courses/";

            if ($_FILES['cs_img']['tmp_name'] == "") {

                $newfilename   = "";
            } else {

                $allowedExts    =   array("jpg,png");
                $temp           =   explode(".", $_FILES["cs_img"]["name"]);
                $source_file    =   $_FILES['cs_img']['tmp_name'];
                $size_file      =   $_FILES['cs_img']['size'];
                $extension      =   end($temp);
                $newfilename    =   'img_' . round(microtime(true)) . '.' . end($temp);

                move_uploaded_file($source_file, $file_location . $newfilename);
            }

            if ($_FILES['cs_cer']['tmp_name'] == "") {

                $newfilename_cer = "";
            } else {

                $allowedExts_cer    =   array("jpg,png");
                $temp_cer           =   explode(".", $_FILES["cs_cer"]["name"]);
                $source_file_cer    =   $_FILES['cs_cer']['tmp_name'];
                $size_file_cer      =   $_FILES['cs_cer']['size'];
                $extension_cer      =   end($temp_cer);
                $newfilename_cer    =   'cer_' . round(microtime(true)) . '.' . end($temp_cer);

                move_uploaded_file($source_file_cer, $file_location . $newfilename_cer);
            }


            $insert = $conn->prepare("INSERT INTO course (cs_code, cs_name, cs_detail, k_hour, k_minute, cs_pay_status, cs_pay_num, cs_status, cs_for, cs_img, cs_cer) 
            VALUES (:cs_code, :cs_name, :cs_detail, :k_hour, :k_minute, :cs_pay_status, :cs_pay_num, :cs_status, :cs_for, :cs_img, :cs_cer)");
            $insert->bindParam(':cs_code',  $cs_code);
            $insert->bindParam(':cs_name',  $cs_name);
            $insert->bindParam(':cs_detail',  $cs_detail);
            $insert->bindParam(':k_hour',  $k_hour);
            $insert->bindParam(':k_minute',  $k_minute);
            $insert->bindParam(':cs_pay_status',  $cs_pay_status);
            $insert->bindParam(':cs_pay_num',  $cs_pay_num);
            $insert->bindParam(':cs_status',  $cs_status);
            $insert->bindParam(':cs_for',  $cs_for);
            $insert->bindParam(':cs_img',  $newfilename);
            $insert->bindParam(':cs_cer',  $newfilename_cer);
            $insert->execute();

            if ($insert) {
                // echo '<script type="text/javascript">
                //         Swal.fire({
                //             icon: "success",
                //             title: "บันทึกข้อมูล เรียบร้อย...!!", 
                //             showConfirmButton: false,
                //             timer: 2000
                //         });
                //         </script>';
                // echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
                // exit;
                displayMessage("success", "Success", "บันทึกข้อมูล เรียบร้อย...!!", "?active=course&course");
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
}
