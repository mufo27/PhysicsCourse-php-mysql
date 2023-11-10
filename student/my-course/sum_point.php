<?php 
    require_once '../config/con_db.php';

    if(isset($_GET['sum_point'])){

        $check_id = $_GET['sum_point'];
        $back = $_GET['back'];

        $select = $conn->prepare("SELECT sls_id, sls_name, z_id FROM sub_lesson WHERE sls_id = :check_id");
        $select->bindParam(':check_id',  $check_id); 
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        $select_qz = $conn->prepare("SELECT * FROM quiz WHERE z_id = :z_id");
        $select_qz->bindParam(':z_id',  $row['z_id']);
        $select_qz->execute();
        $row_qz = $select_qz->fetch(PDO::FETCH_ASSOC);
                                
    }
 
?>



<div class="row">

    <div class="col s12 m1"></div>

    <div class="col s12 m10">

        <div class="section">

            <div class="row">
                <div class="pt-1 pb-0" id="breadcrumbs-wrapper">

                    <div class="container">
                        <div class="row">
                            <div class="col s12 m3 l3">
                                <h5 class="breadcrumbs-title"><span>แบบทดสอบ : <?=  $row['z_id']; ?></span></h5>
                            </div>
                            <div class="col s12 m9 l9 right-align-md">
                                <ol class="breadcrumbs mb-0">
                                    <li class="breadcrumb-item">คอร์สเรียนของฉัน</li>
                                    <li class="breadcrumb-item">คอร์สเรียน : </li>
                                    <li class="breadcrumb-item">บทเรียน : </li>
                                    <li class="breadcrumb-item">หัวข้อย่อย : <?=  $row['sls_name']; ?></li>
                                    <li class="breadcrumb-item">แบบทดสอบ : <?=  $row['z_id']; ?></li>
                                    <li class="breadcrumb-item">เริ่ม</li>
                                    <li class="breadcrumb-item active">สรุปคะแนน</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">

                <div class="col s12 m12">
                    <div class="card">
                        <div class="card-content">
                            <h4><I>รายงานผลแบบทดสอบ</I></h4>

                            <table class="bordered centered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>รายการ</th>
                                        <th>ข้อสอบทั้งหมด</th>
                                        <th>ตอบถูก</th>
                                        <th>ตอบผิด</th>
                                        <th>เกณฑ์ผ่าน</th>
                                        <th>ทำข้อสอบได้</th>
                                        <th>สรุป</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>ด้าน K</td>
                                        <td>10</td>
                                        <td>8</td>
                                        <td>2</td>
                                        <td>70%</td>
                                        <td>80%</td>
                                        <td>ผ่าน</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>ด้าน P</td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>5</td>
                                        <td>70%</td>
                                        <td>75%</td>
                                        <td>ผ่าน</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mt-3">
                                <div class="col s12">
                                    <a href="#" class="btn btn-block btn-large red">
                                        เสร็จสิ้น
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- <div class="row mt-5">
                <div class="input-field col s12">
                    <a class="btn btn-small red right" href="?cr_display=<?= $back; ?>&show=<?= $check_id; ?>">ย้อนกลับ
                        <i class="material-icons left">reply</i>
                    </a>
                </div>
            </div> -->


        </div>


    </div>

    <div class="col s12 m1"></div>

</div>

<div class="row mt-5"></div>