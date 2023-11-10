<?php

$select_sub = $conn->prepare("SELECT sls_id FROM sub_lesson WHERE ls_id=:ls_id");
$select_sub->bindParam(':ls_id',  $ls_id);  
$select_sub->execute();

$sub_total = 0;
$pg_total = 0;
$status_total = 0;

$ptg_learn = 0;
$ptg_exe   = 0;
$ptg_quiz  = 0;

while($row_sub = $select_sub->fetch(PDO::FETCH_ASSOC)){

    $sub_total++;

    $sls_id = $row_sub['sls_id'];
    $u_id = $_SESSION['id'];

    $select_count_pg = $conn->prepare("SELECT count(*) as pg_num FROM progress WHERE sls_id=:sls_id AND u_id=:u_id");
    $select_count_pg->bindParam(':sls_id',  $sls_id); 
    $select_count_pg->bindParam(':u_id'  ,  $u_id);  
    $select_count_pg->execute();
    $row_count_pg = $select_count_pg->fetch(PDO::FETCH_ASSOC);

    if($row_count_pg['pg_num'] === 1){
        $pg_total++;
    } else {
        $pg_total = $pg_total;
    }

    $select_status = $conn->prepare("SELECT count(*) as status_num FROM ex_status WHERE sls_id=:sls_id AND u_id=:u_id");
    $select_status->bindParam(':sls_id', $sls_id);  
    $select_status->bindParam(':u_id' ,  $u_id);  
    $select_status->execute();
    $row_status = $select_status->fetch(PDO::FETCH_ASSOC);

    if($row_status['status_num'] === 1){
        $status_total++;
    } else {
        $status_total = $status_total;
    }

    
}

$ptg_learn = ($pg_total * 100) / $sub_total;
$ptg_exe   = ($status_total * 100) / $sub_total;
$ptg_quiz  = ($status_total * 100) / $sub_total;
 
$check_learn += $ptg_learn;
$check_exe   += $ptg_exe ;
$check_quiz  += $ptg_exe ;
?>