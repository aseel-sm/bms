<?php
session_start();
$flag=isset($_SESSION['authenticate'])?true:false;
$flag2=isset($_COOKIE['username'])?true:false;
if($flag2)
{
$flag2=$_COOKIE['username']==$_GET['cid']?true:false;
}
if( $flag){
    if ($flag2 || $_SESSION['user']=='admin' ) {

        require('fpdf.php');
        require('../dbconnect.php');
        $id=$_GET['id'];
      
        
        $sql="SELECT * from invoice WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1)
            $row=mysqli_fetch_array($result);
        
      
        $items=$row['items'];
          $item_data=json_decode($items,true);
        
        
        
        
        
        $pdf = new FPDF('P','mm','A4');
        
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Image('favicon.png',77,7,10);
        $pdf->SetFont('Arial','B',15);
        
        
        
        $pdf->Cell(189,8,'Lorem Botique','B',1,'C');
        $pdf->Image('favicon.png',122,7,10);
        // Title
        $pdf->Cell(189,10,'Invoice',0,1,'C');
        // Line break
        
        
        
        
        
        
        $pdf->SetFont('Arial','',12);
        
        $pdf->Cell(130,5,'MG Road',0,0,);
        $pdf->Cell(59,5,'',0,1);
        
        $pdf->Cell(85,5,'Pbvr, EKM, Kerala',0,0,);
        $pdf->Cell(27,5,'Date:',0,0);
        $pdf->Cell(77,5,date("d F Y h:i:s A", strtotime($row['date'])),0,1);
        
        $pdf->Cell(85,5,'Phone: 920718150',0,0,);
        $pdf->Cell(27,5,'Invoice No:',0,0);
        $pdf->Cell(77,5,'LBINV'.$row['id'],0,1);
        
        
        $pdf->Cell(85,5,'Name: '.$row['name'],0,0,);
        $pdf->Cell(27,5,'Customer ID: ',0,0);
        $pdf->Cell(77,5,$row['customer_id'],0,1);
        
        //heads
        $pdf->Cell(189,10,'',0,1);
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(20,5,'Sl.No',1,0);
        $pdf->Cell(94,5,'Product',1,0);
        $pdf->Cell(25,5,'Unit Price',1,0);
        $pdf->Cell(25,5,'Quanity',1,0);
        $pdf->SetFont('Arial','B',8);
        
        $pdf->Cell(25,5,'Amount(incl.tax)',1,1);
        
        $pdf->SetFont('Arial','',12);
        //items
        
        
        $i=1;
        function print_item($data){
            global $conn;
            global $i;
           global $pdf;
            $id=$data[0];
            $stock=$data[1];
        
            $sql="SELECT `name` from  product WHERE id='$id'";
            $result=mysqli_query($conn,$sql);
           $product=mysqli_fetch_assoc($result);
           $pdf->Cell(20,5,$i,1,0);
        $pdf->Cell(94,5,$product['name'],1,0);
        $pdf->Cell(25,5,$data[2],1,0,'R');
        $pdf->Cell(25,5,$stock,1,0,'R');
        $pdf->Cell(25,5,($stock*$data[2]),1,1,'R');
        $i++;
        }
        
        array_map("print_item",$item_data);
        
        
        //
        
        ////
        
        $pdf->Cell(189,5,'',0,1);
        
        $pdf->Cell(139,5,'',0,0);
        $pdf->Cell(25,5,'Sub Total',1,0,'R');
        $pdf->Cell(25,5,"Rs. ".($row['amount']+$row['wallet']+$row['discount']),1,1,'R');
        
        $pdf->Cell(139,5,'',0,0);
        $pdf->Cell(25,5,'Wallet',1,0,'R');
        $pdf->Cell(25,5,"Rs. ".$row['wallet'],1,1,'R');
        
        
        $pdf->Cell(139,5,'',0,0);
        $pdf->Cell(25,5,'Discount',1,0,'R');
        $pdf->Cell(25,5,"Rs. ".$row['discount'],1,1,'R');
        
        
        $pdf->Cell(139,5,'',0,0);
        $pdf->Cell(25,5,'Total',1,0,'R');
        $pdf->Cell(25,5,"Rs. ".$row['amount'],1,1,'R');
        
        
        $pdf->Output();
        
       
     
    }
    else 
    {
header("Location:../../index.php");
    }
}








?>