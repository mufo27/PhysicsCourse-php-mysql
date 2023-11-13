<?php

$ls_id = $_GET['lesson_sub'];

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

if (isset($_GET['btn_filter'])) {

    if ($_GET['fd_sls_id'] === '' && $_GET['fd_sls_name'] === '' && $_GET['fd_per_page'] === '') {

        echo '<script type="text/javascript">
                Swal.fire({
                icon: "error",
                title: "ล้มเหลว",
                text: "ต้องเลือกอย่างน้อย 1 รายการ"
                });
            </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson_sub=$ls_id\">";
        exit;
    } else {

        if ($_GET['fd_per_page'] !== '' && $_GET['fd_per_page'] !== 'all') {
            $per_page = intval($_GET['fd_per_page']);
        } else if ($_GET['fd_per_page'] === 'all') {
            $sql_v_all = $conn->prepare("SELECT COUNT(*) FROM lesson l");
            $sql_v_all->execute();
            $per_page = $sql_v_all->fetchColumn();
        } else {
            $per_page = 5;
        }

        $fd_sls_id = trim($_GET['fd_sls_id']);
        $fd_sls_name = trim($_GET['fd_sls_name']);

        $start_from = ($page - 1) * $per_page;

        $sql_all = "SELECT COUNT(*) 
                    FROM sub_lesson sls 
                        INNER JOIN exercises ex ON sls.ex_id = ex.ex_id 
                        INNER JOIN quiz qz ON sls.z_id = qz.z_id 
                    WHERE sls.ls_id = :ls_id";

        $sql = "SELECT sls.*, ex.ex_name AS exe_name, qz.z_name AS qz_name  
                FROM sub_lesson sls 
                    INNER JOIN exercises ex ON sls.ex_id = ex.ex_id 
                    INNER JOIN quiz qz ON sls.z_id = qz.z_id 
                WHERE sls.ls_id = :ls_id";

        if ($_GET['fd_sls_id'] !== '') {
            $sql_all .= " AND sls.sls_id LIKE :fd_sls_id ";
            $sql .= " AND sls.sls_id LIKE :fd_sls_id ";
        }
        if ($_GET['fd_sls_name'] !== '') {
            $sql_all .= " AND sls.sls_name LIKE :fd_sls_name ";
            $sql .= " AND sls.sls_name LIKE :fd_sls_name ";
        }

        $sql .= " LIMIT :start_from, :per_page ";

        $select_all = $conn->prepare($sql_all);
        $select = $conn->prepare($sql);

        if ($_GET['fd_sls_id'] !== '') {
            $fd_sls_id = '%' . $_GET['fd_sls_id'] . '%';
            $select_all->bindParam(':fd_sls_id', $fd_sls_id, PDO::PARAM_STR);
            $select->bindParam(':fd_sls_id', $fd_sls_id, PDO::PARAM_STR);
        }
        if ($_GET['fd_sls_name'] !== '') {
            $fd_sls_name = '%' . $_GET['fd_sls_name'] . '%';
            $select_all->bindParam(':fd_sls_name', $fd_sls_name, PDO::PARAM_STR);
            $select->bindParam(':fd_sls_name', $fd_sls_name, PDO::PARAM_STR);
        }

        $select_all->bindParam(':ls_id', $ls_id, PDO::PARAM_INT);
        $select->bindParam(':ls_id', $ls_id, PDO::PARAM_INT);
        $select->bindParam(':start_from', $start_from, PDO::PARAM_INT);
        $select->bindParam(':per_page', $per_page, PDO::PARAM_INT);

        $select_all->execute();
        $select->execute();

        $total_records = $select_all->fetchColumn();
        $total_pages = ceil($total_records / $per_page);

        if ($_GET['fd_per_page'] === '') {
            $s_per_page = '-- เลือก --';
            $v_per_page = '';
        } else if ($_GET['fd_per_page'] === 'all') {
            $s_per_page = 'ทั้งหมด';
            $v_per_page = 'all';
        } else {
            $s_per_page = $_GET['fd_per_page'];
            $v_per_page = $_GET['fd_per_page'];
        }

        if ($_GET['fd_sls_id'] === '') {
            $v_sls_id = '';
        } else {
            $v_sls_id = $_GET['fd_sls_id'];
        }

        if ($_GET['fd_sls_name'] === '') {
            $v_sls_name = '';
        } else {
            $v_sls_name = $_GET['fd_sls_name'];
        }
    }
} else {

    $per_page = 5;

    $start_from = ($page - 1) * $per_page;

    $select_all = $conn->prepare("SELECT COUNT(*) 
                                    FROM sub_lesson sls 
                                        INNER JOIN exercises ex ON sls.ex_id = ex.ex_id 
                                        INNER JOIN quiz qz ON sls.z_id = qz.z_id 
                                    WHERE sls.ls_id = :ls_id");
    $select_all->bindParam(':ls_id', $ls_id, PDO::PARAM_INT);
    $select_all->execute();
    $total_records = $select_all->fetchColumn();

    $total_pages = ceil($total_records / $per_page);

    $select = $conn->prepare("SELECT sls.*, ex.ex_name AS exe_name, qz.z_name AS qz_name  
                                        FROM sub_lesson sls 
                                            INNER JOIN exercises ex ON sls.ex_id = ex.ex_id 
                                            INNER JOIN quiz qz ON sls.z_id = qz.z_id 
                                        WHERE sls.ls_id = :ls_id 
                                        LIMIT :start_from, :per_page");
    $select->bindParam(':ls_id', $ls_id, PDO::PARAM_INT);
    $select->bindParam(':start_from', $start_from, PDO::PARAM_INT);
    $select->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $select->execute();

    $s_per_page = '-- เลือก --';
    $v_per_page = '';

    $v_sls_id = '';

    $v_sls_name = '';
}

$select_check_ls_name = $conn->prepare("SELECT ls_name FROM lesson l WHERE l.ls_id = :ls_id");
$select_check_ls_name->bindParam(':ls_id', $ls_id, PDO::PARAM_INT);
$select_check_ls_name->execute();
$row_ls_name = $select_check_ls_name->fetch(PDO::FETCH_ASSOC);