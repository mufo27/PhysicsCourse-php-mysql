<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">สมัครสมาชิก</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">คำนำหน้า <small class="text-danger">*</small></label>
                            <select class="form-select" id="" name="pkname" required>
                                <option selected disabled value="">-- เลือก --</option>
                                <option value="ด.ช.">ด.ช.</option>
                                <option value="ด.ญ.">ด.ญ.</option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option> 
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">ชื่อจริง <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="" name="fname" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">นามสกุล <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="" name="lname" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationDefault04" class="form-label">ระดับชั้น <small class="text-danger">*</small></label>
                            <select class="form-select" id="" name="level" required>
                                <option selected disabled value="">-- เลือก --</option>
                                <option value="1">ม.1</option>
                                <option value="2">ม.2</option>
                                <option value="3">ม.3</option>
                                <option value="4">ม.4</option>
                                <option value="5">ม.5</option>
                                <option value="6">ม.6</option>
                                <option value="7">ป.ตรี</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">โรงเรียน <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="" name="school" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">จังหวัด <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="" name="city" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">อายุ <small class="text-danger">*</small></label>
                            <input type="number" class="form-control" id="" name="age" min="0" max="99" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">เบอร์โทร <small class="text-danger">*</small></label>
                            <input type="phone" class="form-control" id="" name="phone" maxlength="10" placeholder="ใส่ตัวเลขไม่เกิน 10 ตัว" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">อีเมล <small class="text-danger">*</small></label>
                            <input type="email" class="form-control" id="" name="email" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">ชื่อผู้ใช้งาน <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="" name="username" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">รหัสผ่าน <small class="text-danger">*</small></label>
                            <input type="password" class="form-control" id="" name="password" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="" class="form-label">ยืนยันรหัสผ่าน <small class="text-danger">*</small></label>
                            <input type="password" class="form-control" id="" name="confirm_password" required>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="" name="accept" value="1"  required>
                                <label class="form-check-label" for="">
                                    ยอมรับข้อตกลงของเว็บไซต์จะมีการเก็บของมูลของสมาชิกไว้ เพื่อใช้ในการออกใบรับเกียรติบัตร
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btn_register">ยืนยันการลงะทะเบียน</button>
                    <button type="reset" class="btn btn-secondary">ล้าง</button>
                </div>
            </div>
        </form>

    </div>
</div>

<?php

if (isset($_POST['btn_register'])) {

    $pkname             =   $_POST['pkname'];
    $fname              =   $_POST['fname'];
    $lname              =   $_POST['lname'];
    $level              =   $_POST['level'];
    $school             =   $_POST['school'];
    $city               =   $_POST['city'];
    $age                =   $_POST['age'];
    $phone              =   $_POST['phone'];
    $email              =   $_POST['email'];
    $username           =   $_POST['username'];
    $password           =   $_POST['password'];
    $confirm_password   =   $_POST['confirm_password'];
    $accept             =   $_POST['accept'];
    $status             =   0;

    if ($password != $confirm_password) {

        echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "ยันยืนรหัสไม่ตรงกัน..!!"
                    });
                </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
        exit;
    } else {

        $select = $conn->prepare("SELECT count(id) AS check_num FROM users WHERE pkname=:pkname AND fname=:fname AND lname=:lname");
        $select->bindParam(':pkname', $pkname);
        $select->bindParam(':fname', $fname);
        $select->bindParam(':lname', $lname);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['check_num'] > 0) {

            echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!."
                        });
                    </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
            exit;
        } else {

            try {

                $insert = $conn->prepare("INSERT INTO users 
                    (pkname, fname, lname, email, age, phone, level, school, city, username, password, status, accept) 
                    VALUES 
                    (:pkname, :fname, :lname, :email, :age, :phone, :level, :school, :city, :username, :password, :status, :accept)");
                $insert->bindParam(':pkname',  $pkname);
                $insert->bindParam(':fname',  $fname);
                $insert->bindParam(':lname',  $lname);
                $insert->bindParam(':level',  $level);
                $insert->bindParam(':school',  $school);
                $insert->bindParam(':city',  $city);
                $insert->bindParam(':age',  $age);
                $insert->bindParam(':phone',  $phone);
                $insert->bindParam(':email',  $email);
                $insert->bindParam(':username',  $username);
                $insert->bindParam(':password',  $password);
                $insert->bindParam(':accept',  $accept);
                $insert->bindParam(':status',  $status);
                $insert->execute();

                if ($insert) {

                    echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "ลงทะเบียน เรียบร้อย...!!", 
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                Swal.fire({
                                icon: "error",
                                title: "ล้มเหลว",
                                text: "error..!!"
                                });
                            </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
                    exit;
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    }
}



?>