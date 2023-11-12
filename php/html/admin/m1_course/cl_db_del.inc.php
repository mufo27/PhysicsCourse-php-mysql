<?php
if (isset($_POST['btn_del'])) {

    $check_csl_id = $_POST['btn_del'];
    $check_cs_id = $_POST['cs_id'];

    try {

        $delete_t1 = $conn->prepare("DELETE FROM course_lesson WHERE csl_id = :check_id");
        $delete_t1->bindParam(':check_id' , $check_csl_id);
        $delete_t1->execute();

        if ($delete_t1->execute()) {

            echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "ลบข้อมูลทิ้ง เรียบร้อย...!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?course_lesson=$check_cs_id\">";
            exit;

        } else {

            echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                    });
                </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=?course_lesson=$check_cs_id\">";
            exit;

        }

    } catch (PDOException $e) {

        echo $e->getMessage();

    }

}
