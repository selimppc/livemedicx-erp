
<?php
include('../connection/dB.php');
$psmnumber = $_GET['psmnumber'];
                $sql = mysql_query("SELECT * FROM `sm_header`,`cm_customermst`,`cm_branchmaster` WHERE (sm_header.cm_cuscode=cm_customermst.cm_cuscode) AND (sm_header.sm_storeid=cm_branchmaster.cm_branch) AND  sm_header.sm_number='$psmnumber'") or die(mysql_error());
                $row = mysql_fetch_array($sql);
                $cm_cuscode = $row['cm_cuscode'];

                $sm_storeid = $row['sm_storeid'];
				$sqlf=mysql_query("SELECT * from cm_customermst where cm_cuscode='$cm_cuscode'");
				$res=mysql_fetch_array($sqlf);
				
$gid=$res['gerant_id'];
//print_r($gid);


$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',22);
  //$pdf->Cell(80);
  $pdf->Cell(0,10,'Delivery Note',0,0,'C');
  $pdf->SetLineWidth(0.5);
  $pdf->Line(10,20,286,20);
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 20;
  $row_height = 10;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->SetY($y_axis_initial);
    $pdf->Cell(200, $row_height, 'To,', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(30, $row_height, 'Invoice Number '.$psmnumber.' ', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell(200, $row_height, ' ', 0, 0, 'L');
    $pdf->Cell(70, $row_height, 'From,', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell(100, $row_height, $sm_storeid.' '.$row['cm_description'].'', 0, 0, 'R');
    $pdf->Cell(20, $row_height, $row['sm_date'], -20, 0, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(25, $row_height, $cm_cuscode.' ', 0, 0, 'L');
    $pdf->Cell(56, $row_height, ' '.$row['cm_name'].'', 0, 0, 'L');
    $pdf->Ln(5);
    $pdf->Cell(10, $row_height, $row['cm_address'], 0, 0, 'L');
//     $pdf->Line(10,60,286,60);
     $pdf->Ln(10);
//     $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(25,$row_height,'Sl.',1,0,'C',0);  
    $pdf->Cell(110,$row_height,'Product Name',1,0,'C',0);  
    $pdf->Cell(30,$row_height,'Code',1,0,'C',0);  
    $pdf->Cell(30,$row_height,'Batch',1,0,'C',0);  
    $pdf->Cell(30,$row_height,'Expiry Date',1,0,'C',0);  
    $pdf->Cell(25,$row_height,'Quantity',1,0,'C',0);  
    $pdf->Cell(25,$row_height,'Unit',1,0,'C',0);
    $pdf->Ln(10);
    $query = mysql_query("SELECT * FROM `sm_batchsale`,`cm_productmaster` WHERE (sm_batchsale.cm_code=cm_productmaster.cm_code) AND sm_batchsale.sm_number='$psmnumber'");
    $i = 1;
    $no = $i;
    while($r = mysql_fetch_array($query)){
    $pdf->Cell(25,$row_height,$no++,1,0,'C',0);  
    $pdf->Cell(110,$row_height,$r['cm_name'],1,0,'C',0);  
    $pdf->Cell(30,$row_height,$r['sm_number'],1,0,'C',0);  
    $pdf->Cell(30,$row_height,$r['cm_code'],1,0,'C',0); 
    $pdf->Cell(30,$row_height,$r['sm_expdate'],1,0,'C',0); 
    $pdf->Cell(25,$row_height,$r['sm_quantity'],1,0,'C',0);  
    $pdf->Cell(25,$row_height,$r['sm_unit'],1,0,'C',0);
    $pdf->Ln(10);
    }  
   $sum = mysql_query("SELECT SUM(sm_quantity) AS total FROM sm_batchsale WHERE sm_number='$psmnumber'");
    $sr = mysql_fetch_array($sum);
    $pdf->Ln(30);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(195,$row_height,'',0,0,'C',0);
    $pdf->Cell(25,$row_height,'Total',0,0,'C',0);
    $pdf->Cell(25,$row_height,$sr['total'],0,0,'C',0);
$pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 

  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
        <table class="table table-bordered" width="900">
        <tr>
          <td align="center">Delivery Note</td>
        </tr>
                    <tr>
                      <th>'.$cm_cuscode.'</th>
                    </tr>
                    <tr>
                      <td>'.$row['cm_name'].'</td>
                    </tr>
                    <tr>
                      <td>'.$row['cm_address'].'</td>
                    </tr>
                    <tr>
                      <td> Invoice Number '.$psmnumber.'</td>
                    </tr>
					 <tr>
                      <td> GerantID:'.$gid.'</td>
                    </tr>
                    <tr>
                      <td>From,</td>
                      <td>'.$sm_storeid.' &nbsp; '.$row['cm_description'].' &nbsp; '.$row['sm_date'].'</td>
                    </tr> 
					<tr>
					  <td>GerantID</td>
					  <td>'.$gid.'</td>
					</tr>
                    <tr>
                      <th style="border-bottom:2px solid #000">Sl.</th>
                      <th style="border-bottom:2px solid #000">Product Name</th>
                      <th style="border-bottom:2px solid #000">Code</th>
                      <th style="border-bottom:2px solid #000">Batch</th>
                      <th style="border-bottom:2px solid #000">Expiry Date</th>
                      <th style="border-bottom:2px solid #000">Quantity</th>               
                      <th style="border-bottom:2px solid #000">Unit</th>
                    </tr>
                ';  
                $query = mysql_query("SELECT * FROM `sm_batchsale`,`cm_productmaster` WHERE (sm_batchsale.cm_code=cm_productmaster.cm_code) AND sm_batchsale.sm_number='$psmnumber'");
                  $i = 1;
                  $no = $i;
                   while($r = mysql_fetch_array($query)){
                    $output.='
                    <tr>
                      <td>'.$no++.'</td>
                      <td>'.$r['cm_name'].'</td>
                      <td>'.$r['sm_number'].'</td>
                      <td>'.$r['cm_code'].'</td>
                      <td>'.$r['sm_expdate'].'</td>
                      <td>'.$r['sm_quantity'].'</td>
                      <td>'.$r['sm_unit'].'</td>
                    </tr>
                    ';
                  }
                    $sum = mysql_query("SELECT SUM(sm_quantity) AS total FROM sm_batchsale WHERE sm_number='$psmnumber'");
                  $sr = mysql_fetch_array($sum);
                  $output.='
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <th style="border-top:2px solid #000">Total Qty</th>
                      <th style="border-top:2px solid #000">'.$sr['total'].'</th>
                      <td></td>
                    </tr>
                  ';
                   
    }  

    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Delivery Note.xls");  
    echo $output;  
  }
 
?>