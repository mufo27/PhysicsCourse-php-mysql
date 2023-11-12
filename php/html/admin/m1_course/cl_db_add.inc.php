<?php
if(isset($_POST['btn_save'])){

    $check = $_POST['check'];
    $check_cs_id = $_POST['btn_save'];
    $check_ls_id = $_POST['ls_id'];

    if (empty($check) || $check == 0) {

        echo '<script type="text/javascript">
                Swal.fire({
                icon: "error",
                title: "ล้มเหลว",
                text: "โปรด ต้องเลือกอย่างน้อย 1 รายการ"
                });
            </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course_lesson=$check_cs_id\">";
        exit;

    } else {

        try {
            
            foreach ($check as $key) {
                $insert = $conn->prepare("INSERT INTO course_lesson (cs_id, ls_id) VALUES (:cs_id, :ls_id)");
                $insert->bindParam(':cs_id'     ,  $check_cs_id); 
                $insert->bindParam(':ls_id'     ,  $check_ls_id[$key]); 
                $insert->execute();
            }
            if ($insert) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "บันทึกข้อมูล เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course_lesson=$check_cs_id\">";
                exit;

            } else {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "error",
                            title: "error..!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=course&course_lesson=$check_cs_id\">";
                exit;

            }  

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    
}
