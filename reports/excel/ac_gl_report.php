
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
$creamount=0;
$debitamt=0;
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
  $pdf->Cell(0,0,'For : '.$c.$s_word.' Branch',0,0,'C');
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
   $pdf->Cell(30, $row_height, 'Debit', 1, 0, 'C', 1);
   $pdf->Cell(30, $row_height, 'Credit', 1, 0, 'C', 1);
  
   $pdf->Ln(10);
   $i = 0;
   $max = 14;
   $y_axis = $y_axis_initial + $row_height;
    if($s_word==false){
    $sql =mysql_query("SELECT * FROM `am_vw_acglrpt` where am_accountcode='$f_word' and am_date>='$from_date' and am_date<='$to_date'");
                    
    }
	else{
    $sql =mysql_query("SELECT * FROM `am_vw_acglrpt` where am_accountcode='$f_word' and am_date>='$from_date' and am_date<='$to_date' and am_branch='$s_word'");
                  
		 }
    while($row = mysql_fetch_array($sql)){
       //$c_vouchernumber = $r['c_vouchernumber'];
       //$c_date = $r['c_date'];
       //$query = mysql_query("SELECT * FROM `am_vw_voucher` WHERE am_vouchernumber='$c_vouchernumber'");
      // while($row = mysql_fetch_array($query)){
        //$exchagerate = $row['am_exchagerate'];
        //$debet_local = $row['prime_debit'] * $exchagerate;
        //$credit_local = $row['prime_credit'] * $exchagerate;
		//$accode=$row['am_accountcode'];
		//$vunum=$row['am_vouchernumber'];
		 $baseamt=$row['am_baseamt'];		
				if($baseamt{0}=='-')
					  {
						  $creamount = substr($baseamt, 1);
						  $debitamt=0;
					  }
					  else
					  {
						  $debitamt=$baseamt;
						  $creamount=0;
					  }		 
		//$rate=mysql_query("select am_exchagerate from acgl_view where am_accountcode !='$accode' and am_vouchernumber='$vunum'");
                      //$test=mysql_fetch_assoc($rate);
					  //$exchangerate=$test['am_exchagerate'];
					  
					  // $credit_local = $row['prime_debit'] * $exchangerate;
                        //$debet_local = $row['prime_credit'] * $exchangerate;
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
         $pdf->Cell(30, $row_height, 'Debit', 1, 0, 'C', 1);
         $pdf->Cell(30, $row_height, 'Credit', 1, 0, 'C', 1);
        
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
        $pdf->Cell(28, $row_height, $row['am_accountcode'], 1, 0, 'C', 1);
         $pdf->Cell(70, $row_height, $row['am_description'], 1, 0, 'C', 1);
         $pdf->Cell(30, $row_height, $row['am_vouchernumber'], 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, $row['am_date'], 1, 0, 'C', 1);
         $pdf->Cell(20, $row_height, $row['am_currency'], 1, 0, 'C', 1);
         $pdf->Cell(25, $row_height, $row['am_exchagerate'], 1, 0, 'C', 1);
         $pdf->Cell(30, $row_height, number_format($debitamt,2), 1, 0, 'C', 1);
         $pdf->Cell(30, $row_height, number_format($creamount,2), 1, 0, 'C', 1);
         
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
       /*}*/
 }
  $pdf->Output();

  }elseif(isset($_POST["export_excel"])){ 
$c = '';
if($s_word==false){
  $c = 'All';
}  
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
      <th colspan="10" align="center"><h3>For : '.$s_word.''.$c.'Branch'.'</h3></th>
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
     
    </tr>
  ';
  $sql = '';
  $creamount=0;
$debitamt=0;
    if($s_word==false){
    $sql =mysql_query("SELECT * FROM `am_vw_acglrpt` where am_accountcode='$f_word' and am_date>='$from_date' and am_date<='$to_date'");
                    
    }
	else{
    $sql =mysql_query("SELECT * FROM `am_vw_acglrpt` where am_accountcode='$f_word' and am_date>='$from_date' and am_date<='$to_date' and am_branch='$s_word'");
                  
		 }
    while($row = mysql_fetch_array($sql)){
      //$c_vouchernumber = $r['c_vouchernumber'];
      //$c_date = $r['c_date'];
      //$query = mysql_query("SELECT * FROM `am_vw_voucher` WHERE am_vouchernumber='$c_vouchernumber'");
      //while($row = mysql_fetch_array($query)){
        //$exchagerate = $row['am_exchagerate'];
        //$debet_local = $row['prime_debit'] * $exchagerate;
        //$credit_local = $row['prime_credit'] * $exchagerate;
		//$accode=$row['am_accountcode'];
		//$vunum=$row['am_vouchernumber'];
					  
		//$rate=mysql_query("select am_exchagerate from acgl_view where am_accountcode !='$accode' and am_vouchernumber='$vunum'");
                     // $test=mysql_fetch_assoc($rate);
					  //$exchangerate=$test['am_exchagerate'];
					  
					  // $credit_local = $row['prime_debit'] * $exchangerate;
                        //$debet_local = $row['prime_credit'] * $exchangerate;
						 $accode=$row['am_accountcode'];
					  $vunum=$row['am_vouchernumber'];
					  $baseamt=$row['am_baseamt'];
					   if($baseamt{0}=='-')
					  {
						  $creamount = substr($baseamt, 1);
						  $debitamt=0;
					  }
					  else
					  {
						  $debitamt=$baseamt;
						  $creamount=0;
					  }
		
        $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['am_accountcode'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_description'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_vouchernumber'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_date'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['am_currency'].'</td>
          <td style="border:1px solid #000; text-align:center">'.number_format((float)$row['am_exchagerate'],2).'</td>
          <td style="border:1px solid #000; text-align:center">'.number_format($debitamt,2).'</td>
          <td style="border:1px solid #000; text-align:center">'.number_format($creamount,2).'</td>
        </tr>
        ';
      /*}*/
    }

    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Ac GL Report.xls");  
    echo $output;  
  }



?>