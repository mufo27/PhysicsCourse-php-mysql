<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">ลงชื่อเข้าใช้งาน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">ชื่อผู้ใช้งาน <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="" name="username" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">รหัสผ่าน <small class="text-danger">*</small></label>
                            <input type="password" class="form-control" id="" name="password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="btn_login">เข้าสู่ระบบ</button>
                    <button type="reset" class="btn btn-secondary">ล้าง</button>
                </div>
            </div>
        </form>

    </div>
</div>

<?php
    if (isset($_POST['btn_login'])) {

        $username  =  $_POST['username'];
        $password  =  $_POST['password'];

        try {

            $select_login =  $conn->prepare("SELECT id, username, password, status, concat(pkname,'',fname,' ',lname) as fullname 
                                            FROM users 
                                            WHERE username = :user AND password = :pass
                                            UNION ALL
                                            SELECT id, username, password, status, concat(pkname,'',fname,' ',lname) as fullname 
                                            FROM admins 
                                            WHERE username = :user AND password = :pass
                                            ");

            $select_login->bindParam(':user'  ,  $username);
            $select_login->bindParam(':pass'  ,  $password);
            $select_login->execute();

            if ($select_login->rowCount() > 0) {

                $row_login = $select_login->fetch(PDO::FETCH_ASSOC);

                if ($row_login['username'] === $username && $row_login['password'] === $password && $row_login['status'] !== null) {
                            
                  if($row_login['status'] == 0 || $row_login['status'] == 1){

                      $_SESSION['id']      = $row_login['id'];
                      $_SESSION['fullname']  = $row_login['fullname'];
                      $_SESSION['status']    = $row_login['status'];

                      if($row_login['status'] == 0){
                        $text = 'สมาชิก';
                      }
                      if($row_login['status'] == 1){
                        $text = 'นักเรียน';
                      }
                      
                      echo '<script type="text/javascript">
                              Swal.fire({
                                icon: "success",
                                title: "เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ '.$text.'", 
                                showConfirmButton: false,
                                timer: 2000
                              });
                            </script>';
                      echo "<meta http-equiv=\"refresh\" content=\"3; URL=student/index.php\">";
                      exit;

                  } else if($row_login['status'] == 2){

                    $_SESSION['id']      = $row_login['id'];
                    $_SESSION['fullname']  = $row_login['fullname'];
                    $_SESSION['status']    = $row_login['status'];

                      echo '<script type="text/javascript">
                              Swal.fire({
                                icon: "success",
                                title: "เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ Admin", 
                                showConfirmButton: false,
                                timer: 2000
                              });
                            </script>';
                      echo "<meta http-equiv=\"refresh\" content=\"3; URL=admin/index.php\">";
                      exit;

                  } else {

                          echo '<script type="text/javascript">
                                  Swal.fire(
                                    "Error User status ?",
                                    "ติดต่อ Admin",
                                    "question"
                                  );
                                </script>';
                          echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
                          exit;

                      }

                } else {

                  echo '<script type="text/javascript">
                          Swal.fire(
                            "Error Code?",
                            "ติดต่อผู้พัฒนาโปรแกรม",
                            "question"
                          );
                        </script>';
                  echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
                  exit;

                }

            } else {

                echo '<script type="text/javascript">
                        Swal.fire({
                          icon: "error",
                          title: "ล้มเหลว",
                          text: "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง..!!"
                        });
                      </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
                exit;
            }

        } catch (PDOException $e) {

          $e->getMessage();

        }
                     
    }
?>
