
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$second = $_GET['second'];
$third = $_GET['third'];
$four = $_GET['four'];
$sql = '';
if($four==true){
  $sql = mysql_query("SELECT cm_code,im_unit, COUNT(*) AS product FROM `im_transaction` WHERE cm_code='$four' and im_storeid='$f_word' and im_date BETWEEN '$second' and '$third'");
}else{
  $sql = mysql_query("SELECT DISTINCT(`cm_code`) AS cm_code,im_unit, COUNT(`cm_code`) AS Code FROM `im_transaction` WHERE im_storeid='$f_word' and im_date BETWEEN '$second' and '$third' GROUP BY cm_code");
}
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->SetMargins(1,10,1,10);
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Inventory Movement',0,0,'C');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'For '.$f_word.' Warehouse',0,0,'C');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(0,0,'From : '.$second. ' To '.$third,0,0,'C');
  $pdf->SetAutoPageBreak(false);
  $y_axis_initial = 30;
  $y_axis_initial2 = 25;
  $row_height = 18;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(1);
  $pdf->Cell(10, $row_height, 'S.N', 1, 0, 'C', 1);
  $pdf->Cell(15, $row_height, 'Date', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Tx.No', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Tx. Type', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Batch', 1, 0, 'C', 1);
  $pdf->Cell(15, $row_height, 'Exp. Date', 1, 0, 'C', 1);
  $y = $pdf->GetY();
  $x = $pdf->GetX();
  $width = 18;
  $pdf->MultiCell($width, 6, 'Currency Exchange Rate', 1, 'L', FALSE);
  $pdf->SetXY($x + $width, $y);
  $pdf->Cell(85, 9, 'Received', 1, 0, 'C', 1);
  $pdf->Cell(85, 9, 'Issued/Transfer', 1, 0, 'C', 1);
  $pdf->Ln(9);
  $pdf->Cell(123, 9, '', 0, 0, 'C', 0);
  $pdf->Cell(50, 9, 'From', 1, 0, 'C', 1);
  $pdf->Cell(10, 9, 'Qty', 1, 0, 'C', 1);
  $pdf->Cell(10, 9, 'Rate', 1, 0, 'C', 1);
  $pdf->Cell(15, 9, 'Value', 1, 0, 'C', 1);
  $pdf->Cell(50, 9, 'From', 1, 0, 'C', 1);
  $pdf->Cell(10, 9, 'Qty', 1, 0, 'C', 1);
  $pdf->Cell(10, 9, 'Rate', 1, 0, 'C', 1);
  $pdf->Cell(15, 9, 'Value', 1, 0, 'C', 1);
  $pdf->Ln(5);
  $i = 0;
  $max = 5;
  $j = 0;
  $max1 = 2;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
    $cm_code = $row['cm_code'];
    $p_sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
    $p_row = mysql_fetch_array($p_sql);
    $cm_group = $p_row['cm_group'];
    $sum = mysql_query("SELECT ifnull(sum(im_quantity*im_sign),0) as opqty,im_unit from im_transaction where im_storeid='$f_word' and cm_code='$cm_code' and im_date<'$second'group by cm_code");
    $sum_row = mysql_fetch_array($sum);
    
    if($j==$max1){
      $pdf->Ln(15);
      $pdf->Cell(0, 0, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial2);
      $pdf->SetX(1);
      $pdf->Cell(10, $row_height, 'S.N', 1, 0, 'C', 1);
      $pdf->Cell(15, $row_height, 'Date', 1, 0, 'C', 1);
      $pdf->Cell(20, $row_height, 'Tx.No', 1, 0, 'C', 1);
      $pdf->Cell(20, $row_height, 'Tx. Type', 1, 0, 'C', 1);
      $pdf->Cell(25, $row_height, 'Batch', 1, 0, 'C', 1);
      $pdf->Cell(15, $row_height, 'Exp. Date', 1, 0, 'C', 1);
      $y = $pdf->GetY();
      $x = $pdf->GetX();
      $width = 18;
      $pdf->MultiCell($width, 6, 'Currency Exchange Rate', 1, 'L', FALSE);
      $pdf->SetXY($x + $width, $y);
      $pdf->Cell(85, 9, 'Received', 1, 0, 'C', 1);
      $pdf->Cell(85, 9, 'Issued/Transfer', 1, 0, 'C', 1);
      $pdf->Ln(9);
      $pdf->Cell(123, 9, '', 0, 0, 'C', 0);
      $pdf->Cell(50, 9, 'From', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Qty', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Rate', 1, 0, 'C', 1);
      $pdf->Cell(15, 9, 'Value', 1, 0, 'C', 1);
      $pdf->Cell(50, 9, 'From', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Qty', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Rate', 1, 0, 'C', 1);
      $pdf->Cell(15, 9, 'Value', 1, 0, 'C', 1);
      $j = 0;
      $y_axis = $y_axis_initial2 + $row_height;
    }
    $pdf->SetY($y_axis);
    $pdf->Ln(1);
    $pdf->Cell(15, $row_height, 'Group :', 0, 0, 'C', 0);
    $pdf->Cell(25, $row_height, $cm_group, 0, 0, 'C', 0);
    $pdf->Cell(25, $row_height, $row['cm_code'], 0, 0, 'C', 0);
    $pdf->Cell(125, $row_height, $p_row['cm_name'], 0, 0, 'L', 0);
    $pdf->Cell(125, $row_height, 'Opening Quantity '.$sum_row['opqty']  .$sum_row['im_unit'], 0, 0, 'L', 0);
    
        $y_axis = $y_axis + $row_height;
        $j = $j + 1;
        $pdf->Ln(15);
    $i = 1;
    $no = $i;
    $total = mysql_query("SELECT * FROM `im_transaction` WHERE cm_code='$cm_code' AND im_storeid='$f_word' AND im_date BETWEEN '$second' AND '$third'");
    while($total_row = mysql_fetch_array($total)){
       $im_sign = $total_row['im_sign'];
       $im_number = $total_row['im_number'];
       $taxtype = '';
                        if(substr($im_number, 0,4)=='PO--'){
                          $taxtype = 'GRN';
                        }elseif(substr($im_number, 0,4)=='DO--'){
                          $taxtype = 'Sell';
                        }
                        elseif(substr($im_number, 0,4)=='IT--'){
                          $taxtype = 'Issue Transfer';
                        }
                        elseif(substr($im_number, 0,4)=='RE--'){
                          $taxtype = 'Receive Transfer';
                        }
                        elseif(substr($im_number, 0,4)=='SR--'){
                          $taxtype = 'Sales Return';
                        }
                        elseif(substr($im_number, 0,4)=='BO--'){
                          $taxtype = 'Bonus Sell';
                        }
                        elseif(substr($im_number, 0,4)=='BR--'){
                          $taxtype = 'Bonus Return';
                        }
                        elseif(substr($im_number, 0,4)=='AJIS'){
                          $taxtype = '(-) Adjustment';
                        }
                        elseif(substr($im_number, 0,4)=='AJRE'){
                          $taxtype = '(+) Adjustment';
                        }
       $im_note='';
        $im_qty = '';
        $im_rate = '';
        $im_basevalue = '';
        $im_note2='';
        $im_qty2 = '';
        $im_rate2 = '';
        $im_basevalue2 = '';
        if($im_sign==1){
          $im_note = $total_row['im_note'];
          $im_qty = $total_row['im_quantity'];
          $im_rate = $total_row['im_rate'];
          $im_basevalue = number_format($total_row['im_basevalue'],2);
        }else{
          $im_note2 = $total_row['im_note'];
          $im_qty2 = $total_row['im_quantity'];
          $im_rate2 = $total_row['im_rate'];
          $im_basevalue2 = number_format($total_row['im_basevalue'],2);
        }
        if($im_qty==false){
          $im_qty = '0.00';
        }elseif($im_basevalue==false){
          $im_basevalue = '0.00';
        }elseif($im_qty2==false){
          $im_qty2 = '0.00';
        }elseif($im_basevalue2==false){
          $im_basevalue2 = '0.00';
        }elseif($im_rate==false){
          $$im_rate = '0.00';
        }elseif($im_rate2==false){
          $im_rate2 = '0.00';
        }
        //
        if($i==$max){
          $pdf->Ln(5);
      
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial2);
      $pdf->SetX(1);
      $pdf->Cell(10, $row_height, 'S.N', 1, 0, 'C', 1);
      $pdf->Cell(15, $row_height, 'Date', 1, 0, 'C', 1);
      $pdf->Cell(20, $row_height, 'Tx.No', 1, 0, 'C', 1);
      $pdf->Cell(20, $row_height, 'Tx. Type', 1, 0, 'C', 1);
      $pdf->Cell(25, $row_height, 'Batch', 1, 0, 'C', 1);
      $pdf->Cell(15, $row_height, 'Exp. Date', 1, 0, 'C', 1);
      $y = $pdf->GetY();
      $x = $pdf->GetX();
      $width = 18;
      $pdf->MultiCell($width, 6, 'Currency Exchange Rate', 1, 'L', FALSE);
      $pdf->SetXY($x + $width, $y);
      $pdf->Cell(85, 9, 'Received', 1, 0, 'C', 1);
      $pdf->Cell(85, 9, 'Issued/Transfer', 1, 0, 'C', 1);
      $pdf->Ln(9);
      $pdf->Cell(123, 9, '', 0, 0, 'C', 0);
      $pdf->Cell(50, 9, 'From', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Qty', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Rate', 1, 0, 'C', 1);
      $pdf->Cell(15, 9, 'Value', 1, 0, 'C', 1);
      $pdf->Cell(50, 9, 'From', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Qty', 1, 0, 'C', 1);
      $pdf->Cell(10, 9, 'Rate', 1, 0, 'C', 1);
      $pdf->Cell(15, 9, 'Value', 1, 0, 'C', 1);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height;
      $pdf->Ln(9);
        }
        //

        $pdf->Cell(10, 10, $no++, 1, 0, 'C', 1);
        $pdf->Cell(15, 10, $total_row['im_date'], 1, 0, 'C', 1);
        $pdf->Cell(20, 10, $total_row['im_number'], 1, 0, 'C', 1);
        $pdf->Cell(20, 10, $taxtype, 1, 0, 'C', 1);
        $pdf->Cell(25, 10, $total_row['im_BatchNumber'], 1, 0, 'C', 1);
        $pdf->Cell(15, 10, $total_row['im_ExpireDate'], 1, 0, 'C', 1);
        $pdf->Cell(18, 10, $total_row['im_currency'].' '.number_format($total_row['im_ExchangeRate'],2), 1,0, 'C',1);
        $pdf->Cell(50, 10, $im_note, 1, 0, 'C', 1);
        $pdf->Cell(10, 10, $im_qty, 1, 0, 'C', 1);
        $pdf->Cell(10, 10, $total_row['im_rate'], 1, 0, 'C', 1);
        $pdf->Cell(15, 10, $im_basevalue, 1, 0, 'C', 1);
        $pdf->Cell(50, 10, $im_note2, 1, 0, 'C', 1);
        $pdf->Cell(10, 10, $im_qty2, 1, 0, 'C', 1);
        $pdf->Cell(10, 10, $im_rate2, 1, 0, 'C', 1);
        $pdf->Cell(15, 10, $im_basevalue2, 1, 0, 'C', 1);
        
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
    }
    $c_sql = mysql_query("SELECT SUM(im_quantity) AS qunt FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign=1");
    $c_row = mysql_fetch_array($c_sql);
    $c_sql2 = mysql_query("SELECT SUM(im_quantity) AS qunt FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='-1'");
    $c_row2 = mysql_fetch_array($c_sql2);
    $c_sql3 = mysql_query("SELECT SUM(im_basevalue) AS value FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='1'");
    $c_row3 = mysql_fetch_array($c_sql3);
    $c_sql4 = mysql_query("SELECT SUM(im_basevalue) AS value FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='-1'");
    $c_row4 = mysql_fetch_array($c_sql4);
    $qun = $c_row['qunt'];
    $qunt = number_format($c_row['qunt'],2);
    $qunt2 = number_format($c_row2['qunt'],2);
    $qun2 = $c_row2['qunt'];
    $value = number_format($c_row3['value'],2);
    $value2 = number_format($c_row4['value'],2);
    $close = $sum_row['opqty'] + $qun;
    $t_close = $close-$qun2;
    if($qunt==false){
      $qunt = '0.00';
    }elseif($qun2==false){
      $qun2 = '0.00';
    }elseif($value==false){
       $value = '0.00';
     }elseif($value2==false){
      $value2 = '0.00';
     }
     $pdf->Ln(1);
    $pdf->Cell(115, $row_height, 'Closing Quantity :', 0, 0, 'R', 0);
    $pdf->Cell(15, $row_height, $t_close.' '.$row['im_unit'], 0, 0, 'C', 0);
    $pdf->Cell(52, $row_height, $qunt, 0, 0, 'R', 0);
    $pdf->Cell(25, $row_height, $value, 0, 0, 'R', 0);
    $pdf->Cell(67, $row_height, $qunt2, 0, 0, 'R', 0);
    $pdf->Cell(20, $row_height, $value2, 0, 0, 'R', 0);
    $pdf->Ln(15);
  }
  $pdf->Cell(0, 0, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
  $pdf->Output();





  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
      $output .= '  
      <table class="table table-bordered">
      <tr>
        <td class="text-center" colspan="9">
          <h2>Inventory Movement</h2>
          <h3>For '.$f_word.' Warehouse</h3>
          <h4>From : '.$second. ' To '.$third.'</h4>
        </td>
      </tr>
        <tr>  
          <th style="border: 1px solid #000; width:5px">S.N</th>
          <th style="border: 1px solid #000; width:100px">Date</th>
          <th style="border: 1px solid #000; width:100px">Tx.No</th>
          <th style="border: 1px solid #000; width:100px">Tx. Type</th>
          <th style="border: 1px solid #000; width:100px">Batch</th>
          <th style="border: 1px solid #000; width:100px">Exp. Date</th>
          <th style="border: 1px solid #000; width:100px">Currency Exchange Rate</th>
          <td style="border: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="4"><b>Received</b>
            <table style="width:100%;">
              <tr>
                <th style="border: 1px solid #000;">From</th>
                <th style="border: 1px solid #000;">Qty</th>
                <th style="border: 1px solid #000;">Rate</th>
                <th style="border: 1px solid #000;">Value</th>
              </tr>
            </table>
          </td>
          <td style="border: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="4"><b>Issued/Transfer</b>
            <table style="width:100%;">
              <tr>
                <th style="border: 1px solid #000;">From</th>
                <th style="border: 1px solid #000;">Qty</th>
                <th style="border: 1px solid #000;">Rate</th>
                <th style="border: 1px solid #000;">Value</th>
              </tr>
            </table>
          </th>
        </tr>';  
        while($row = mysql_fetch_array($sql))
          {  
           $cm_code = $row['cm_code'];
            $p_sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
           $p_row = mysql_fetch_array($p_sql);
           $cm_group = $p_row['cm_group'];
           $sum = mysql_query("SELECT ifnull(sum(im_quantity*im_sign),0) as opqty,im_unit from im_transaction where im_storeid='$f_word' and cm_code='$cm_code' and im_date<'$second'group by cm_code");
           $sum_row = mysql_fetch_array($sum);
           
            $output .= '  
            <tr>  
              <td>Group:</td>
              <td><b>'.$cm_group.'</b></td>
              <td colspan="2"><b>'.$row['cm_code'].'</b></td>
              <td colspan="3"><b>'.$p_row['cm_name'].'</b></td>
              <td colspan="8"><b>Opening Quantity '.$sum_row['opqty'].'&nbsp;'.$sum_row['im_unit'].'</b></td>
            </tr>  
                ';  
                $i = 1;
                $no = $i;
                $total = mysql_query("SELECT * FROM `im_transaction` WHERE cm_code='$cm_code' AND im_storeid='$f_word' AND im_date BETWEEN '$second' AND '$third'");
                while($total_row = mysql_fetch_array($total)){
                  $im_sign = $total_row['im_sign'];
                  $im_number = $total_row['im_number'];
                  $taxtype = '';
                  if(substr($im_number, 0,4)=='PO--'){
                    $taxtype = 'GRN';
                  }elseif(substr($im_number, 0,4)=='DO--'){
                    $taxtype = 'Sell';
                  }elseif(substr($im_number, 0,4)=='IT--'){
                    $taxtype = 'Issue Transfer';
                  }elseif(substr($im_number, 0,4)=='RE--'){
                    $taxtype = 'Receive Transfer';
                  }elseif(substr($im_number, 0,4)=='SR--'){
                    $taxtype = 'Sales Return';
                  }elseif(substr($im_number, 0,4)=='BO--'){
                    $taxtype = 'Bonus Sell';
                  }elseif(substr($im_number, 0,4)=='BR--'){
                    $taxtype = 'Bonus Return';
                  }elseif(substr($im_number, 0,4)=='AJIS'){
                    $taxtype = '(-) Adjustment';
                  }elseif(substr($im_number, 0,4)=='AJRE'){
                    $taxtype = '(+) Adjustment';
                  }
                  $im_note='';
                  $im_qty = '';
                  $im_rate = '';
                  $im_basevalue = '';
                  $im_note2='';
                  $im_qty2 = '';
                  $im_rate2 = '';
                  $im_basevalue2 = '';
                  if($im_sign==1){
                    $im_note = $total_row['im_note'];
                    $im_qty = $total_row['im_quantity'];
                    $im_rate = $total_row['im_rate'];
                     $im_basevalue = number_format($total_row['im_basevalue'],2);
                  }else{
                    $im_note2 = $total_row['im_note'];
                    $im_qty2 = $total_row['im_quantity'];
                    $im_rate2 = $total_row['im_rate'];
                    $im_basevalue2 = number_format($total_row['im_basevalue'],2);
                  }
                  if($im_qty==false){
                     $im_qty = '0.00';
                   }elseif($im_basevalue==false){
                    $im_basevalue = '0.00';
                  }elseif($im_qty2==false){
                     $im_qty2 = '0.00';
                   }elseif($im_basevalue2==false){
                    $im_basevalue2 = '0.00';
                  }elseif($im_rate==false){
                    $im_rate = '0.00';
                  }elseif($im_rate2==false){
                     $im_rate2 = '0.00';
                  }
                  $output.='
                  <tr>
                        <td style="border: 1px solid #000;">'.$no++.'</td>
                        <td style="border: 1px solid #000;">'.$total_row['im_date'].'</td>
                        <td style="border: 1px solid #000;">'.$total_row['im_number'].'</td>
                        <td style="border: 1px solid #000;">'.$taxtype.'</td>
                        <td style="border: 1px solid #000;">'.$total_row['im_BatchNumber'].'</td>
                        <td style="border: 1px solid #000;">'.$total_row['im_ExpireDate'].'</td>
                        <td style="border: 1px solid #000;">'.$total_row['im_currency'].'&nbsp;'.number_format($total_row['im_ExchangeRate'],2).'</td>
                        <td style="border: 1px solid #000;">'.$im_note.'</td>
                        <td style="border: 1px solid #000;">'.$im_qty.'</td>
                        <td style="border: 1px solid #000;">'.$total_row['im_rate'].'</td>
                        <td style="border: 1px solid #000;">'.$im_basevalue.'</td>
                        <td style="border: 1px solid #000;">'.$im_note2.'</td>
                        <td style="border: 1px solid #000;">'.$im_qty2.'</td>
                        <td style="border: 1px solid #000;">'.$im_rate2.'</td>
                        <td style="border: 1px solid #000;">'.$im_basevalue2.'</td>
                      </tr>
                  ';
                }
                $c_sql = mysql_query("SELECT SUM(im_quantity) AS qunt FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign=1");
                $c_row = mysql_fetch_array($c_sql);
                $c_sql2 = mysql_query("SELECT SUM(im_quantity) AS qunt FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='-1'");
                $c_row2 = mysql_fetch_array($c_sql2);
                $c_sql3 = mysql_query("SELECT SUM(im_basevalue) AS value FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='1'");
                $c_row3 = mysql_fetch_array($c_sql3);
                $c_sql4 = mysql_query("SELECT SUM(im_basevalue) AS value FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='-1'");
                $c_row4 = mysql_fetch_array($c_sql4);
                $qun = $c_row['qunt'];
                $qunt = number_format($c_row['qunt'],2);
                $qunt2 = number_format($c_row2['qunt'],2);
                $qun2 = $c_row2['qunt'];
                $value = number_format($c_row3['value'],2);
                $value2 = number_format($c_row4['value'],2);
                $close = $sum_row['opqty'] + $qun;
                $t_close = $close-$qun2;
                if($qunt==false){
                  $qunt = '0.00';
                }elseif($qun2==false){
                  $qun2 = '0.00';
                }elseif($value==false){
                  $value = '0.00';
                }elseif($value2==false){
                  $value2 = '0.00';
                }
                 $output.='
                 <tr>
                        <td style="border: 1px solid #000;" colspan="3"></td>
                        <td style="border: 1px solid #000;" colspan="4"><b>Closing Quantity: '.$t_close.'&nbsp;'.$row['im_unit'].'</b></td>
                        <td style="border: 1px solid #000;"></td>
                        <td style="border: 1px solid #000;"><b>'.$qunt.'</b></td>
                        <td style="border: 1px solid #000;"></td>
                        <td style="border: 1px solid #000;"><b>'.$value.'</b></td>
                        <td style="border: 1px solid #000;"></td>
                        <td style="border: 1px solid #000;"><b>'.$qunt2.'</b></td>
                        <td style="border: 1px solid #000;"></td>
                        <td style="border: 1px solid #000;"><b>'.$value2.'</b></td>
                      </tr>
                 ';
    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Inventory Movement.xls");  
    echo $output;  


}  

?>