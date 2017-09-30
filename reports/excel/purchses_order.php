
<?php
include('../connection/dB.php');
$pPoNumber = $_GET['pPoNumber'];
$sql = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE `pp_purordnum`='$pPoNumber'") or die(mysql_error());
$row = mysql_fetch_array($sql);
$cm_supplierid = $row['cm_supplierid'];
$sql2 = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$cm_supplierid'");
$row2 = mysql_fetch_array($sql2);

$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',22);
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->Cell(0,10,'Purchase Order',0,0,'C');
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
    $pdf->Cell(10, $row_height, 'Supplier:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, $row_height, $row2['cm_supplierid'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, $row_height, 'Order Number:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(180, $row_height, $row['pp_purordnum'], 0, 0, 'L');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, 'Name:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(89, $row_height, $row2['cm_orgname'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(92, $row_height, 'Date:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(43, $row_height, $row['pp_date'], 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, 'Cell Number:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(61, $row_height, $row2['cm_cellphone'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(137, $row_height, 'Delivery Date:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(27, $row_height, $row['pp_deliverydate'], 0, 0, 'R');
    $pdf->Ln(7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, $row_height, 'Currency:', 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(44, $row_height, $row['pp_currency'], 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(148, $row_height, 'Deliver To:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(26, $row_height, $row['pp_store'], 0, 0, 'R');
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
    $pdf->Cell(20, $row_height, 'Unit QTY', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'Ord QTy', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'Rate', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, $row_height, 'TAX', 1, 0, 'C',1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, $row_height, 'Total', 1, 0, 'C',1);
    $pdf->SetAutoPageBreak(false);

$query_total = mysql_query("SELECT SUM(`pp_rowamt`) AS total FROM `pp_purchaseorddt` WHERE pp_purordnum='$pPoNumber'");
$total_row = mysql_fetch_array($query_total);
$total = $total_row['total'];
$dis_qu = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE `pp_purordnum`='$pPoNumber'");
$dis_row = mysql_fetch_array($dis_qu);
$dis_create = $dis_row['pp_discrate'];
$dis_amount = $dis_row['pp_discamt'];
$tdis_amount = ($total*$dis_create)/100;
$net_amount = $total-$tdis_amount;
$query = mysql_query("SELECT * FROM `pp_purchaseorddt` WHERE pp_purordnum='$pPoNumber'");
while($r = mysql_fetch_array($query)){
$cm_code = $r['cm_code'];
$query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
$r2 = mysql_fetch_array($query2);
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
  $pdf->Cell(20, $row_height, 'Unit QTY', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'Ord QTy', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'Rate', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(20, $row_height, 'TAX', 1, 0, 'C',1);
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(30, $row_height, 'Total', 1, 0, 'C',1);
  $i = 0;
  $y_axis = $y_axis_initial2 + $row_height;
}
//$pdf->Ln(40);
$pdf->SetFont('Arial', '', 10);
 $pdf->SetY($y_axis);
 $pdf->Ln(5);
$pdf->Cell(120, $row_height, $r2['cm_name'], 0, 0, 'L');
$pdf->Cell(27, $row_height, $r2['cm_code'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $r['pp_unit'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $r['pp_unitqty'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $r['pp_quantity'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $r['pp_purchasrate'], 0, 0, 'C');
$pdf->Cell(20, $row_height, $r['pp_taxamt'], 0, 0, 'C');
$pdf->Cell(30, $row_height, $r['pp_rowamt'], 0, 0, 'C');

$y_axis = $y_axis + $row_height;
$i = $i + 1;
}
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(240, $row_height, 'Total Amount :', 0, 0, 'R');
$pdf->Cell(30, $row_height, $total_row['total'], 0, 0, 'R');
$pdf->Ln(10);
$pdf->Cell(240, $row_height, 'Discount Rate(%) :', 0, 0, 'R');
$pdf->Cell(30, $row_height, $dis_row['pp_discrate'], 0, 0, 'R');
$pdf->Ln(10);
$pdf->Cell(240, $row_height, 'Discount :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($tdis_amount,2), 0, 0, 'R');
$pdf->Ln(8);
$pdf->Cell(240, $row_height, 'Net Amount :', 0, 0, 'R');
$pdf->Cell(30, $row_height, number_format($net_amount,2), 0, 0, 'R');
$pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
$pPoNumber = $_GET['pPoNumber'];
$sql = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE `pp_purordnum`='$pPoNumber'") or die(mysql_error());
$row = mysql_fetch_array($sql);
$cm_supplierid = $row['cm_supplierid'];
$sql2 = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$cm_supplierid'");
$row2 = mysql_fetch_array($sql2);
   
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center"><h2>PURCHASE ORDER</h2></th>    
        </tr> 
        <tr>
          <th align="left">Supplier</th>
          <td align="left">'.$row2['cm_supplierid'].'</td>
          <th align="left">Order Number</th>
          <td align="left">'.$row['pp_purordnum'].'</td>
        </tr>
        <tr>
          <th align="left">Name</th>
          <td align="left">'.$row2['cm_orgname'].'</td>
          <th align="left">Date</th>
          <td align="left">'.$row['pp_date'].'</td>
        </tr>
        <tr>
          <th align="left">Cell Number</th>
          <td align="left">'.$row2['cm_cellphone'].'</td>
          <th align="left">Delivery Date</th>
          <td align="left">'.$row['pp_deliverydate'].'</td>
        </tr>
        <tr>
          <th align="left">Currency</th>
          <td align="left">'.$row['pp_currency'].'</td>
          <th align="left">Deliver To</th>
          <td align="left">'.$row['pp_store'].'</td>
        </tr>
        <tr>  
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Code</th>
          <th style="border:1px solid #000; text-align:center">Unit</th>
          <th style="border:1px solid #000; text-align:center">Unit QTY</th>
          <th style="border:1px solid #000; text-align:center">Ord QTy</th>
          <th style="border:1px solid #000; text-align:center">Rate</th>
          <th style="border:1px solid #000; text-align:center">TAX</th>
          <th style="border:1px solid #000; text-align:center">Total</th>
        </tr> 
           ';  
           $query_total = mysql_query("SELECT SUM(`pp_rowamt`) AS total FROM `pp_purchaseorddt` WHERE pp_purordnum='$pPoNumber'");
                  $total_row = mysql_fetch_array($query_total);
                  $total = $total_row['total'];
                  $dis_qu = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE `pp_purordnum`='$pPoNumber'");
                  $dis_row = mysql_fetch_array($dis_qu);
                  $dis_create = $dis_row['pp_discrate'];
                  $dis_amount = $dis_row['pp_discamt'];
                  $tdis_amount = ($total*$dis_create)/100;
                  $net_amount = $total-$tdis_amount;
                  $query = mysql_query("SELECT * FROM `pp_purchaseorddt` WHERE pp_purordnum='$pPoNumber'");
        while($r = mysql_fetch_array($query))
        
          {  
            $cm_code = $r['cm_code'];
                    $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
                    $r2 = mysql_fetch_array($query2);
            
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:left">'.$r2['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r2['cm_code'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['pp_unit'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['pp_unitqty'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['pp_quantity'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['pp_purchasrate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['pp_taxamt'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['pp_rowamt'].'</td>
            </tr>  
                    ';  
    }  
    $output .= '<tr>
                    <th class="text-right" colspan="7">Total Amount :</th>
                    <th>'.$total_row['total'].'</th>
                  </tr>
                  <tr>
                    <th class="text-right" colspan="7">Discount Rate(%):</th>
                    <th>'.$dis_row['pp_discrate'].'</th>
                  </tr>
                  <tr>
                    <th class="text-right" colspan="7">Discount :</th>
                    <th>'.number_format($tdis_amount,2).'</th>
                  </tr>
                  <tr>
                    <th class="text-right" colspan="7">Net Amount :</th>
                    <th>'.number_format($net_amount,2).'</th>
                  </tr>'; 
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Purchase_order.xls");  
    echo $output;  
 

}  
?>