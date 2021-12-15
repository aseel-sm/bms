<?php
require('fpdf.php');


// Page footer


// Instanciation of inherited class
$pdf = new FPDF('P','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->Image('favicon.png',80,5,15);
$pdf->SetFont('Arial','B',15);


$pdf->Cell(80);

// Title
$pdf->Cell(30,20,'Title',0,0,);
// Line break
$pdf->Ln(20);





$pdf->SetFont('Arial','',12);

$pdf->Cell(130,5,'MG Road',1,0,);
$pdf->Cell(59,5,'',1,1);

$pdf->Cell(130,5,'Pbvr, EKM, Kerala',1,0,);
$pdf->Cell(25,5,'Date:',1,0);
$pdf->Cell(34,5,'02/11/2020',1,1);

$pdf->Cell(130,5,'Phone: 920718150',1,0,);
$pdf->Cell(25,5,'Invoice No:',1,0);
$pdf->Cell(34,5,'896987',1,1);


$pdf->Cell(130,5,'Name:',1,0,);
$pdf->Cell(25,5,'Customer ID:',1,0);
$pdf->Cell(34,5,'9633931093',1,1);


$pdf->Cell(189,10,'',1,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,5,'Sl.No',1,0);
$pdf->Cell(94,5,'Product',1,0);
$pdf->Cell(25,5,'Unit Price',1,0);
$pdf->Cell(25,5,'Quanity',1,0);
$pdf->Cell(25,5,'Amount',1,1);

$pdf->SetFont('Arial','',12);



//
$pdf->Cell(20,5,'1',1,0);
$pdf->Cell(94,5,'Frock',1,0);
$pdf->Cell(25,5,'880',1,0,'R');
$pdf->Cell(25,5,'2',1,0,'R');
$pdf->Cell(25,5,'666',1,1,'R');


$pdf->Cell(20,5,'1',1,0);
$pdf->Cell(94,5,'Frock',1,0);
$pdf->Cell(25,5,'880',1,0,'R');
$pdf->Cell(25,5,'2',1,0,'R');
$pdf->Cell(25,5,'666',1,1,'R');


$pdf->Cell(20,5,'1',1,0);
$pdf->Cell(94,5,'Frock',1,0);
$pdf->Cell(25,5,'880',1,0,'R');
$pdf->Cell(25,5,'2',1,0,'R');
$pdf->Cell(25,5,'666',1,1,'R');


$pdf->Cell(20,5,'1',1,0);
$pdf->Cell(94,5,'Frock',1,0);
$pdf->Cell(25,5,'880',1,0,'R');
$pdf->Cell(25,5,'2',1,0,'R');
$pdf->Cell(25,5,'666',1,1,'R');


$pdf->Cell(20,5,'1',1,0);
$pdf->Cell(94,5,'Frock',1,0);
$pdf->Cell(25,5,'880',1,0,'R');
$pdf->Cell(25,5,'2',1,0,'R');
$pdf->Cell(25,5,'666',1,1,'R');


////



$pdf->Cell(139,5,'1',1,0);
$pdf->Cell(25,5,'Wallet',1,0,'R');
$pdf->Cell(25,5,'0',1,1,'R');


$pdf->Cell(139,5,'1',1,0);
$pdf->Cell(25,5,'Discount',1,0,'R');
$pdf->Cell(25,5,'0',1,1,'R');


$pdf->Cell(139,5,'1',1,0);
$pdf->Cell(25,5,'Total',1,0,'R');
$pdf->Cell(25,5,'0',1,1,'R');

$pdf->Output();





?>