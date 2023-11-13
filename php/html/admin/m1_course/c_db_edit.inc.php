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

    $select_check = $conn->prepare("SELECT 
                                        (SELECT COUNT(*) FROM course WHERE cs_code = :cs_code) AS num_code,
                                        (SELECT COUNT(*) FROM course WHERE cs_name = :cs_name) AS num_name");
    $select_check->bindParam(':cs_code', $cs_code);
    $select_check->bindParam(':cs_name', $cs_name);
    $select_check->execute();
    $row_check = $select_check->fetch(PDO::FETCH_ASSOC);

    if ($row_check['num_code'] > 0 && $check_cs_code !== $cs_code) {
        echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "**ซ้ำ** มีรหัสคอร์สเรียนอยู่ในระบบแล้ว..!!"
                    });
                </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
        exit;
    } else if ($row_check['num_name'] > 0 && $check_cs_name !== $cs_name) {
        echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "**ซ้ำ** มีชื่อคอร์สเรียนอยู่ในระบบแล้ว..!!"
                    });
                </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
        exit;
    } else {
        try {

            $file_location  = "upload/courses/";

            if ($_FILES['cs_img']['tmp_name'] == "") {

                $newfilename   = $_POST['cs_img_befor'];
            } else {

                $allowedExts    =   array("jpg,png");
                $temp           =   explode(".", $_FILES["cs_img"]["name"]);
                $source_file    =   $_FILES['cs_img']['tmp_name'];
                $size_file      =   $_FILES['cs_img']['size'];
                $extension      =   end($temp);
                $newfilename    =   'img_' . round(microtime(true)) . '.' . end($temp);

                unlink($file_location . $_POST['cs_img_befor']);
                move_uploaded_file($source_file, $file_location . $newfilename);
            }

            if ($_FILES['cs_cer']['tmp_name'] == "") {

                $newfilename_cer   = $_POST['cs_cer_befor'];
            } else {

                $allowedExts_cer    =   array("jpg,png");
                $temp_cer           =   explode(".", $_FILES["cs_cer"]["name"]);
                $source_file_cer    =   $_FILES['cs_cer']['tmp_name'];
                $size_file_cer      =   $_FILES['cs_cer']['size'];
                $extension_cer      =   end($temp_cer);
                $newfilename_cer    =   'cer_' . round(microtime(true)) . '.' . end($temp_cer);

                unlink($file_location . $_POST['cs_cer_befor']);
                move_uploaded_file($source_file_cer, $file_location . $newfilename_cer);
            }

            $update = $conn->prepare("UPDATE course SET cs_code = :cs_code, 
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
                                                WHERE cs_id = :cs_id
                                ");

            $update->bindParam(':cs_id',  $cs_id);
            $update->bindParam(':cs_code',  $cs_code);
            $update->bindParam(':cs_name',  $cs_name);
            $update->bindParam(':cs_detail',  $cs_detail);
            $update->bindParam(':k_hour',  $k_hour);
            $update->bindParam(':k_minute',  $k_minute);
            $update->bindParam(':cs_pay_status',  $cs_pay_status);
            $update->bindParam(':cs_pay_num',  $cs_pay_num);
            $update->bindParam(':cs_status',  $cs_status);
            $update->bindParam(':cs_for',  $cs_for);
            $update->bindParam(':cs_img',  $newfilename);
            $update->bindParam(':cs_cer',  $newfilename_cer);
            $update->execute();

            if ($update) {

                echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
                exit;
            } else {
                echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                    });
                </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
