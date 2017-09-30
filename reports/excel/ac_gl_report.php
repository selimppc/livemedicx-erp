
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$s_word = $_GET['s_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$c = '';
if($s_word==false){
  $c = 'All';
}
$sq = mysql_query("SELECT * FROM am_chartofaccounts WHERE am_accountcode='$f_word'");
$rsq = mysql_fetch_array($sq);
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
  $pdf->Cell(0,0,'GL Account Report',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'GL Account : '.$rsq['am_description'],0,0,'C');
  $pdf->Ln(5);
  $pdf->Cell(0,0,'For : '.$c.' Branch',0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(0,0,'From Date : '.$from_date.' To '. $to_date,0,0,'L');
  $pdf->Ln(5);
  $pdf->SetAutoPageBreak(false);
  // //$pdf->AddPage();
   $y_axis_initial = 20;
   $row_height = 10;
   $pdf->SetFillColor(255, 255, 255);
   $pdf->SetFont('Arial', '', 10);
   $pdf->SetX(10);
   $pdf->Cell(28, $row_height, 'GL Account Code', 1, 0, 'C', 1);
   $pdf->Cell(70, $row_height, 'GL Account Description', 1, 0, 'C', 1);
   $pdf->Cell(30, $row_height, 'Transaction Code', 1, 0, 'C', 1);
   $pdf->Cell(25, $row_height, 'Date', 1, 0, 'C', 1);
   $pdf->Cell(20, $row_height, 'Currency', 1, 0, 'C', 1);
   $pdf->Cell(25, $row_height, 'Exchange Rate', 1, 0, 'C', 1);
   $pdf->Cell(20, $row_height, 'Debit', 1, 0, 'C', 1);
   $pdf->Cell(20, $row_height, 'Credit', 1, 0, 'C', 1);
   $pdf->Cell(20, $row_height, 'Debit local', 1, 0, 'C', 1);
   $pdf->Cell(20, $row_height, 'Credit local', 1, 0, 'C', 1);
   $pdf->Ln(10);
   $i = 0;
   $max = 14;
   $y_axis = $y_axis_initial + $row_height;
   if($s_word==false){
     $sql = mysql_query("SELECT * FROM `am_balance` WHERE c_accountcode='$f_word' AND c_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
   }else{
      $sql = mysql_query("SELECT * FROM `am_balance` WHERE c_accountcode='$f_word' AND c_date BETWEEN '$from_date' AND '$to_date' AND c_branch='$s_word'");
   }
    while($r = mysql_fetch_array($sql)){
       $c_vouchernumber = $r['c_vouchernumber'];
       $c_date = $r['c_date'];
       $query = mysql_query("SELECT * FROM `am_vw_voucher` WHERE am_vouchernumber='$c_vouchernumber'");
       while($row = mysql_fetch_array($query)){
        $exchagerate = $row['am_exchagerate'];
        $debet_local = $row['prime_debit'] * $exchagerate;
        $credit_local = $row['prime_credit'] * $exchagerate;
        if($i == $max){
          $pdf->Ln(10);
          $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
          $pdf->AddPage();
          $pdf->SetY($y_axis_initial);
          $pdf->SetX(10);
          $pdf->SetFont('Arial', '', 10);
          $pdf->Cell(28, $row_height, 'GL Account Code', 1, 0, 'C', 1);
         $pdf->Cell(70, $row_height, 'GL Account Description', 1, 0, 'C', 1);
         $pdf->Cell(30, $row_height, 'Transaction Code', 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, 'Date', 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, 'Currency', 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, 'Exchange Rate', 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, 'Debit', 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, 'Credit', 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, 'Debit local', 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, 'Credit local', 1, 0, 'C', 1);
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
        $pdf->Cell(28, $row_height, $row['am_accountcode'], 1, 0, 'C', 1);
         $pdf->Cell(70, $row_height, $row['am_description'], 1, 0, 'C', 1);
         $pdf->Cell(30, $row_height, $row['am_vouchernumber'], 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, $c_date, 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, $row['am_currency'], 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, $row['am_exchagerate'], 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, $row['prime_debit'], 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, $row['prime_credit'], 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, $debet_local, 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, $credit_local, 1, 0, 'C', 1);
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
       }
 }
  $pdf->Output();

  }elseif(isset($_POST["export_excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  $output.='
  <table class="table table-bordered">
    <tr>
      <th colspan="10" align="center"><h2>GL Account Report</h2></th>  
    </tr>
    <tr>
      <th colspan="10" align="center"><h3>GL Account : '.$rsq['am_description'].'</h3></th>
    </tr>
    <tr> 
      <th colspan="10" align="center"><h3>For : '.$s_word.'</h3></th>
    </tr>
    <tr> 
      <th colspan="10" align="center"><h3>From: '.$from_date.' To: '.$to_date.'</h3></th> 
    </tr>
    <tr>
      <th style="border:1px solid #000; text-align:center">GL Account Code</th>
      <th style="border:1px solid #000; text-align:center">GL Account Description</th>
      <th style="border:1px solid #000; text-align:center">Transaction Code</th>
      <th style="border:1px solid #000; text-align:center">Date</th>
      <th style="border:1px solid #000; text-align:center">Currency</th>
      <th style="border:1px solid #000; text-align:center">Exchange Rate</th>
      <th style="border:1px solid #000; text-align:center">Debit</th>
      <th style="border:1px solid #000; text-align:center">Credit</th>
      <th style="border:1px solid #000; text-align:center">Debit local</th>
      <th style="border:1px solid #000; text-align:center">Credit local</th>
    </tr>
  ';
  $sql = '';
  if($s_word==false){
    $sql =mysql_query("SELECT * FROM `am_balance` WHERE c_accountcode='$f_word' AND c_date BETWEEN '$from_date' AND '$to_date'");
  }else{
    $sql =mysql_query("SELECT * FROM `am_balance` WHERE c_accountcode='$f_word' AND c_date BETWEEN '$from_date' AND '$to_date' AND c_branch='$s_word'");
  }
    while($r = mysql_fetch_array($sql)){
      $c_vouchernumber = $r['c_vouchernumber'];
      $c_date = $r['c_date'];
      $query = mysql_query("SELECT * FROM `am_vw_voucher` WHERE am_vouchernumber='$c_vouchernumber'");
      while($row = mysql_fetch_array($query)){
        $exchagerate = $row['am_exchagerate'];
        $debet_local = $row['prime_debit'] * $exchagerate;
        $credit_local = $row['prime_credit'] * $exchagerate;
        $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['am_accountcode'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_description'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_vouchernumber'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$c_date.'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_currency'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_exchagerate'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['prime_debit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['prime_credit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$debet_local.'</td>
          <td style="border:1px solid #000; text-align:center">'.$credit_local.'</td>
        </tr>
        ';
      }
    }

    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Ac GL Report.xls");  
    echo $output;  
  }



?>