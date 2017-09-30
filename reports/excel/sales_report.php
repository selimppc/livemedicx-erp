
<?php
include('../connection/dB.php');
$cm_type = $_GET['cm_type'];
$branch = $_GET['branch'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$c = '';
$b = '';
if($cm_type==false){
  $c = 'All';
}
if($branch==false){
  $b = 'All';
}
$sql = '';
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF();
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Sales Report',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'For : '.$b.' Branch',0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(0,0,'Customer type : '.$c.' Customer',0,0,'L');
  $pdf->Ln(5);
  $pdf->Cell(0,0,'From Date : '.$from_date.' To '. $to_date,0,0,'L');
  $pdf->Ln(5);
  $pdf->SetAutoPageBreak(false);
  // //$pdf->AddPage();
   $y_axis_initial = 20;
   $row_height = 10;
   $pdf->SetFillColor(255, 255, 255);
   $pdf->SetFont('Arial', '', 10);
   $pdf->SetX(10);
   $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
   $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C', 1);
   $pdf->Cell(22, $row_height, 'Quantity sold', 1, 0, 'C', 1);
   $pdf->Cell(29, $row_height, 'Cost Rate (P.P)', 1, 0, 'C', 1);
   $pdf->Cell(29, $row_height, 'Sales Price (P.P)', 1, 0, 'C', 1);
   $pdf->Cell(25, $row_height, 'Mark-up (P.P)', 1, 0, 'C', 1);
   $pdf->Cell(25, $row_height, 'Total mark-up', 1, 0, 'C', 1);
   $pdf->Ln(10);
   $i = 0;
   $max = 14;
   $y_axis = $y_axis_initial + $row_height;
   if($cm_type == true && $branch == true){
     $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE d.cm_group='$cm_type' AND e.cm_branch='$branch' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category") or die(mysql_error());
   }elseif($cm_type == true && $branch == false){
      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE d.cm_group='$cm_type' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
   }elseif($cm_type == false && $branch == true){
      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE e.cm_branch='$branch' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
   }elseif($cm_type == false && $branch == false){
      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
   }
    while($row = mysql_fetch_array($sql)){
       $sm_quantity = $row['sm_quantity'];
       $cm_costprice = $row['cm_costprice'];
        $cm_sellrate = $row['cm_sellrate'];
        $mark = $cm_sellrate-$cm_costprice;
        $total = $mark * $cm_costprice;
      if ($i == $max){
          $pdf->Ln(10);
          $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
          $pdf->AddPage();
          $pdf->SetY($y_axis_initial);
          $pdf->SetX(10);
          $pdf->SetFont('Arial', '', 10);
          $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
         $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C', 1);
         $pdf->Cell(22, $row_height, 'Quantity sold', 1, 0, 'C', 1);
         $pdf->Cell(29, $row_height, 'Cost Rate (P.P)', 1, 0, 'C', 1);
         $pdf->Cell(29, $row_height, 'Sales Price (P.P)', 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, 'Mark-up (P.P)', 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, 'Total mark-up', 1, 0, 'C', 1);
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
       $pdf->Cell(28, $row_height, $row['cm_code'], 1, 0, 'C', 1);
       $pdf->Cell(120, $row_height, $row['proname'], 1, 0, 'C', 1);
       $pdf->Cell(22, $row_height, $sm_quantity, 1, 0, 'C', 1);
       $pdf->Cell(29, $row_height, $cm_costprice, 1, 0, 'C', 1);
       $pdf->Cell(29, $row_height, $cm_sellrate, 1, 0, 'C', 1);
       $pdf->Cell(25, $row_height, $mark, 1, 0, 'C', 1);
       $pdf->Cell(25, $row_height, $total, 1, 0, 'C', 1);
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
       }
 
  $pdf->Output();

  }elseif(isset($_POST["export_excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  $output.='
  <table class="table table-bordered">
    <tr>
      <th colspan="7" align="center"><h2>Sales Report</h2></th>  
    </tr>
    <tr>
      <th colspan="7" align="center"><h3>For : '.$b.'</h3></th>
    </tr>
    <tr>
      <th align="center"><h3>Customer type : '.$c.'</h3></th>  
    </tr>
    <tr>
      <th align="center"><h3>From: '.$from_date.' To: '.$to_date.'</h3></th>  
    </tr>
    <tr>
      <th style="border:1px solid #000; text-align:center">Code</th>
      <th style="border:1px solid #000; text-align:center">Product Name</th>
      <th style="border:1px solid #000; text-align:center">Quantity sold</th>
      <th style="border:1px solid #000; text-align:center">Cost rate (per product)</th>
      <th style="border:1px solid #000; text-align:center">Sales price (per product)</th>
      <th style="border:1px solid #000; text-align:center">Mark-up (per product)</th>
      <th style="border:1px solid #000; text-align:center">Total mark-up</th>
    </tr>
  ';
  $sql = '';

  if($cm_type == true && $branch == true){
    $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE d.cm_group='$cm_type' AND e.cm_branch='$branch' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
  }elseif($cm_type == true && $branch == false){
    $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE d.cm_group='$cm_type' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
  }elseif($cm_type == false && $branch == true){
    $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE e.cm_branch='$branch' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
  }elseif($cm_type == false && $branch == false){
    $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
  }
  while($row = mysql_fetch_array($sql)){
    $sm_quantity = $row['sm_quantity'];
    $cm_costprice = $row['cm_costprice'];
    $cm_sellrate = $row['cm_sellrate'];
    $mark = $cm_sellrate-$cm_costprice;
    $total = $mark * $cm_costprice;
    $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['proname'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$sm_quantity.'</td>
          <td style="border:1px solid #000; text-align:center">'.$cm_costprice.'</td>
          <td style="border:1px solid #000; text-align:center">'.$cm_sellrate.'</td>
          <td style="border:1px solid #000; text-align:center">'.$mark.'</td>
          <td style="border:1px solid #000; text-align:center">'.$total.'</td>
        </tr>
        ';
  }
  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Sales Report.xls");  
    echo $output;  
  }



?>