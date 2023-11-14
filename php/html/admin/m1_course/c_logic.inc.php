<?php

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

if (isset($_GET['btn_filter'])) {

    if ($_GET['fd_cs_code'] === '' && $_GET['fd_cs_name'] === '' && $_GET['fd_cs_for'] === '' && $_GET['fd_cs_pay_status'] === '' && $_GET['fd_cs_status'] === '' && $_GET['fd_cs_status'] === '' && $_GET['fd_per_page'] === '') {

        displayMessage("error", "Error", "ต้องเลือกอย่างน้อย 1 รายการ", "?active=course&course");

    } else {

        if ($_GET['fd_per_page'] !== '' && $_GET['fd_per_page'] !== 'all') {
            $per_page = intval($_GET['fd_per_page']);
        } else if ($_GET['fd_per_page'] === 'all') {
            $sql_v_all = $conn->prepare("SELECT COUNT(*) FROM course c");
            $sql_v_all->execute();
            $per_page = $sql_v_all->fetchColumn();
        } else {
            $per_page = 5;
        }

        $fd_cs_code = trim($_GET['fd_cs_code']);
        $fd_cs_name = trim($_GET['fd_cs_name']);
        $fd_cs_for = $_GET['fd_cs_for'];
        $fd_cs_pay_status = $_GET['fd_cs_pay_status'];
        $fd_cs_status = $_GET['fd_cs_status'];

        $start_from = ($page - 1) * $per_page;

        $sql_all = "SELECT COUNT(*) FROM course c 
                    WHERE 1=1";

        $sql = "SELECT 
                    c.*,
                    (SELECT count(cs_id) FROM course_lesson cl WHERE cl.cs_id = c.cs_id) AS check_count_in_cl,
                    (SELECT count(cs_id) FROM course_register cr WHERE cr.cs_id = c.cs_id) AS check_count_in_cr 
                FROM course c 
                WHERE 1=1";

        if ($_GET['fd_cs_code'] !== '') {
            $sql_all .= " AND c.cs_code LIKE :fd_cs_code ";
            $sql .= " AND c.cs_code LIKE :fd_cs_code ";
        }
        if ($_GET['fd_cs_name'] !== '') {
            $sql_all .= " AND c.cs_name LIKE :fd_cs_name ";
            $sql .= " AND c.cs_name LIKE :fd_cs_name ";
        }
        if ($_GET['fd_cs_for'] !== '' && $_GET['fd_cs_for'] !== 'all') {
            $sql_all .= " AND c.cs_for = :fd_cs_for ";
            $sql .= " AND c.cs_for = :fd_cs_for ";
        }
        if ($_GET['fd_cs_pay_status'] !== '' && $_GET['fd_cs_pay_status'] !== 'all') {
            $sql_all .= " AND c.cs_pay_status = :fd_cs_pay_status ";
            $sql .= " AND c.cs_pay_status = :fd_cs_pay_status ";
        }
        if ($_GET['fd_cs_status'] !== '' && $_GET['fd_cs_status'] !== 'all') {
            $sql_all .= " AND c.cs_status = :fd_cs_status ";
            $sql .= " AND c.cs_status = :fd_cs_status ";
        }

        $sql .= " LIMIT :start_from, :per_page ";

        $select_all = $conn->prepare($sql_all);
        $select = $conn->prepare($sql);

        if ($_GET['fd_cs_code'] !== '') {
            $fd_cs_code = '%' . $_GET['fd_cs_code'] . '%';
            $select_all->bindParam(':fd_cs_code', $fd_cs_code, PDO::PARAM_STR);
            $select->bindParam(':fd_cs_code', $fd_cs_code, PDO::PARAM_STR);
        }
        if ($_GET['fd_cs_name'] !== '') {
            $fd_cs_name = '%' . $_GET['fd_cs_name'] . '%';
            $select_all->bindParam(':fd_cs_name', $fd_cs_name, PDO::PARAM_STR);
            $select->bindParam(':fd_cs_name', $fd_cs_name, PDO::PARAM_STR);
        }
        if ($_GET['fd_cs_for'] !== '' && $_GET['fd_cs_for'] !== 'all') {
            $select_all->bindParam(':fd_cs_for', $_GET['fd_cs_for'], PDO::PARAM_INT);
            $select->bindParam(':fd_cs_for', $_GET['fd_cs_for'], PDO::PARAM_INT);
        }
        if ($_GET['fd_cs_pay_status'] !== '' && $_GET['fd_cs_pay_status'] !== 'all') {
            $select_all->bindParam(':fd_cs_pay_status', $_GET['fd_cs_pay_status'], PDO::PARAM_INT);
            $select->bindParam(':fd_cs_pay_status', $_GET['fd_cs_pay_status'], PDO::PARAM_INT);
        }
        if ($_GET['fd_cs_status'] !== '' && $_GET['fd_cs_status'] !== 'all') {
            $select_all->bindParam(':fd_cs_status', $_GET['fd_cs_status'], PDO::PARAM_INT);
            $select->bindParam(':fd_cs_status', $_GET['fd_cs_status'], PDO::PARAM_INT);
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
        }else {
            $s_per_page = $_GET['fd_per_page'];
            $v_per_page = $_GET['fd_per_page'];
        }

        if ($_GET['fd_cs_code'] === '') {
            $v_cs_code = '';
        } else {
            $v_cs_code = $_GET['fd_cs_code'];
        }

        if ($_GET['fd_cs_name'] === '') {
            $v_cs_name = '';
        } else {
            $v_cs_name = $_GET['fd_cs_name'];
        }

        if ($_GET['fd_cs_for'] === '') {
            $s_cs_for = '-- เลือก --';
            $v_cs_for = '';
        } else if ($_GET['fd_cs_for'] === 'all') {
             $s_cs_for = 'ทั้งหมด';
             $v_cs_for = 'all';
        }else {
            $s_cs_for = getGradeText($_GET['fd_cs_for']);
            $v_cs_for = $_GET['fd_cs_for'];
        }

        if ($_GET['fd_cs_pay_status'] === '') {
            $s_cs_pay_status = '-- เลือก --';
            $v_cs_pay_status = '';
        } else if ($_GET['fd_cs_pay_status'] === 'all') {
            $s_cs_pay_status = 'ทั้งหมด';
            $v_cs_pay_status = 'all';
        }else {
            $s_cs_pay_status = getPayStatusText($_GET['fd_cs_pay_status']);
            $v_cs_pay_status = $_GET['fd_cs_pay_status'];
        }

        if ($_GET['fd_cs_status'] === '') {
            $s_cs_status = '-- เลือก --';
            $v_cs_status = '';
        } else if ($_GET['fd_cs_status'] === 'all') {
             $s_cs_status = 'ทั้งหมด';
             $v_cs_status = 'all';
        }else {
            $s_cs_status = getStatusText($_GET['fd_cs_status']);
            $v_cs_status = $_GET['fd_cs_status'];
        }

        
    }
} else {

    $per_page = 5;

    $start_from = ($page - 1) * $per_page;

    $select_all = $conn->prepare("SELECT COUNT(*) FROM course c");
    $select_all->execute();
    $total_records = $select_all->fetchColumn();

    $total_pages = ceil($total_records / $per_page);

    $select = $conn->prepare("SELECT 
                                    c.*,
                                    (SELECT count(cs_id) FROM course_lesson cl WHERE cl.cs_id = c.cs_id) AS check_count_in_cl,
                                    (SELECT count(cs_id) FROM course_register cr WHERE cr.cs_id = c.cs_id) AS check_count_in_cr
                            FROM course c
                            LIMIT :start_from, :per_page");
    $select->bindParam(':start_from', $start_from, PDO::PARAM_INT);
    $select->bindParam(':per_page', $per_page, PDO::PARAM_INT);
    $select->execute();


    $s_per_page = '-- เลือก --';
    $v_per_page = '';

    $v_cs_code = '';

    $v_cs_name = '';
    
    $s_cs_for = '-- เลือก --';
    $v_cs_for = '';
    
    $s_cs_pay_status = '-- เลือก --';
    $v_cs_pay_status = '';
    
    $s_cs_status = '-- เลือก --';
    $v_cs_status = '';

    
}


