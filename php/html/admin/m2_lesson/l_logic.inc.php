<?php
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

if (isset($_GET['btn_filter'])) {

    if ($_GET['fd_ls_id'] === '' && $_GET['fd_ls_name'] === '' && $_GET['fd_per_page'] === '') {

        echo '<script type="text/javascript">
                Swal.fire({
                icon: "error",
                title: "ล้มเหลว",
                text: "ต้องเลือกอย่างน้อย 1 รายการ"
                });
            </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=?active=lesson&lesson\">";
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

        $fd_ls_id = trim($_GET['fd_ls_id']);
        $fd_ls_name = trim($_GET['fd_ls_name']);

        $start_from = ($page - 1) * $per_page;

        $sql_all = "SELECT COUNT(*) FROM lesson l 
                    WHERE 1=1";

        $sql = "SELECT 
                    l.*, 
                    (SELECT count(ls_id)  FROM sub_lesson sb WHERE sb.ls_id = l.ls_id) AS check_count_in_sls,
                    (SELECT count(ls_id)  FROM course_lesson cl WHERE cl.ls_id = l.ls_id) AS check_count_in_cl
                FROM lesson l
                WHERE 1=1";

        if ($_GET['fd_ls_id'] !== '') {
            $sql_all .= " AND l.ls_id LIKE :fd_ls_id ";
            $sql .= " AND l.ls_id LIKE :fd_ls_id ";
        }
        if ($_GET['fd_ls_name'] !== '') {
            $sql_all .= " AND l.ls_name LIKE :fd_ls_name ";
            $sql .= " AND l.ls_name LIKE :fd_ls_name ";
        }

        $sql .= " LIMIT :start_from, :per_page ";

        $select_all = $conn->prepare($sql_all);
        $select = $conn->prepare($sql);

        if ($_GET['fd_ls_id'] !== '') {
            $fd_ls_id = '%' . $_GET['fd_ls_id'] . '%';
            $select_all->bindParam(':fd_ls_id', $fd_ls_id, PDO::PARAM_STR);
            $select->bindParam(':fd_ls_id', $fd_ls_id, PDO::PARAM_STR);
        }
        if ($_GET['fd_ls_name'] !== '') {
            $fd_ls_name = '%' . $_GET['fd_ls_name'] . '%';
            $select_all->bindParam(':fd_ls_name', $fd_ls_name, PDO::PARAM_STR);
            $select->bindParam(':fd_ls_name', $fd_ls_name, PDO::PARAM_STR);
        }

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

        if ($_GET['fd_ls_id'] === '') {
            $v_ls_id = '';
        } else {
            $v_ls_id = $_GET['fd_ls_id'];
        }

        if ($_GET['fd_ls_name'] === '') {
            $v_ls_name = '';
        } else {
            $v_ls_name = $_GET['fd_ls_name'];
        }
    }
} else {


    $per_page = 5;

    $start_from = ($page - 1) * $per_page;

    $select_all = $conn->prepare("SELECT COUNT(*) FROM lesson l");
    $select_all->execute();
    $total_records = $select_all->fetchColumn();

    $total_pages = ceil($total_records / $per_page);

    $select = $conn->prepare("SELECT 
                                l.*, 
                                (SELECT count(ls_id)  FROM sub_lesson sb WHERE sb.ls_id = l.ls_id) AS check_count_in_sls,
                                (SELECT count(ls_id)  FROM course_lesson cl WHERE cl.ls_id = l.ls_id) AS check_count_in_cl
                            FROM lesson l
                            LIMIT :start_from, :per_page");
    $select->bindParam(':start_from', $start_from, PDO::PARAM_INT);
    $select->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $select->execute();


    $s_per_page = '-- เลือก --';
    $v_per_page = '';

    $v_ls_id = '';

    $v_ls_name = '';
}
