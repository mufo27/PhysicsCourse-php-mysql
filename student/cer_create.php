
<?php

require_once('../config/con_db.php');
require_once('../fpdf/fpdf.php');

$cs_id = $_GET['cs'];
$u_id = $_GET['us'];

$stmt1 = $conn->prepare("SELECT cs_name, cs_cer FROM course WHERE cs_id=:cs_id ");
$stmt1->bindParam(':cs_id',  $cs_id);
$stmt1->execute();
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT concat(pkname,'',fname,' ',lname) as fullname FROM users WHERE id=:id ");
$stmt2->bindParam(':id',  $u_id);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

$pdf = new FPDF();

$pdf->AliasNbPages();
$pdf->AddFont('IBMPlexSansThaiLooped-Bold', 'B', 'IBMPlexSansThaiLooped-Bold.php');

$pdf->AddPage('L', 'A4');

$pdf->Image('../admin/course/upload/'.$row1['cs_cer'],0,0,0);
$pdf->SetXY(40,90);
$pdf->SetFont('IBMPlexSansThaiLooped-Bold', 'B', 40);
$pdf->Cell(190, 10, iconv('UTF-8', 'cp874',$row2['fullname']), 0, 0, 'C');
$pdf->SetXY(20,113);
$pdf->SetFont('IBMPlexSansThaiLooped-Bold', 'B', 18);
$pdf->Cell(230, 10, iconv('UTF-8', 'cp874',$row1['cs_name']), 0, 0, 'C');
$pdf->Ln(8);


$pdf->Output();

// mysql_close($conn);

?>
