
<?php
include('../connection/dB.php');
$psmnumber = $_GET['psmnumber'];
                $sql = mysql_query("SELECT * FROM `sm_detail` WHERE `sm_number`='$psmnumber'") or die(mysql_error());
                $sq = mysql_query("SELECT SUM(`sm_lineamt`) AS Total FROM `sm_detail` WHERE `sm_number`='$psmnumber'");
                $s = mysql_fetch_array($sq);
                $query = mysql_query("SELECT * FROM `sm_header` WHERE sm_number='$psmnumber'") or die(mysql_error());
                $r = mysql_fetch_array($query);
                $cm_cuscode = $r['cm_cuscode'];
                $discount = $r['sm_disc_amt'];
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
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->Cell(0,10,'Sales Invoice',0,0,'C');
  $pdf->SetLineWidth(0.5);
  $pdf->Line(10,20,286,20);
  $row_height = 10;
  $y_axis_initial = 20;
  $y_axis_initial2 = 50;
  $i = 0;
  $max = 12;
  $y_axis = $y_axis_initial2 + $row_height;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->SetY($y_axis_initial);
  //$pdf->SetX(10);
    $pdf->Cell(10, $row_height, 'Cus. Code:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, $row_height, $r['cm_cuscode'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, $row_height, 'Cus. Name:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(180, $row_height, $cr['cm_name'], 0, 0, 'L');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, 'Address:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(54, $row_height, $cr['cm_address'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(140, $row_height, 'Contact:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(33, $row_height, $cr['cm_cellnumber'], 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, 'Invoice No:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(49, $row_height, $psmnumber, 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(139, $row_height, 'Date:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(27, $row_height, $r['sm_date'], 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, 'From:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(47, $row_height, $r['sm_storeid'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, $row_height, 'Currency:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(26, $row_height, $r['sm_currency'].$r['sm_exchrate'], 0, 0, 'R');
    $pdf->Ln(8);
    $pdf->SetLineWidth(0.5);
    $pdf->Line(10,50,286,50);
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(27, $row_height, 'Code', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'Unit', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    //$pdf->Cell(20, $row_height, 'Unit QTY', 1, 0, 'C',1);
    //$pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'Ord QTy', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'Rate', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'VAT%', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, $row_height, 'Total amount', 1, 0, 'C',1);
    $pdf->SetAutoPageBreak(false);


while($row = mysql_fetch_array($sql)){
$cm_code = $row['cm_code'];
$query = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'") or die(mysql_error());
$rr = mysql_fetch_array($query);
if ($i == $max){
  $pdf->Ln(10);
  $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
  $pdf->AddPage();
  $pdf->SetY($y_axis_initial2);
  $pdf->SetX(10);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(27, $row_height, 'Code', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'Unit', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  //$pdf->Cell(20, $row_height, 'Unit QTY', 1, 0, 'C',1);
 // $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'Ord QTy', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'Rate', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'VAT%', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(30, $row_height, 'Total amount', 1, 0, 'C',1);
  $i = 0;
  $y_axis = $y_axis_initial2 + $row_height;
}
//$pdf->Ln(40);
$pdf->SetFont('Arial', '', 10);
 $pdf->SetY($y_axis);
 $pdf->Ln(5);
//$pdf->SetFont('Arial', '', 10);
$pdf->Cell(120, $row_height, $rr['cm_name'], 0, 0, 'L');
$pdf->Cell(27, $row_height, $row['cm_code'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $row['sm_quantity'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $rr['cm_purunit'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $row['sm_rate'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $row['sm_tax_rate'], 0, 0, 'C');
$pdf->Cell(30, $row_height, $row['sm_lineamt'], 0, 0, 'C');

$y_axis = $y_axis + $row_height;
$i = $i + 1;
}
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(20);
$pdf->Cell(220, $row_height, 'TAX :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($r['sm_total_tax_amt'],2), 0, 0, 'R');
$pdf->Ln(10);
$pdf->Cell(220, $row_height, 'Discount :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($r['sm_disc_amt'],2), 0, 0, 'R');
$pdf->Ln(10);
$pdf->Cell(220, $row_height, 'Total Amount :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($s['Total'],2), 0, 0, 'R');

$pdf->Output();

  }elseif(isset($_POST["excel"])){ 
  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
$psmnumber = $_GET['psmnumber'];
                $sql = mysql_query("SELECT * FROM `sm_detail` WHERE `sm_number`='$psmnumber'") or die(mysql_error());
                $sq = mysql_query("SELECT SUM(`sm_lineamt`) AS Total FROM `sm_detail` WHERE `sm_number`='$psmnumber'");
                $s = mysql_fetch_array($sq);
                $query = mysql_query("SELECT * FROM `sm_header` WHERE sm_number='$psmnumber'") or die(mysql_error());
                $r = mysql_fetch_array($query);
                $cm_cuscode = $r['cm_cuscode'];
                $discount = $r['sm_disc_amt'];
                if($discount==null){
                  $discount = '0.00';
                }
                $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_cuscode'") or die(mysql_error());
                $rr = mysql_fetch_array($query2);
                $cq = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$cm_cuscode'");
                $cr = mysql_fetch_array($cq);
   
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center"><h2>Sales Order</h2></th>    
        </tr> 
        <tr>
          <th align="left">Cus. Code</th>
          <td align="left">'.$r['cm_cuscode'].'</td>
          <th align="left">Cus. Name</th>
          <td align="left">'.$cr['cm_name'].'</td>
        </tr>
        <tr>
          <th align="left">Address</th>
          <td align="left">'.$cr['cm_address'].'</td>
          <th align="left">Contact</th>
          <td align="left">'.$cr['cm_cellnumber'].'</td>
        </tr>
        <tr>
          <th align="left">Invoice No:</th>
          <td align="left">'.$psmnumber.'</td>
          <th align="left">Date</th>
          <td align="left">'.$r['sm_date'].'</td>
        </tr>
        <tr>
          <th align="left">FROM:</th>
          <td align="left">'.$r['sm_storeid'].'</td>
          <th align="left">Currency:</th>
          <td align="left">'.$r['sm_currency'].$r['sm_exchrate'].'</td>
        </tr>
        <tr>  
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Code</th>
          <th style="border:1px solid #000; text-align:center">Unit</th>
          
          <th style="border:1px solid #000; text-align:center">Ord QTy</th>
          <th style="border:1px solid #000; text-align:center">Rate</th>
          <th style="border:1px solid #000; text-align:center">VAT%</th>
          <th style="border:1px solid #000; text-align:center">Total amount</th>
        </tr> 
           ';  
           
        while($row = mysql_fetch_array($sql))
        
          {  
            $cm_code = $row['cm_code'];
                    //$query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
                    //$r2 = mysql_fetch_array($query2);
					$query = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'") or die(mysql_error());
					$rr = mysql_fetch_array($query);
            
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:left">'.$rr['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['sm_quantity'].'</td>
             
              <td style="border:1px solid #000; text-align:center">'.$rr['cm_purunit'].'</td>
              <td style="border:1px solid #000; text-align:center">'.number_format($row['sm_rate'],2).'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['sm_tax_rate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.number_format($row['sm_lineamt'],2).'</td>
            </tr>  
                    ';  
    }  
    $output .= '<tr>
                    <th class="text-right" colspan="6">Total Amount :</th>
                    <th>'.number_format($s['Total'],2).'</th>
                  </tr>
                  <tr>
                    <th class="text-right" colspan="6">TAX:</th>
                    <th>'.number_format($r['sm_total_tax_amt'],2).'</th>
                  </tr>
                  <tr>
                    <th class="text-right" colspan="6">Discount :</th>
                    <th>'.number_format($r['sm_disc_amt'],2).'</th>
                  </tr>
                  '; 
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Sales_order.xls");  
    echo $output;  
  

} 
?>