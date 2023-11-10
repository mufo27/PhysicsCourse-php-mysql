<?php

$check_id = $_SESSION['id'];
$select_pro = $conn->prepare("SELECT * FROM users WHERE id=:id");
$select_pro->bindParam(':id',  $check_id);
$select_pro->execute();
$row_pro = $select_pro->fetch(PDO::FETCH_ASSOC);

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">ข้อมูลส่วนตัว</li>
    </ol>
</nav>

<div class="align-items-center p-2 my-3 text-white rounded shadow-sm  bg-purple">
    <div class="lh-1">
        <h1 class="h1 mb-0 text-white lh-1">ข้อมูลส่วนตัว (Profile)</h1>
    </div>
</div>

<div class="card h-100">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12 mb-3">

                    <img src="upload/<?= $row_pro['photo']; ?>" alt="" class="" height="150" width="150">

                </div>
                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">รูปโปรไฟล์</label>
                    <input type="file" class="form-control" id="" name="photo" value="">
                    <input type="hidden" class="form-control" id="" name="photo2" value="<?= $row_pro['photo'] ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">คำนำหน้า*</label>
                    <select class="form-select" id="" name="pkname" required>
                        <option selected value="<?= $row_pro['pkname'] ?>">-- <?= $row_pro['pkname'] ?> --</option>
                        <option value="ด.ช.">ด.ช.</option>
                        <option value="ด.ญ.">ด.ญ.</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="นางสาว">นางสาว</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">ชื่อจริง</label>
                    <input type="text" class="form-control" id="" name="fname" value="<?= $row_pro['fname'] ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="" name="lname" value="<?= $row_pro['lname'] ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">ชื่อเล่น</label>
                    <input type="text" class="form-control" id="" name="nkname" value="<?= $row_pro['nkname'] ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault04" class="form-label">ระดับชั้น</label>
                    <select class="form-select" id="" name="level" required>
                        <option selected value="<?= $row_pro['level'] ?>">-- ม.<?= $row_pro['level'] ?> --</option>
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
                    <label for="" class="form-label">โรงเรียน</label>
                    <input type="text" class="form-control" id="" name="school" value="<?= $row_pro['school'] ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">จังหวัด</label>
                    <input type="text" class="form-control" id="" name="city" value="<?= $row_pro['city'] ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">อายุ</label>
                    <input type="number" class="form-control" id="" name="age" min="0" max="99" value="<?= $row_pro['age'] ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">เบอร์โทร</label>
                    <input type="phone" class="form-control" id="" name="phone" maxlength="10" placeholder="ใส่ตัวเลขไม่เกิน 10 ตัว" value="<?= $row_pro['phone'] ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="" name="email" value="<?= $row_pro['email'] ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">ชื่อผู้ใช้งาน</label>
                    <input type="text" class="form-control" id="" name="username" value="<?= $row_pro['username'] ?>" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">รหัสผ่าน</label>
                    <input type="text" class="form-control" id="" name="password" value="<?= $row_pro['password'] ?>" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning" name="btn_update" value="<?= $check_id; ?>">บันทึกการเปลี่ยนแปลง</button>
            <button type="reset" class="btn btn-secondary">ล้าง</button>
        </div>
    </form>
</div>

<?php

if (isset($_POST['btn_update'])) {

    $id         = $_POST['btn_update'];
    $pkname     = $_POST['pkname'];
    $fname      = $_POST['fname'];
    $lname      = $_POST['lname'];
    $nkname     = $_POST['nkname'];
    $level      = $_POST['level'];
    $school     = $_POST['school'];
    $city       = $_POST['city'];
    $age        = $_POST['age'];
    $phone      = $_POST['phone'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];

    try {

        $file_location  = "upload/";

        if ($_FILES['photo']['tmp_name'] == "") {

            $newfilename   = $_POST['photo2'];
        } else {

            $allowedExts    =   array("jpg,png");
            $temp           =   explode(".", $_FILES["photo"]["name"]);
            $source_file    =   $_FILES['photo']['tmp_name'];
            $size_file      =   $_FILES['photo']['size'];
            $extension      =   end($temp);
            $newfilename    =   'ph_' . round(microtime(true)) . '.' . end($temp);

            unlink($file_location . $_POST['photo2']);
            move_uploaded_file($source_file, $file_location . $newfilename);
        }

        $update = $conn->prepare("UPDATE users SET pkname = :pkname, 
                                                    fname    = :fname, 
                                                    lname    = :lname, 
                                                    nkname   = :nkname, 
                                                    level    = :level,
                                                    school   = :school,
                                                    city     = :city,
                                                    age      = :age,
                                                    phone    = :phone, 
                                                    email    = :email, 
                                                    username = :username, 
                                                    password = :password,
                                                    photo = :photo

                                                    WHERE id = :id
                                    ");

        $update->bindParam(':id'        ,  $id);
        $update->bindParam(':pkname'    ,  $pkname);
        $update->bindParam(':fname'     ,  $fname);
        $update->bindParam(':lname'     ,  $lname);
        $update->bindParam(':nkname'    ,  $nkname);
        $update->bindParam(':level'     ,  $level);
        $update->bindParam(':school'    ,  $school);
        $update->bindParam(':city'      ,  $city);
        $update->bindParam(':age'       ,  $age);
        $update->bindParam(':phone'     ,  $phone);
        $update->bindParam(':email'     ,  $email);
        $update->bindParam(':username'  ,  $username);
        $update->bindParam(':password'  ,  $password);
        $update->bindParam(':photo'     ,  $newfilename);
        $update->execute();

        if ($update) {

            echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "บันทึกข้อมูล เรียบร้อย...!!", 
                            showConfirmButton: false,
                            timer: 2000
                        });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php?profile\">";
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

?>