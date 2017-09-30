
<?php
include('../connection/dB.php');
$first_word = $_GET['first_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',20);
  $pdf->Cell(0,20,'Item Ledger',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(50,10,'Branch : '.$first_word,0,0,'L');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(50,10,'From Date : '.$from_date,0,0,'L');
  $pdf->Ln(5);
  $pdf->Cell(50,10,'To Date : '.$to_date,0,0,'L');
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 40;
  $y_axis_initial2 = 40;
  $row_height = 12;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(30, $row_height, 'Item code', 1, 0, 'C', 1);
  $pdf->Cell(135, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(38, $row_height, 'Opening Balance Qty', 1, 0, 'C', 1);
  $pdf->Cell(22, $row_height, 'Receive Qty', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Issue Qty', 1, 0, 'C', 1);
  $pdf->Cell(35, $row_height, 'Closing Balance Qty', 1, 0, 'C', 1);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
  $sql = mysql_query("SELECT * FROM `im_transaction` WHERE im_storeid='$first_word' ");
    while($row = mysql_fetch_array($sql)){
          $cm_code = $row['cm_code'];
          $qu = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
          $r = mysql_fetch_array($qu);
          $opensql = mysql_query("SELECT SUM(`im_quantity`)AS openplus FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` <= '$from_date' AND `im_sign`='1'");
          $openrow = mysql_fetch_array($opensql);
          $openplus = $openrow['openplus'];
          $opensql2 = mysql_query("SELECT SUM(`im_quantity`)AS openminus FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` <= '$from_date' AND `im_sign`='-1'");
          $openrow2 = mysql_fetch_array($opensql2);
          $openminus = $openrow2['openminus'];
          $openqun = $openplus-$openminus;
          $receivesql = mysql_query("SELECT SUM(`im_quantity`)AS RQ FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` BETWEEN '$from_date' AND '$to_date' AND `im_sign`='1'");
          $receiverow = mysql_fetch_array($receivesql);
          $RQ = $receiverow['RQ'];
          if($RQ == false){
            $RQ='00';
          }
          $issuesql = mysql_query("SELECT SUM(`im_quantity`)AS IQ FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` BETWEEN '$from_date' AND '$to_date' AND `im_sign`='-1'");
          $issuerow = mysql_fetch_array($issuesql);
          $IQ = $issuerow['IQ'];
          if($IQ == false){
            $IQ='00';
          }
          $close = $openqun+$RQ-$IQ;
          if($openqun=='0' && $RQ=='00' && $IQ =='00' &&$close == '0'){

          }else{
          if ($i == $max){
            $pdf->Ln(10);
            $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
            $pdf->AddPage();
            $pdf->SetY($y_axis_initial2);
            $pdf->SetX(10);
            $pdf->Cell(30, $row_height, 'Item code', 1, 0, 'C', 1);
            $pdf->Cell(135, $row_height, 'Product Name', 1, 0, 'C', 1);
            $pdf->Cell(38, $row_height, 'Opening Balance Qty', 1, 0, 'C', 1);
            $pdf->Cell(22, $row_height, 'Receive Qty', 1, 0, 'C', 1);
            $pdf->Cell(20, $row_height, 'Issue Qty', 1, 0, 'C', 1);
            $pdf->Cell(35, $row_height, 'Closing Balance Qty', 1, 0, 'C', 1);
            $i = 0;
            $y_axis = $y_axis_initial2 + $row_height;
            
          }
        $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(30, $row_height, $cm_code, 1, 0, 'L', 1);
    $pdf->Cell(135, $row_height, $r['cm_name'], 1, 0, 'L', 1);
    $pdf->Cell(38, $row_height, $openqun, 1, 0, 'C', 1);
    $pdf->Cell(22, $row_height, $RQ, 1, 0, 'C', 1);
    $pdf->Cell(20, $row_height, $IQ, 1, 0, 'C', 1);
    $pdf->Cell(35, $row_height, $close, 1, 0, 'C', 1);

    $y_axis = $y_axis + $row_height;

    $i = $i + 1;
    }

  }
  $pdf->Output();





  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
$sql = mysql_query("SELECT * FROM `im_transaction` WHERE im_storeid='$first_word' ");
  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Item Ledger</h2><br>
          <h3 class="text-center">Branch: '.$first_word.'</h3>
          <h4 class="text-center">From Date : '.$from_date.'</h4>
          <h5 class="text-center">To Date : '.$to_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Item Code</th>
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Opening Balance Qty</th>
          <th style="border:1px solid #000; text-align:center">Receive Qty</th>
          <th style="border:1px solid #000; text-align:center">Issue Qty</th>
          <th style="border:1px solid #000; text-align:center">Closing Balance Qty</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            $cm_code = $row['cm_code'];
                      $qu = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
                      $r = mysql_fetch_array($qu);
                      $opensql = mysql_query("SELECT SUM(`im_quantity`)AS openplus FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` <= '$from_date' AND `im_sign`='1'");
                      $openrow = mysql_fetch_array($opensql);
                      $openplus = $openrow['openplus'];

                      $opensql2 = mysql_query("SELECT SUM(`im_quantity`)AS openminus FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` <= '$from_date' AND `im_sign`='-1'");
                      $openrow2 = mysql_fetch_array($opensql2);
                      $openminus = $openrow2['openminus'];
                      $openqun = $openplus-$openminus;

                      $receivesql = mysql_query("SELECT SUM(`im_quantity`)AS RQ FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` BETWEEN '$from_date' AND '$to_date' AND `im_sign`='1'");
                      $receiverow = mysql_fetch_array($receivesql);
                      $RQ = $receiverow['RQ'];
                      if($RQ == false){
                        $RQ='00';
                      }
                      $issuesql = mysql_query("SELECT SUM(`im_quantity`)AS IQ FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` BETWEEN '$from_date' AND '$to_date' AND `im_sign`='-1'");
                      $issuerow = mysql_fetch_array($issuesql);
                      $IQ = $issuerow['IQ'];
                      if($IQ == false){
                        $IQ='00';
                      }
                      $close = $openqun+$RQ-$IQ;
                      if($openqun=='0' && $RQ=='00' && $IQ =='00' &&$close == '0'){

                      }else{
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$cm_code.'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$openqun.'</td>
              <td style="border:1px solid #000; text-align:center">'.$RQ.'</td>
              <td style="border:1px solid #000; text-align:center">'.$IQ.'</td>
              <td style="border:1px solid #000; text-align:center">'.$close.'</td>
            </tr>  
                ';  
              }
    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Item Ledger.xls");  
    echo $output;  
  }

}  

?>