
<?php
include('../connection/dB.php');
$final_f_word = $_GET['final_f_word'];
$from_date = $_GET['from_date'];
$sql = mysql_query("SELECT * FROM `im_vw_stock` WHERE im_storeid='$final_f_word'") or die(mysql_error());
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Stock Balance Report',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'For '.$final_f_word,0,0,'C');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(0,0,'As at '.$from_date,0,0,'C');
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 40;
  $y_axis_initial2 = 40;
  $row_height = 12;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(30, $row_height, 'Product code', 1, 0, 'C', 1);
  $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(48, $row_height, 'Expiry Date', 1, 0, 'C', 1);
  $pdf->Cell(45, $row_height, 'Batch Number', 1, 0, 'C', 1);
  $pdf->Cell(35, $row_height, 'Quantity', 1, 0, 'C', 1);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
    $pdf->SetLineWidth(0.5);
    if ($i == $max){
      $pdf->Ln(10);
      $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial2);
      $pdf->SetX(10);
      $pdf->Cell(30, $row_height, 'Product code', 1, 0, 'C', 1);
      $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C', 1);
      $pdf->Cell(48, $row_height, 'Expiry Date', 1, 0, 'C', 1);
      $pdf->Cell(45, $row_height, 'Batch Number', 1, 0, 'C', 1);
      $pdf->Cell(35, $row_height, 'Quantity', 1, 0, 'C', 1);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height;
      
    }
    $pdf->Ln(10);
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(30, $row_height, $row['cm_code'], 0, 0, 'C', 0);
    $pdf->Cell(120, $row_height, $row['cm_name'], 0, 0, 'L', 0);
    $pdf->Cell(48, $row_height, $row['im_BatchNumber'], 0, 0, 'L', 0);
    $pdf->Cell(45, $row_height, $row['im_ExpireDate'], 0, 0, 'C', 0);
    $pdf->Cell(35, $row_height, $row['available'], 0, 0, 'R', 0);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
  }
  $pdf->Output();
  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Stock Balance Report</h2><br>
          <h3 class="text-center">For '.$final_f_word.'</h3>
          <h5 class="text-center">As at  '.$from_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Product code</th>
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Batch Number</th>
          <th style="border:1px solid #000; text-align:center">Expiry Date</th>
          <th style="border:1px solid #000; text-align:center">Quantity</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
              <td style="border:1px solid #000; text-align:left">'.$row['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['im_BatchNumber'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['im_ExpireDate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['available'].'</td>
            </tr>  
                ';  
    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Stock Balance Report.xls");  
    echo $output;  
  }

}  

?>