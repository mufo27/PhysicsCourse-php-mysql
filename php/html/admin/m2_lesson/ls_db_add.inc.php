<?php

if (isset($_POST['btn_save'])) {

    $sls_name      = $_POST['sls_name'];
    $sls_detail    = $_POST['sls_detail'];
    $sls_youtube   = $_POST['sls_youtube'];
    $sls_refer     = $_POST['sls_refer'];
    $ls_id         = $_POST['btn_save'];
    $ex_id         = $_POST['ex_id'];
    $z_id          = $_POST['z_id'];


    $select = $conn->prepare("SELECT count(*) AS check_num FROM sub_lesson WHERE z_id=:z_id AND sls_name=:sls_name");
    $select->bindParam(':z_id', $z_id);
    $select->bindParam(':sls_name', $sls_name);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row['check_num'] > 0) {

        echo "<script>alert('**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!')</script>";
        echo "<script>window.location='javascript:history.back(-1)';</script>";
        exit;
    } else {

        try {

            $file_location = "sub-lessons/upload/";

            // ใบความรู้รูปภาพ
            if ($_FILES['sls_img']['tmp_name'] == "") {

                $newfilename_img   = "";
            } else {

                $allowedExts_img    =   array("jpg,png");
                $temp_img           =   explode(".", $_FILES["sls_img"]["name"]);
                $source_file_img    =   $_FILES['sls_img']['tmp_name'];
                $size_file_img      =   $_FILES['sls_img']['size'];
                $extension_img      =   end($temp_img);
                $newfilename_img    =   'img_' . round(microtime(true)) . '.' . end($temp_img);

                move_uploaded_file($source_file_img, $file_location . $newfilename_img);
            }

            //ใบความรู้แบบฝึกหัด
            if ($_FILES['sls_sheet']['tmp_name'] == "") {

                $newfilename_sheet = "";
            } else {

                $allowedExts_sheet    =   array("pdf,docx");
                $temp_sheet           =   explode(".", $_FILES["sls_sheet"]["name"]);
                $source_file_sheet    =   $_FILES['sls_sheet']['tmp_name'];
                $size_file_sheet      =   $_FILES['sls_sheet']['size'];
                $extension_sheet      =   end($temp_sheet);
                $newfilename_sheet    =   'sheet_' . round(microtime(true)) . '.' . end($temp_sheet);

                move_uploaded_file($source_file_sheet, $file_location . $newfilename_sheet);
            }

            //ใบความรู้แบบฝึกหัด
            if ($_FILES['sls_answer']['tmp_name'] == "") {

                $newfilename_answer = "";
            } else {

                $allowedExts_answer    =   array("pdf,docx");
                $temp_answer           =   explode(".", $_FILES["sls_answer"]["name"]);
                $source_file_answer    =   $_FILES['sls_answer']['tmp_name'];
                $size_file_answer      =   $_FILES['sls_answer']['size'];
                $extension_answer      =   end($temp_answer);
                $newfilename_answer    =   'answer_' . round(microtime(true)) . '.' . end($temp_answer);

                move_uploaded_file($source_file_answer, $file_location . $newfilename_answer);
            }


            $insert = $conn->prepare("INSERT INTO sub_lesson (sls_name, sls_detail, sls_youtube, sls_refer, sls_img, sls_sheet, sls_answer, ls_id, ex_id, z_id) 
                VALUES (:sls_name, :sls_detail, :sls_youtube, :sls_refer, :sls_img, :sls_sheet, :sls_answer, :ls_id, :ex_id, :z_id)");
            $insert->bindParam(':sls_name',  $sls_name);
            $insert->bindParam(':sls_detail',  $sls_detail);
            $insert->bindParam(':sls_youtube',  $sls_youtube);
            $insert->bindParam(':sls_refer',  $sls_refer);
            $insert->bindParam(':sls_img',  $newfilename_img);
            $insert->bindParam(':sls_sheet',  $newfilename_sheet);
            $insert->bindParam(':sls_answer',  $newfilename_answer);
            $insert->bindParam(':ls_id',  $ls_id);
            $insert->bindParam(':ex_id',  $ex_id);
            $insert->bindParam(':z_id',  $z_id);

            $insert->execute();

            if ($insert) {

                echo '<script type="text/javascript">
                            Swal.fire({
                                title: "สร้างหัวข้อย่อย เรียบร้อย...!!", 
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?sub_lesson=$check_id&ls_name=$ls_name\">";
                exit;
            } else {

                echo "<script>alert('error..!!')</script>";
                echo "<script>window.location='javascript:history.back(-1)';</script>";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }
}
