
<?php
include('../connection/dB.php');
$first_word = $_GET['first_word'];
$second_word = $_GET['second_word'];
$third_word = $_GET['third_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$output = ''; 
$sql ='';
if($first_word==false && $second_word==false && $third_word==false){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==true && $second_word==true && $third_word==true){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE left(am_vouchernumber,4) ='$first_word' AND am_branch ='$second_word' AND am_status ='$third_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==true && $second_word==false && $third_word==false){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE left(am_vouchernumber,4) ='$first_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==true && $second_word==false && $third_word==true){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE left(am_vouchernumber,4) ='$first_word' AND am_status ='$third_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==false && $second_word==true && $third_word==false){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE am_branch ='$second_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==false && $second_word==false && $third_word==true){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE am_status ='$third_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==true && $second_word==true && $third_word==false){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE left(am_vouchernumber,4) ='$first_word' AND am_branch ='$second_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}elseif($first_word==false && $second_word==false && $third_word==true){
  $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE am_status ='$third_word' AND am_date BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
}

if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',22);
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->Cell(0,10,'Journal Transaction',0,0,'L');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(0,10,'From Date: '.$from_date.' To '.$to_date,0,0,'L');
  $pdf->SetLineWidth(0.5);
  $pdf->Line(10,28,105,28);
  $pdf->Ln(10);
  $pdf->SetAutoPageBreak(false);
  $y_axis_initial = 30;
  $row_height = 10;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  while($row = mysql_fetch_array($sql)){
    $vouchernumber = $row['am_vouchernumber'];
    $am_status = $row['am_status'];
    if($am_status=='Open'){

    }else{
    $pdf->SetX(10);
    $pdf->Cell(40,$row_height,'Voucher Number : ',0,0,'L',0);
    $pdf->Cell(100,$row_height,$row['am_vouchernumber'],0,0,'L',0);
    $pdf->Cell(20,$row_height,'Year : ',0,0,'C');
    $pdf->Cell(10,$row_height,$row['am_year'],0,0,'L',0);
    $pdf->Ln(5);
    $pdf->Cell(40,$row_height,'Date : ',0,0,'L',0);
    $pdf->Cell(100,$row_height,$row['am_date'],0,0,'L',0);
    $pdf->Cell(23,$row_height,'Period : ',0,0,'C');
    $pdf->Cell(10,$row_height,$row['am_period'],0,0,'L',0);
    $pdf->Cell(85,$row_height,'Status : ',0,0,'R');
    $pdf->Cell(10,$row_height,$row['am_status'],0,0,'L',0);
    $pdf->Ln(5);
    $pdf->Cell(40,$row_height,'Branch : ',0,0,'L',0);
    $pdf->Cell(10,$row_height,$row['am_branch'],0,0,'L',0);
    $pdf->Cell(20,$row_height,'Note : ',0,0,'R',0);
    $pdf->Cell(200,$row_height,$row['am_note'],0,0,'L',0);
    $pdf->Ln(10);
    $pdf->Cell(35,$row_height,'Code',1,0,'C',0);
    $pdf->Cell(70,$row_height,'Accounts Description',1,0,'C',0);
    $pdf->Cell(15,$row_height,'Currency',1,0,'C',1);
    $pdf->Cell(15,$row_height,'Ex. Rate',1,0,'C',0);
    $pdf->Cell(30,$row_height,'Debit',1,0,'C');
    $pdf->Cell(30,$row_height,'Credit',1,0,'C');
    $pdf->Cell(40,$row_height,'Debit Local',1,0,'C',0);
    $pdf->Cell(40,$row_height,'Credit Local',1,0,'C');
    $pdf->Ln(10);
    $product = mysql_query("SELECT * FROM `am_voucherdetail`,`am_chartofaccounts` WHERE (am_voucherdetail.am_accountcode=am_chartofaccounts.am_accountcode) AND am_voucherdetail.am_vouchernumber='$vouchernumber'");
    while($product_row = mysql_fetch_array($product)){
      $am_primeamt = $product_row['am_primeamt'];
      $am_baseamt = $product_row['am_baseamt'];
      $debit = '';
      $credit = '';
      $debitl = '';
      $creditl = '';
      $fcredit = '';
      $fcreditl = '';
      if($am_primeamt>0){
        $debit = number_format($am_primeamt,2);
      }else{
        $credit = number_format($am_primeamt,2);
        $fcredit = str_replace('-','',$credit);
      }
      if($am_baseamt>0){
        $debitl = number_format($am_baseamt,2);
      }else{
        $creditl = number_format($am_baseamt,2);
        $fcreditl = str_replace('-', '', $creditl);
      }
      $am_vouchernumber = $product_row['am_vouchernumber'];
      $sum_debet = mysql_query("SELECT SUM(`am_primeamt`)AS Dabet FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_primeamt>0");
      $sum_debet_row = mysql_fetch_array($sum_debet);
      $sum_credit = mysql_query("SELECT SUM(`am_primeamt`)AS Credit FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_primeamt<0");
      $sum_credit_row = mysql_fetch_array($sum_credit);
      $Dabet = number_format($sum_debet_row['Dabet'],2);
      $Dabets = $sum_debet_row['Dabet'];
      $Credit = number_format($sum_credit_row['Credit'],2);
      $Credits = $sum_credit_row['Credit'];
      $fCredit = str_replace('-', '', $Credit);
      $fCredits = str_replace('-', '', $Credits);
      $sum_debetl = mysql_query("SELECT SUM(`am_baseamt`)AS Dabetl FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_baseamt>0");
      $sum_debetl_row = mysql_fetch_array($sum_debetl);
      $sum_creditl = mysql_query("SELECT SUM(`am_baseamt`)AS Creditl FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_baseamt<0");
      $sum_creditl_row = mysql_fetch_array($sum_creditl);
      $Dabetl = number_format($sum_debetl_row['Dabetl'],2);
      $Dabetls = $sum_debetl_row['Dabetl'];
      $Creditl = number_format($sum_creditl_row['Creditl'],2);
      $Creditls = $sum_creditl_row['Creditl'];
      $fCreditl = str_replace('-', '', $Creditl);
      $fCreditls = str_replace('-', '', $Creditls);
    $pdf->Cell(35,$row_height,$product_row['am_accountcode'],0,0,'L',0);
    $pdf->Cell(70,$row_height,$product_row['am_description'],0,0,'L',0);
    $pdf->Cell(15,$row_height,$product_row['am_currency'],0,0,'C',0);
    $pdf->Cell(15,$row_height,$product_row['am_exchagerate'],0,0,'C',0);
    $pdf->Cell(30,$row_height,$debit,0,0,'C');
    $pdf->Cell(30,$row_height,$fcredit,0,0,'C');
    $pdf->Cell(40,$row_height,$debitl,0,0,'C',0);
    $pdf->Cell(40,$row_height,$fcreditl,0,0,'C');
    $pdf->Ln(5);
    }
     mysql_query("INSERT INTO `jurnal_sum` VALUES('','$Dabets','$fCredits','$Dabetls','$fCreditls')");
    $pdf->Ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(135,$row_height,'Total Sum',0,0,'R');
    $pdf->Cell(30,$row_height,$Dabet,0,0,'C');
    $pdf->Cell(30,$row_height,$fCredit,0,0,'C');
    $pdf->Cell(40,$row_height,$Dabetl,0,0,'C');
    $pdf->Cell(40,$row_height,$fCreditl,0,0,'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(15);
    $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
    $pdf->AddPage();
    }
  }
  $pdf->SetFont('Arial', 'B', 10);
  $dabet_sum = mysql_query("SELECT SUM(`Dabet`) AS dabet_sum FROM `jurnal_sum`");
  $debet_sum_row = mysql_fetch_array($dabet_sum);
  $credit_sum = mysql_query("SELECT SUM(`fCredit`) AS credit_sum FROM `jurnal_sum`");
  $credit_sum_row = mysql_fetch_array($credit_sum);
  $dabetl_sum = mysql_query("SELECT SUM(`Dabetl`) AS dabetl_sum FROM `jurnal_sum`");
  $debetl_sum_row = mysql_fetch_array($dabetl_sum);
  $creditl_sum = mysql_query("SELECT SUM(`fCreditl`) AS creditl_sum FROM `jurnal_sum`");
  $creditl_sum_row = mysql_fetch_array($creditl_sum);
  $pdf->Cell(135,$row_height,'Total Report Summary',0,0,'R');
  $pdf->Cell(30,$row_height,number_format($debet_sum_row['dabet_sum'],2),0,0,'C');
  $pdf->Cell(30,$row_height,number_format($credit_sum_row['credit_sum'],2),0,0,'C');
  $pdf->Cell(30,$row_height,number_format($debetl_sum_row['dabetl_sum'],2),0,0,'C');
  $pdf->Cell(40,$row_height,number_format($creditl_sum_row['creditl_sum'],2),0,0,'C');
  $pdf->Output();
}
elseif(isset($_POST["excel"])){
print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 

$output .= '<table class="table table-bordered">
              <tr>
                <td colspan="8" align="center"><b><h2>Journal Transaction</h2></b></td>
              </tr>
              <tr>
                <td colspan="3" align="left"><b><h4><u>From Date: '.$from_date.' To '.$to_date.'</u></h4></b></td>
              </tr>';  
              while($row = mysql_fetch_array($sql)){
                  $vouchernumber = $row['am_vouchernumber'];
                  $am_status = $row['am_status'];
                  if($am_status=='Open'){

                  }else{
                  $output .= '
                  <table  class="table">
                    <tr>
                      <th align="left">Voucher Number</th>
                      <td align="left">'.$row['am_vouchernumber'].'</td>
                      <th align="right">Year</th>
                      <td align="right">'.$row['am_year'].'</td>
                      
                    </tr>
                    <tr>
                       <th align="left">Date</th>
                       <td align="left">'.$row['am_date'].'</td>
                        <th align="right">Period</th>
                        <td align="right">'.$row['am_period'].'</td>
                        <th align="right">Status</th>
                        <td align="right">'.$row['am_status'].'</td>
                    </tr>
                    <tr>
                       <th align="left">Branch</th>
                       <td align="left">'.$row['am_branch'].'</td>
                        <th align="right">Note</th>
                        <td colspan="4" align="right">'.$row['am_note'].'</td>
                    </tr>
                    <tr>
                      <th align="left" style="border:1px solid #000">Code</th>
                      <th align="left" style="border:1px solid #000">Accounts Description</th> 
                      <th align="left" style="border:1px solid #000">Currency</th>   
                      <th align="left" style="border:1px solid #000">Ex. Rate</th>  
                      <th align="left" style="border:1px solid #000">Debit</th>   
                      <th align="left" style="border:1px solid #000">Credit</th> 
                      <th align="left" style="border:1px solid #000">Debit Local</th> 
                      <th align="left" style="border:1px solid #000">Credit Local</th>
                    </tr>'
                  
                  ; 
                  $product = mysql_query("SELECT * FROM `am_voucherdetail`,`am_chartofaccounts` WHERE (am_voucherdetail.am_accountcode=am_chartofaccounts.am_accountcode) AND am_voucherdetail.am_vouchernumber='$vouchernumber'");
                   while($product_row = mysql_fetch_array($product)){
                    $am_primeamt = $product_row['am_primeamt'];
                    $am_baseamt = $product_row['am_baseamt'];
                     $debit = '';
                     $credit = '';
                     $debitl = '';
                     $creditl = '';
                     $fcredit = '';
                     $fcreditl = '';
                     if($am_primeamt>0){
                      $debit = number_format($am_primeamt,2);
                    }else{
                      $credit = number_format($am_primeamt,2);
                      $fcredit = str_replace('-','',$credit);
                    }
                    if($am_baseamt>0){
                      $debitl = number_format($am_baseamt,2);
                    }else{
                      $creditl = number_format($am_baseamt,2);
                      $fcreditl = str_replace('-', '', $creditl);
                    }
                    $am_vouchernumber = $product_row['am_vouchernumber'];
                    $sum_debet = mysql_query("SELECT SUM(`am_primeamt`)AS Dabet FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_primeamt>0");
                    $sum_debet_row = mysql_fetch_array($sum_debet);
                    $sum_credit = mysql_query("SELECT SUM(`am_primeamt`)AS Credit FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_primeamt<0");
                    $sum_credit_row = mysql_fetch_array($sum_credit);
                    $Dabet = number_format($sum_debet_row['Dabet'],2);
                    $Dabets = $sum_debet_row['Dabet'];
                    $Credit = number_format($sum_credit_row['Credit'],2);
                    $Credits = $sum_credit_row['Credit'];
                    $fCredit = str_replace('-', '', $Credit);
                    $fCredits = str_replace('-', '', $Credits);
                    $sum_debetl = mysql_query("SELECT SUM(`am_baseamt`)AS Dabetl FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_baseamt>0");
                    $sum_debetl_row = mysql_fetch_array($sum_debetl);
                    $sum_creditl = mysql_query("SELECT SUM(`am_baseamt`)AS Creditl FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_baseamt<0");
                    $sum_creditl_row = mysql_fetch_array($sum_creditl);
                    $Dabetl = number_format($sum_debetl_row['Dabetl'],2);
                    $Dabetls = $sum_debetl_row['Dabetl'];
                    $Creditl = number_format($sum_creditl_row['Creditl'],2);
                    $Creditls = $sum_creditl_row['Creditl'];
                    $fCreditl = str_replace('-', '', $Creditl);
                    $fCreditls = str_replace('-', '', $Creditls);
                    
                    $output.='

                      <tr>
                      <td style="border:1px solid #000; text-align:center">'.$product_row['am_accountcode'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$product_row['am_description'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$product_row['am_currency'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$product_row['am_exchagerate'].'</td>
                      <td style="border:1px solid #000; text-align:center">'.$debit.'</td>
                      <td style="border:1px solid #000; text-align:center">'.$fcredit.'</td>
                      <td style="border:1px solid #000; text-align:center">'.$debitl.'</td>
                      <td style="border:1px solid #000; text-align:center">'.$fcreditl.'</td>
                    </tr>
                    ';
                    }
                     mysql_query("INSERT INTO `jurnal_sum` VALUES('','$Dabets','$fCredits','$Dabetls','$fCreditls')");
                     $output.='
                      <tr>
                      <th colspan="4" class="text-right">Total Sum : </th>
                      <th style="border-top:1px solid #000">'.$Dabet.'</th>
                      <th style="border-top:1px solid #000">'.$fCredit.'</th>
                      <th style="border-top:1px solid #000">'.$Dabetl.'</th>
                      <th style="border-top:1px solid #000">'.$fCreditl.'</th>
                    </tr>
                     ';}
                   }
                   $dabet_sum = mysql_query("SELECT SUM(`Dabet`) AS dabet_sum FROM `jurnal_sum`");
              $debet_sum_row = mysql_fetch_array($dabet_sum);
              $credit_sum = mysql_query("SELECT SUM(`fCredit`) AS credit_sum FROM `jurnal_sum`");
              $credit_sum_row = mysql_fetch_array($credit_sum);
              $dabetl_sum = mysql_query("SELECT SUM(`Dabetl`) AS dabetl_sum FROM `jurnal_sum`");
              $debetl_sum_row = mysql_fetch_array($dabetl_sum);
              $creditl_sum = mysql_query("SELECT SUM(`fCreditl`) AS creditl_sum FROM `jurnal_sum`");
              $creditl_sum_row = mysql_fetch_array($creditl_sum);
              $output.='
                             
                <tr>
                  <th colspan="4" class="text-right">Total Report Summary</th>
                  <th style="border-top:1px solid #000">'.number_format($debet_sum_row['dabet_sum'],2).'</th>
                  <th style="border-top:1px solid #000">'.number_format($credit_sum_row['credit_sum'],2).'</th>
                  <th style="border-top:1px solid #000">'.number_format($debetl_sum_row['dabetl_sum'],2).'</th>
                  <th style="border-top:1px solid #000">'.number_format($creditl_sum_row['creditl_sum'],2).'</th>
                </tr>
              ';
               
$output .= '</table>';       
header("Content-Type: application/xls");   
header("Content-Disposition: attachment; filename=Journal Transaction.xls");  
echo $output;
}

mysql_query("DELETE  FROM `jurnal_sum`") or die(mysql_error());
?>