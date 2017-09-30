
<?php
include('../connection/dB.php');
$psmnumber = $_GET['psmnumber'];
                $sql = mysql_query("SELECT * FROM `sm_header` WHERE `sm_number`='$psmnumber'") or die(mysql_error());
                $sq = mysql_query("SELECT SUM(`sm_totalamt`) AS Total FROM `sm_header` WHERE `sm_number`='$psmnumber'");
                $sq2 = mysql_query("SELECT SUM(`sm_total_tax_amt`) AS Totaltax FROM `sm_header` WHERE `sm_number`='$psmnumber'");
                $ss = mysql_fetch_array($sql);
                $s = mysql_fetch_array($sq);
                $s2 = mysql_fetch_array($sq2);
                $cm_cuscode = $ss['cm_cuscode'];
                $discount = $ss['sm_disc_amt'];
                if($discount==null){
                  $discount = '0.00';
                }
                $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_cuscode'") or die(mysql_error());
                $rr = mysql_fetch_array($query2);
                $cq = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$cm_cuscode'");
                $cr = mysql_fetch_array($cq);

$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',22);
  //$pdf->Cell(80);
  $pdf->Cell(0,10,'Sales Invoice',0,0,'C');
  $pdf->SetLineWidth(0.5);
  $pdf->Line(10,20,286,20);
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 20;
  $row_height = 10;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
    $pdf->Cell(10, $row_height, $cm_cuscode, 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, $row_height, '', 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, $row_height, 'Invoice No:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(180, $row_height, $psmnumber, 0, 0, 'L');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, $cr['cm_name'], 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(56, $row_height, $cr['cm_address'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(132, $row_height, 'Date:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(24, $row_height, $ss['sm_date'], 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(200, $row_height, 'From :', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(70, $row_height, $ss['sm_storeid'], 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(138, $row_height, '', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(37, $row_height, '', 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, '', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(38, $row_height, '', 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(159, $row_height, 'Currency:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(36, $row_height, $ss['sm_currency'], 0, 0, 'L');
    $pdf->Ln(8);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10,50,286,50);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0,$row_height,'Product Description',0,0,'C',0);
    $pdf->Line(10,60,286,60);
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0,$row_height,'Direct sales for the Invoice '.$psmnumber.' that were registered as '.$ss['sm_storeid'].' invoices instead of '. $ss['sm_currency'].'  Amout ',0,0,'L',0);
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(225, $row_height, 'Amout (Excl. VAT) :', 0, 0, 'R');
$pdf->Cell(30, $row_height, $s['Total'], 0, 0, 'R');
$pdf->Ln(10);
$pdf->Cell(225, $row_height, 'VAT :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($s2['Totaltax'],2), 0, 0, 'R');
$pdf->Ln(10);
$pdf->Cell(225, $row_height, 'Amount (Incl. VAT) :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($s['Total']+$s2['Totaltax'],2), 0, 0, 'R');
$pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 

  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
        <table class="table table-bordered" width="900">
                    <tr>
                      <th>'.$cm_cuscode.'</th>
                    </tr>
                    <tr>
                      <td>'.$cr['cm_name'].'</td>
                    </tr>
                    <tr>
                      <td>'.$cr['cm_address'].'</td>
                    </tr>
                    <tr>
                      <td>'.$cr['cm_cellnumber'].'</td>
                    </tr>  
                    <div class="col-md-4 text-center"><h2><b>Sales Invoice</b></h2></div>
                <div class="col-md-4">
                  <table class="table table-borderless2 table-responsive" style="border:none">
                    <tr>
                      <th>Invoice No</th>
                      <td></td>
                      <td>'.$psmnumber.'</td>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <td></td>
                      <td>'.$ss['sm_date'].'</td>
                    </tr>
                    <tr>
                      <th>From</th>
                      <td></td>
                      <td>'.$ss['sm_storeid'].'</td>
                    </tr>
                    <tr>
                      <th>Currency</th>
                      <td></td>
                      <td>'.$ss['sm_currency'].'</td>
                    </tr>
                  </table>
                </div>
              </div>
              <h3 class="text-center" style="border-top:1px solid #000;border-bottom:1px solid #000; padding:5px;"><b>Product Description</b></h3><h5>Direct sales for the Invoice <?php echo $psmnumber?> that were registered as '.$ss['sm_storeid'].' invoices instead of '. $ss['sm_currency'].' Amout</h5>
              
                <!--<form method="post" action="excel.php" >-->
                <div class="col-md-12">
                  <div class="row">
                    <div style="height:200px;border-bottom:3px solid #000; width:300px; float:right"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div style="border-top:3px solid #000; width:300px; float:right; margin-top:2px"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div style="width:300px; float:right; margin-top:2px">
                      <h4><b>Amout (Excl. VAT):'.$s['Total'].'</b></h4><br>
                      <h4><b>VAT: '.number_format($s2['Totaltax'],2).'</b></h4><br>
                      <h4><b>Amount (Incl. VAT):'.number_format($s['Total']+$s2['Totaltax'],2).'</b></h4>
                    </div>
                  </div>
                </div>
                ';  
    }  

    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Sales_Invoice.xls");  
    echo $output;  
  }
 
?>