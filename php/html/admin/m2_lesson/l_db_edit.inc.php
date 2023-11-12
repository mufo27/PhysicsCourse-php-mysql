<?php


if (isset($_POST['btn_update'])) {

    $ls_id     = $_POST['ls_id'];
    $ls_name   = $_POST['ls_name'];
    $ls_detail = $_POST['ls_detail'];

    try {

        $update = $conn->prepare("UPDATE lesson SET ls_name=:ls_name, ls_detail=:ls_detail WHERE ls_id=:ls_id");
        $update->bindParam(':ls_id', $ls_id);
        $update->bindParam(':ls_name', $ls_name);
        $update->bindParam(':ls_detail', $ls_detail);
        $update->execute();

        if ($update) {

            echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "อัพเดทข้อมูล เรียบร้อย...!!", 
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
