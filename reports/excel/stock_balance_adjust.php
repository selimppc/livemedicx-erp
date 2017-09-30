
<?php
include('../connection/dB.php');
$first_word = $_GET['first_word'];
$date = $_GET['date'];
$sql = mysql_query("SELECT * FROM `im_adjusthd` WHERE branch='$first_word' AND DATE='$date'") or die(mysql_error());
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Stock Balance after Adjustment',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'For '.$first_word,0,0,'C');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(0,0,'As at '.$date,0,0,'C');
  $pdf->Ln(10);
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 30;
  $y_axis_initial2 = 40;
  $row_height = 18;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(35, $row_height, 'code', 1, 0, 'C', 1);
  $pdf->Cell(100, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(65, $row_height, 'Batch Number', 1, 0, 'C', 1);
  $y = $pdf->GetY();
  $x = $pdf->GetX(); 
  $y4 = $pdf->GetY();
  $x4 = $pdf->GetX();
  $width = 20;
  $width4 = 20;
  $pdf->MultiCell($width, 6, 'Before Adjustment Quantity', 1,0, 'C', 1);
  $pdf->SetXY($x + $width, $y);
  $y2 = $pdf->GetY();
  $x2 = $pdf->GetX();
  $width2 = 20;
  $pdf->MultiCell($width2, 6, 'Positive Adjustment Quantity', 1,0, 'C', FALSE);
  $pdf->SetXY($x2 + $width2, $y2);
  $y3 = $pdf->GetY();
  $x3 = $pdf->GetX();
  $width3 = 20;
  $pdf->MultiCell($width3, 6, 'Negative Adjustment Quantity', 1, 'C', FALSE);
  $pdf->SetXY($x3 + $width3, $y3);
  $pdf->MultiCell($width4, 6, 'After Adjustment Quantity', 1, 'C', FALSE);
  $pdf->SetXY($x4 + $width4, $y4);
  $pdf->Ln(10);
  $i = 0;
  $max = 6;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
    $transaction_number = $row['transaction_number'];
    $type = $row['adjustment_type'];
    $query = mysql_query("SELECT * FROM `im_adjustdt` WHERE transaction_number='$transaction_number'");
    $rr = mysql_fetch_array($query);
    $product_code = $rr['product_code'];
    $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$product_code'");
    $r = mysql_fetch_array($query2);
    $positive = '';
    $negative = '';
    if($type=='1'){
      $positive = $rr['quantity'];
    }elseif($type=='-1'){
      $negative = $rr['quantity'];
    }else{
    }
    if($positive==false){
      $positive = '0';
    }elseif($negative==false){
      $negative = '0';
    }
    if ($i == $max){
      $pdf->Ln(10);
      $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(35, $row_height, 'code', 1, 0, 'C', 1);
  $pdf->Cell(100, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(65, $row_height, 'Batch Number', 1, 0, 'C', 1);
  $y = $pdf->GetY();
  $x = $pdf->GetX(); 
  $y4 = $pdf->GetY();
  $x4 = $pdf->GetX();
  $width = 20;
  $width4 = 20;
  $pdf->MultiCell($width, 6, 'Before Adjustment Quantity', 1,0, 'C', 1);
  $pdf->SetXY($x + $width, $y);
  $y2 = $pdf->GetY();
  $x2 = $pdf->GetX();
  $width2 = 20;
  $pdf->MultiCell($width2, 6, 'Positive Adjustment Quantity', 1,0, 'C', FALSE);
  $pdf->SetXY($x2 + $width2, $y2);
  $y3 = $pdf->GetY();
  $x3 = $pdf->GetX();
  $width3 = 20;
  $pdf->MultiCell($width3, 6, 'Negative Adjustment Quantity', 1, 'C', FALSE);
  $pdf->SetXY($x3 + $width3, $y3);
  $pdf->MultiCell($width4, 6, 'After Adjustment Quantity', 1, 'C', FALSE);
  $pdf->SetXY($x4 + $width4, $y4);
  $pdf->Ln(10);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height;
      
    }
    $pdf->Ln(8);
  $pdf->Cell(35, $row_height, $rr['product_code'], 1, 0, 'C', 1);
  $pdf->Cell(100, $row_height, $r['cm_name'], 1, 0, 'L', 1);
  $pdf->Cell(65, $row_height, $rr['batch_number'], 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, $positive, 1,0, 'C', 1);
  $pdf->Cell(20, $row_height, '', 1,0, 'C', 1);
  $pdf->Cell(20, $row_height, '', 1, 0,'C', 1);
  $pdf->Cell(20, $row_height, $negative, 1,0, 'C', 1);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
  $pdf->Ln(8);
  }
  $pdf->Output();
  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
    
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Stock Balance Report</h2><br>
          <h3 class="text-center">For '.$first_word.'</h3>
          <h5 class="text-center">As at  '.$date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Product code</th>
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Batch Number</th>
          <th style="border:1px solid #000; text-align:center">Before Adjustment Quantity </th>
          <th style="border:1px solid #000; text-align:center">Positive Adjustment Quantity </th>
          <th style="border:1px solid #000; text-align:center">Negative Adjustment Quantity </th>
          <th style="border:1px solid #000; text-align:center">After Adjustment Quantity</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            $transaction_number = $row['transaction_number'];
    $type = $row['adjustment_type'];
    $query = mysql_query("SELECT * FROM `im_adjustdt` WHERE transaction_number='$transaction_number'");
    $rr = mysql_fetch_array($query);
    $product_code = $rr['product_code'];
    $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$product_code'");
    $r = mysql_fetch_array($query2);
    $positive = '';
    $negative = '';
    if($type=='1'){
      $positive = $rr['quantity'];
    }elseif($type=='-1'){
      $negative = $rr['quantity'];
    }else{
    }
    if($positive==false){
      $positive = '0';
    }elseif($negative==false){
      $negative = '0';
    }
            if(mysql_num_rows($sql) > 0)  
    {
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$rr['product_code'].'</td>
              <td style="border:1px solid #000; text-align:left">'.$r['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$rr['batch_number'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$positive.'</td>
               <td style="border:1px solid #000; text-align:center"></td>
                <td style="border:1px solid #000; text-align:center"></td>
              <td style="border:1px solid #000; text-align:center">'.$negative.'</td>
            </tr>  
                ';  
    }  
    }
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Stock Balance Report.xls");  
    echo $output;  
  

}  

?>