<?php

if (isset($_POST['btn_del'])) {


    $check_ls_id = $_POST['btn_del'];

    try {

        $delete_cl = $conn->prepare("DELETE FROM course_lesson WHERE ls_id = :ls_id");
        $delete_cl->bindParam(':ls_id', $check_ls_id);
        $delete_cl->execute();

        $delete_l = $conn->prepare("DELETE FROM lesson WHERE ls_id = :ls_id");
        $delete_l->bindParam(':ls_id', $check_ls_id);
        $delete_l->execute();

        if ($delete_cl && $delete_l) {

            echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "ลบข้อมูล เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson\">";
            exit;
        } else {

            echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                        });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson\">";
            exit;
        }
    } catch (PDOException $e) {

        echo $e->getMessage();
    }
}
