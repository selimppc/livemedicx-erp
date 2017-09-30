
<?php
include('../connection/dB.php');
$ptrnnumber = $_GET['ptrnnumber'];
$sql = mysql_query("SELECT * FROM `im_adjusthd` WHERE `transaction_number`='$ptrnnumber'") or die(mysql_error());
                $ro = mysql_fetch_array($sql);
                $adjustment_type = $ro['adjustment_type'];
                $type = '';
                if($adjustment_type<0){
                  $type = 'Negative Adjustment';
                }else{
                  $type = 'Posative Adjustment';
                }
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',20);
  //$pdf->Cell(80);
  $pdf->Cell(0,10,'Stock Adjustment Report',0,0,'L');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,10,$ptrnnumber,0,0,'L');
  $pdf->Ln(5);
  $pdf->Cell(0,10,$ro['DATE'],0,0,'L');
  $pdf->Ln(5);
  $pdf->Cell(0,10,$type,0,0,'L');
  $pdf->Cell(0,10,'Currency: '.$ro['currency'].$ro['exchange_rate'],0,0,'R');
  $pdf->Ln(10);
  $pdf->Cell(40,10,'Product Code',1,0,'C',0);
  $pdf->Cell(120,10,'Product Name',1,0,'C',0);
  $pdf->Cell(35,10,'Batch Number',1,0,'C',0);
  $pdf->Cell(30,10,'Expiry Date',1,0,'C',0);
  $pdf->Cell(30,10,'Quantity',1,0,'C',0);
  $pdf->Cell(20,10,'Unit',1,0,'C',0);
  $pdf->Ln(10);
  $sq = mysql_query("SELECT * FROM `im_adjustdt`,`cm_productmaster` WHERE (im_adjustdt.product_code=cm_productmaster.cm_code) AND  im_adjustdt.transaction_number='$ptrnnumber'");
  while($row= mysql_fetch_array($sq)){
    $pdf->Cell(40,10,$row['product_code'],1,0,'C',0);
  $pdf->Cell(120,10,$row['cm_name'],1,0,'C',0);
  $pdf->Cell(35,10,$row['batch_number'],1,0,'C',0);
  $pdf->Cell(30,10,$row['expirry_date'],1,0,'C',0);
  $pdf->Cell(30,10,$row['quantity'],1,0,'C',0);
  $pdf->Cell(20,10,$row['unit'],1,0,'C',0);
  $pdf->Ln(10);
  }
  $pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 

        if(mysql_num_rows($sql) > 0)  
    {
      $output .= '  
      <table class="table">  
        <tr>  
          <th align="Center" colspan="6"><h2><u>Stock Adjustment Report</u></h2></th>    
        </tr> 
        <tr>  
          <th align="left" colspan="6">'.$ptrnnumber.'</th>
        </tr>
        <tr>
          <th align="left" colspan="6">'.$ro['DATE'].'</th>
        </tr>
        <tr>
          <th align="left" colspan="6">'.$type.'</th>
        </tr> 
        <tr>
          <th>Currency</th>
          <th colspan="5">'.$ro['currency'].'&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$ro['exchange_rate'].'</th>
        </tr>
        <tr>
          <th style="border:1px solid #000">Code</th>
          <th style="border:1px solid #000">Product Name</th>
          <th style="border:1px solid #000">Batch Number</th>
          <th style="border:1px solid #000">Expiry Date</th>
          <th style="border:1px solid #000">Quantity</th>
          <th style="border:1px solid #000">Unit</th>
        </tr>
           ';  
      $sq = mysql_query("SELECT * FROM `im_adjustdt`,`cm_productmaster` WHERE (im_adjustdt.product_code=cm_productmaster.cm_code) AND  im_adjustdt.transaction_number='$ptrnnumber'");

       while($row= mysql_fetch_array($sq)){ 
          
              
            $output .= '  
            <tr>
                      <td>'.$row['product_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td>'.$row['batch_number'].'</td>
                      <td>'.$row['expirry_date'].'</td>
                      <td>'.$row['quantity'].'</td>
                      <td>'.$row['unit'].'</td>
                    </tr>';
          }
          
         }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Stock_Adjustment.xls");  
    echo $output;  

}  
mysql_query("DELETE  FROM `jurnal_sum`") or die(mysql_error());
?>