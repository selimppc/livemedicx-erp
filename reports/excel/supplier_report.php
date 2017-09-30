
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$second_word = $_GET['second_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$ssql = mysql_query("SELECT * FROM `cm_suppliermaster`");
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',18);
  $pdf->Cell(0,0,'Supplier Ledger',0,0,'C');
  $pdf->SetLineWidth(0.5);
  $pdf->Line(0,25,300,25);
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'From : '.$from_date. ' To '.$to_date,0,0,'C');
  $pdf->SetAutoPageBreak(false);
  $y_axis_initial = 20;
  $y_axis_initial2 = 74;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $row_height = 12;
  $pdf->SetX(10);
  $i = 0;
  $max = 5;
  $y_axis = $y_axis_initial2 + $row_height;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->Ln(10);
  while($row = mysql_fetch_array($ssql)){
      $cm_supplierid = $row['cm_supplierid'];
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(0, $row_height, $cm_supplierid.' '.$row['cm_orgname'], 0, 0, 'L',1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, $row_height, 'All amount shown in local currecny', 0, 0, 'R', 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);
        $pdf->Cell(0, $row_height, $row['cm_address'], 0, 0, 'L',1);
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, $row_height, 'Date', 1, 0, 'C', 1);
        $pdf->Cell(55, $row_height, 'Voucher Number', 1, 0, 'C', 1);
        $pdf->Cell(55, $row_height, 'Description', 1, 0, 'C', 1);
        $pdf->Cell(45, $row_height, 'Currency & Exch. Rate', 1, 0, 'C', 1);
        $pdf->Cell(35, $row_height, 'Payable Amount', 1, 0, 'C', 1);
        $pdf->Cell(35, $row_height, 'Paid Amount', 1, 0, 'C', 1);
        $pdf->Ln(14);
        $sql = mysql_query("SELECT a.cm_supplierid,a.cm_orgname,a.cm_address,c.am_branch,c.am_vouchernumber,c.am_date, b.am_currency,b.am_exchagerate,b.am_baseamt FROM cm_suppliermaster a INNER JOIN am_voucherdetail b ON a.cm_supplierid=b.am_subacccode INNER JOIN am_vouhcerheader c ON b.am_vouchernumber=c.am_vouchernumber WHERE case when '$second_word'<>'' then c.am_branch='$second_word' else c.am_branch>'' end AND c.am_date<='$to_date' AND case when '$cm_supplierid'<>'' then a.cm_supplierid='$cm_supplierid' else a.cm_supplierid>'' end ORDER BY c.am_branch,a.cm_supplierid,c.am_date");
          while($ro = mysql_fetch_array($sql)){
            $am_vouchernumber = substr($ro['am_vouchernumber'],0,4);
            $des = '';
            if($am_vouchernumber=='AP--'){
              $des = 'Account Payable';
            }else{
              $des = 'Payable Received';
            }
            $pay = '';
            $paid = '';
            $amount = $ro['am_baseamt'];
            if($amount<0){
              $pay = str_replace('-','',$amount);
            }else{
              $paid = $amount;
            }
            if($pay==false){
              $pay = '0.00';
            }
            if($paid==false){
              $paid = '0.00';
            }
            $cm_supplierid = $ro['cm_supplierid'];
            mysql_query("INSERT INTO `supplier_total` VALUES('','$pay','$paid','$cm_supplierid')") or die(mysql_error());
          
            if ($i == $max){
            $pdf->Ln(12);
            $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'C');
            $pdf->AddPage();
            $pdf->SetY(30);
            $pdf->SetX(10);
            $pdf->Cell(50, $row_height, 'Date', 1, 0, 'C', 1);
            $pdf->Cell(55, $row_height, 'Voucher Number', 1, 0, 'C', 1);
            $pdf->Cell(55, $row_height, 'Description', 1, 0, 'C', 1);
            $pdf->Cell(45, $row_height, 'Currency & Exch. Rate', 1, 0, 'C', 1);
            $pdf->Cell(35, $row_height, 'Payable Amount', 1, 0, 'C', 1);
            $pdf->Cell(35, $row_height, 'Paid Amount', 1, 0, 'C', 1);
            $i = 0;
            $y_axis = 30 + $row_height;
          }
        $pdf->SetY($y_axis);
        $pdf->SetX(10);
        $pdf->Cell(50, $row_height, $ro['am_date'], 1, 0, 'C', 1);
        $pdf->Cell(55, $row_height, $ro['am_vouchernumber'], 1, 0, 'C', 1);
        $pdf->Cell(55, $row_height, $des, 1, 0, 'C', 1);
        $pdf->Cell(45, $row_height, $ro['am_currency'].' '.$ro['am_exchagerate'], 1, 0, 'C', 1);
        $pdf->Cell(35, $row_height, $pay, 1, 0, 'C', 1);
        $pdf->Cell(35, $row_height, $paid, 1, 0, 'C', 1);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
        }
        $paysql = mysql_query("SELECT SUM(`pay_total`) As Pay FROM `supplier_total` WHERE `supplier_id`='$cm_supplierid'") or die(mysql_error());
        $payrow = mysql_fetch_array($paysql);
        $paidsql = mysql_query("SELECT SUM(`paid_total`) As Paid FROM `supplier_total` WHERE `supplier_id`='$cm_supplierid'") or die(mysql_error());
        $paidrow = mysql_fetch_array($paidsql);
        $payable = $payrow['Pay'];
        $paidable = $paidrow['Paid'];
        $apay='';
        $apaid = '';
        if($payable<$paidable){
          $apaid = $paidable-$payable;
          $apay = '0.00';
        }else{
          $apay = '0.00';
          $apaid = '0.00';
        }
        if($payable>$paidable){
          $apay = $payable-$paidable;
          $apaid = '0.00';
        }else{
          $apay = '0.00';
          $apaid = '0.00';
        }
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Ln(12);
      $pdf->Cell(155, $row_height, '', 0, 0, 'C', 0);
      $pdf->Cell(50, $row_height, 'Total Amount:', 0, 0, 'C', 0);
      $pdf->Cell(35, $row_height, number_format($payrow['Pay'],2), 0, 0, 'C', 0);
      $pdf->Cell(35, $row_height, number_format($paidrow['Paid'],2), 0, 0, 'C', 0);
      $pdf->Ln(5);
      $pdf->Cell(155, $row_height, '', 0, 0, 'C', 0);
      $pdf->Cell(50, $row_height, 'Closing Balance:', 0, 0, 'C', 0);
      $pdf->Cell(35, $row_height, number_format($apay,2), 0, 0, 'C', 0);
      $pdf->Cell(35, $row_height, number_format($apaid,2), 0, 0, 'C', 0);
      $pdf->AddPage();
      
  }

  $pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />';  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="7" align="center">
          <h2 class="text-center">Supplier Ledger</h2><br>
          <h5 class="text-center">From: '.$from_date.' To: '.$to_date.'</h5>
          </th>    
        </tr> '; 
        $ssql = mysql_query("SELECT * FROM `cm_suppliermaster`");

                while($row = mysql_fetch_array($ssql)){
                  $cm_supplierid = $row['cm_supplierid'];
                  $output .= '  
        <tr>  
          <th colspan="7" style="border:1px solid #000; text-align:left">
          <h4><b>'.$cm_supplierid.'&nbsp;'.$row['cm_orgname'].'</b></h4>
          <h4><b>'.$row['cm_address'].'</b></h4>
          </th>    
        </tr>';
        $output .= '   
        <tr>  
          <th style="border:1px solid #000; text-align:center">Date</th>
          <th style="border:1px solid #000; text-align:center">Voucher Number</th>
          <th style="border:1px solid #000; text-align:center">Description</th>
          <th style="border:1px solid #000; text-align:center">Currency & Exch. Rate</th>
          <th style="border:1px solid #000; text-align:center">Payable Amount</th>
          <th style="border:1px solid #000; text-align:center">Paid Amount</th>
        </tr>'; 
        $sql = mysql_query("SELECT a.cm_supplierid,a.cm_orgname,a.cm_address,c.am_branch,c.am_vouchernumber,c.am_date, b.am_currency,b.am_exchagerate,b.am_baseamt FROM cm_suppliermaster a INNER JOIN am_voucherdetail b ON a.cm_supplierid=b.am_subacccode INNER JOIN am_vouhcerheader c ON b.am_vouchernumber=c.am_vouchernumber WHERE case when '$second_word'<>'' then c.am_branch='$second_word' else c.am_branch>'' end AND c.am_date<='$to_date' AND case when '$cm_supplierid'<>'' then a.cm_supplierid='$cm_supplierid' else a.cm_supplierid>'' end ORDER BY c.am_branch,a.cm_supplierid,c.am_date");
          while($ro = mysql_fetch_array($sql)){
            $am_vouchernumber = substr($ro['am_vouchernumber'],0,4);
            $des = '';
            if($am_vouchernumber=='AP--'){
                      $des = 'Account Payable';
                    }else{
                      $des = 'Payable Received';
                    }
                    $pay = '';
                    $paid = '';
                    $amount = $ro['am_baseamt'];
                    if($amount<0){
                      $pay = str_replace('-','',$amount);
                    }else{
                      $paid = $amount;
                    }
                    if($pay==false){
                      $pay = '0.00';
                    }
                    if($paid==false){
                      $paid = '0.00';
                    }
                    $cm_supplierid = $ro['cm_supplierid'];
                    mysql_query("INSERT INTO `supplier_total` VALUES('','$pay','$paid','$cm_supplierid')") or die(mysql_error());

          
                            $output.='
                            <tr>
                                  <td>'.$ro['am_date'].'</td>
                                  <td>'.$ro['am_vouchernumber'].'</td>
                                  <td>'.$des.'</td>
                                  <td>'.$ro['am_currency'].'&nbsp; '.$ro['am_exchagerate'].'</td>
                                  <td>'.$pay.'</td>
                                  <td>'.$paid.'</td>
                                </tr>
                            ';
}
                          $paysql = mysql_query("SELECT SUM(`pay_total`) As Pay FROM `supplier_total` WHERE `supplier_id`='$cm_supplierid'") or die(mysql_error());
                   $payrow = mysql_fetch_array($paysql);
                   $paidsql = mysql_query("SELECT SUM(`paid_total`) As Paid FROM `supplier_total` WHERE `supplier_id`='$cm_supplierid'") or die(mysql_error());
                   $paidrow = mysql_fetch_array($paidsql);
                   $payable = $payrow['Pay'];
                   $paidable = $paidrow['Paid'];
                   $apay='';
                   $apaid = '';
                   if($payable<$paidable){
                    $apaid = $paidable-$payable;
                    $apay = '0.00';
                   }else{
                    $apay = '0.00';
                    $apaid = '0.00';
                   }
                   if($payable>$paidable){
                    $apay = $payable-$paidable;
                    $apaid = '0.00';
                   }else{
                    $apay = '0.00';
                    $apaid = '0.00';
                   }
                    $output.='
                    <tr>
                        <td colspan="4" class="text-right"><b>Total Amount:</b></td>
                        <td>'.$payrow['Pay'].'</td>
                        <td>'.$paidrow['Paid'].'</td>
                      </tr>
                      <tr>
                        <td colspan="4" class="text-right"><b>Closing Balance:</b></td>
                        <td>'.$apay.'</td>
                        <td>'.$apaid.'</td>
                      </tr>
                    ';
                }
       
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Supplier Ledger.xls");  
    echo $output;  

mysql_query("DELETE  FROM `supplier_total`") or die(mysql_error());
}  

?>