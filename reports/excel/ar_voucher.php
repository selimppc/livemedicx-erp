
<?php
include('../connection/dB.php');
$pVoucherNo = $_GET['pVoucherNo'];
$sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE am_vouchernumber='$pVoucherNo'");
 $sql1 = mysql_query("SELECT * FROM `sm_header` INNER JOIN cm_customermst on sm_header.cm_cuscode=cm_customermst.cm_cuscode WHERE sm_header.glvoucher='$pVoucherNo'") or die(mysql_error());
$ro = mysql_fetch_array($sql1);
$gid=$ro['gerant_id'];

$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','U',16);
  //$pdf->Cell(80);
  $pdf->Cell(0,10,'Accounts Receivable Voucher',0,0,'L');
  //$pdf->Ln(10);
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 20;
  $row_height = 10;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  while($row = mysql_fetch_array($sql)){
    $pdf->Cell(10, $row_height, 'Voucher Number', 0, 0, 'L');
    $pdf->Cell(60, $row_height, $row['am_vouchernumber'], 0, 0, 'R');
    $pdf->Cell(30, $row_height, 'Year', 0, 0, 'R');
    $pdf->Cell(20, $row_height, $row['am_year'], 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->Cell(10, $row_height, 'Date', 0, 0, 'L');
    $pdf->Cell(54, $row_height, $row['am_date'], 0, 0, 'R');
    $pdf->Cell(45, $row_height, 'Gerant ID:', 0, 0, 'R');
    $pdf->Cell(13, $row_height, $gid, 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->Cell(10, $row_height, 'Branch', 0, 0, 'L');
    $pdf->Cell(47, $row_height, $row['am_branch'], 0, 0, 'R');
    $pdf->Cell(43, $row_height, 'Note', 0, 0, 'R');
    $pdf->Cell(92, $row_height, $row['am_note'], 0, 0, 'R');
    $pdf->Cell(50, $row_height, 'Status', 0, 0, 'R');
    $pdf->Cell(20, $row_height, $row['am_status'], 0, 0, 'L');
    $pdf->Ln(7);
    $pdf->Cell(35, $row_height, 'Code', 1, 0, 'C', 1);
    $pdf->Cell(85, $row_height, 'Accounts Description', 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, 'Currency', 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, 'Ex. Rate', 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, 'Debit', 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, 'Credit', 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, 'Debit Local', 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, 'Credit Local', 1, 0, 'C', 1);

  $pdf->Ln(7);
  $product = mysql_query("SELECT * FROM `am_voucherdetail`,`am_chartofaccounts` WHERE (am_voucherdetail.am_accountcode=am_chartofaccounts.am_accountcode) AND am_voucherdetail.am_vouchernumber='$pVoucherNo'");
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

    $pdf->Cell(35, 15, $product_row['am_accountcode'], 0, 0, 'C');
    $pdf->Cell(85, 15, $product_row['am_description'], 0, 0, 'C');
    $pdf->Cell(25, 15, $product_row['am_currency'], 0, 0, 'C');
    $pdf->Cell(25, 15, $product_row['am_exchagerate'], 0, 0, 'C');
    $pdf->Cell(25, 15, $debit, 0, 0, 'C');
    $pdf->Cell(25, 15, $fcredit, 0, 0, 'C');
    $pdf->Cell(25, 15, $debitl, 0, 0, 'C');
    $pdf->Cell(25, 15, $fcreditl, 0, 0, 'C');
    $pdf->Ln(5);
  }
  $pdf->Ln(5);
  $pdf->SetLineWidth(0.4);
  $pdf->Line(150,65,280,65);
  mysql_query("INSERT INTO `jurnal_sum` VALUES('','$Dabets','$fCredits','$Dabetls','$fCreditls')");
    $pdf->Cell(35, 15, '', 0, 0, 'C');
    $pdf->Cell(85, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, $Dabet, 0, 0, 'C');
    $pdf->Cell(25, 15, $fCredit, 0, 0, 'C');
    $pdf->Cell(25, 15, $Dabetl, 0, 0, 'C');
    $pdf->Cell(25, 15, $fCreditl, 0, 0, 'C');

    }
    $dabet_sum = mysql_query("SELECT SUM(`Dabet`) AS dabet_sum FROM `jurnal_sum`");
    $debet_sum_row = mysql_fetch_array($dabet_sum);
    $credit_sum = mysql_query("SELECT SUM(`fCredit`) AS credit_sum FROM `jurnal_sum`");
    $credit_sum_row = mysql_fetch_array($credit_sum);
    $dabetl_sum = mysql_query("SELECT SUM(`Dabetl`) AS dabetl_sum FROM `jurnal_sum`");
    $debetl_sum_row = mysql_fetch_array($dabetl_sum);
    $creditl_sum = mysql_query("SELECT SUM(`fCreditl`) AS creditl_sum FROM `jurnal_sum`");
    $creditl_sum_row = mysql_fetch_array($creditl_sum);
    $pdf->Ln(10);
    $pdf->Line(150,75,280,75);
    $pdf->Cell(35, 15, '', 0, 0, 'C');
    $pdf->Cell(85, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, 'Total Local Report Summary', 0, 0, 'C');
    $pdf->Cell(25, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, '', 0, 0, 'C');
    $pdf->Cell(25, 15, number_format($debetl_sum_row['dabetl_sum'],2), 0, 0, 'C');
    $pdf->Cell(25, 15, number_format($creditl_sum_row['creditl_sum'],2), 0, 0, 'C');
  $pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 

  if(mysql_num_rows($sql) > 0)  
    {  
      while($row = mysql_fetch_array($sql)){
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="8" align="left"><h2><u>Accounts Receivable Voucher</u></h2></th>    
        </tr> 
        <tr>  
          <th align="left">Voucher Number</th>
          <th align="left">'.$row['am_vouchernumber'].'</th>
          <th align="left">Year</th>
          <th align="left">'.$row['am_year'].'</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr> 
        <tr>
          <th align="left">Date</th>
          <td align="left">'.$row['am_date'].'</td>
          <th align="left">GerantID:</th>
          <td align="left">'.$gid.'</td>
          <td></td>
          <td></td>
          <th align="left">Status</th>
          <td align="left">'.$row['am_status'].'</td>
        </tr>
        <tr>
          <th align="left">Branch</th>
          <td align="left">'.$row['am_branch'].'</td>
          <th align="left">Note</th>
          <td colspan="5">'.$row['am_note'].'</td>
        </tr>
        <tr>
          <th style="border:1px solid #000">Code</th>
          <th style="border:1px solid #000">Accounts Description</th> 
          <th style="border:1px solid #000">Currency</th>   
          <th style="border:1px solid #000">Ex. Rate</th>   
          <th style="border:1px solid #000">Debit</th>    
          <th style="border:1px solid #000">Credit</th> 
          <th style="border:1px solid #000">Debit Local</th>  
          <th style="border:1px solid #000">Credit Local</th> 
        </tr>
           ';  
      $product = mysql_query("SELECT * FROM `am_voucherdetail`,`am_chartofaccounts` WHERE (am_voucherdetail.am_accountcode=am_chartofaccounts.am_accountcode) AND am_voucherdetail.am_vouchernumber='$pVoucherNo'");

        while($product_row = mysql_fetch_array($product))  
          {  
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
              
              
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$product_row['am_accountcode'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$product_row['am_description'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$product_row['am_currency'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$product_row['am_exchagerate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$debit.'</td>
              <td style="border:1px solid #000; text-align:center">'.$fcredit.'</td>
              <td style="border:1px solid #000; text-align:center">'.$debitl.'</td>
              <td style="border:1px solid #000; text-align:center">'.$fcreditl.'</td>
            </tr>';
          }
          mysql_query("INSERT INTO `jurnal_sum` VALUES('','$Dabets','$fCredits','$Dabetls','$fCreditls')");
          $output .= ' 
            <tr>
              <td colspan="4"></td>
              <th style="border-top:1px solid #000">'.$Dabet.'</th>
              <th style="border-top:1px solid #000">'.$fCredit.'</th>
              <th style="border-top:1px solid #000">'.$Dabetl.'</th>
              <th style="border-top:1px solid #000">'.$fCreditl.'</th>
            </tr>';
          }
             $dabet_sum = mysql_query("SELECT SUM(`Dabet`) AS dabet_sum FROM `jurnal_sum`");
              $debet_sum_row = mysql_fetch_array($dabet_sum);
              $credit_sum = mysql_query("SELECT SUM(`fCredit`) AS credit_sum FROM `jurnal_sum`");
              $credit_sum_row = mysql_fetch_array($credit_sum);
              $dabetl_sum = mysql_query("SELECT SUM(`Dabetl`) AS dabetl_sum FROM `jurnal_sum`");
              $debetl_sum_row = mysql_fetch_array($dabetl_sum);
              $creditl_sum = mysql_query("SELECT SUM(`fCreditl`) AS creditl_sum FROM `jurnal_sum`");
              $creditl_sum_row = mysql_fetch_array($creditl_sum);
           $output .= '    
            <tr>
              <th colspan="6" class="text-right">Total Local Report Summary</th>
              <th style="border-top:1px solid #000">'.number_format($debetl_sum_row['dabetl_sum'],2).'</th>
              <th style="border-top:1px solid #000">'.number_format($creditl_sum_row['creditl_sum'],2).'</th>
            </tr> 
                ';  

    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=AR_Voucher.xls");  
    echo $output;  

}  
mysql_query("DELETE  FROM `jurnal_sum`") or die(mysql_error());
?>