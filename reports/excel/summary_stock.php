
<?php
include('../connection/dB.php');
$final_f_word = $_GET['final_f_word'];
$from_date = $_GET['from_date'];
$sql = mysql_query("SELECT * FROM `im_vw_stock` WHERE im_storeid='$final_f_word'") or die(mysql_error());
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Summary Stock Balance',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'For '.$final_f_word,0,0,'C');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(0,0,'As at '.$from_date,0,0,'C');
  $pdf->Ln(10);
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 40;
  $y_axis_initial2 = 40;
  $row_height = 18;
  $row_height2 = 10;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(30, $row_height, 'Product code', 1, 0, 'C', 1);
  $pdf->Cell(100, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Quantity', 1, 0, 'C', 1);
  $y = $pdf->GetY();
  $x = $pdf->GetX(); 
  $y4 = $pdf->GetY();
  $x4 = $pdf->GetX();
  $width = 65;
  $pdf->MultiCell($width, 9, 'Weighted Average Cost rate (per product)', 1,0, 'L', 1);
  $pdf->SetXY($x + $width, $y);
  $y2 = $pdf->GetY();
  $x2 = $pdf->GetX();
  $width2 = 35;
  $pdf->MultiCell($width2, 9, 'Sales price (per product)', 1,0, 'L', 1);
  $pdf->SetXY($x2 + $width2, $y2);
  $y3 = $pdf->GetY();
  $x3 = $pdf->GetX();
  $width3 = 30;
  $pdf->MultiCell($width3, 9, 'Total value in stock', 1,0, 'L', 1);
  //$pdf->Ln(10);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
    $cm_code = $row['cm_code'];
    $query = mysql_query("SELECT * FROM `im_grndetail` WHERE cm_code='$cm_code'") or die(mysql_error());
    $r = mysql_fetch_array($query);
    $ro = mysql_num_rows($query);
    if($ro==1 or $ro == 0){
      $ro = '';
    }else{
      $ro = $r['cm_code'];
    }

    $cquery = mysql_query("SELECT COUNT(`im_costprice`) AS total, SUM(`im_costprice`) AS total_money FROM im_grndetail WHERE `cm_code`='$ro'");
    $rr = mysql_fetch_array($cquery);
    $total = $rr['total'];
    $total_money = $rr['total_money'];
    if($total==0){
      $total = $r['im_costprice'];
    }else{
      $total = $total_money/$rr['total'];
    }

    $available = $row['available'];
    if($available<0){
      $available='';
    }
    $total_stock = $total*$available;
    $sales_price = $row['cm_sellrate'];
    mysql_query("INSERT INTO `temp_stock_summaery` VALUES('','$sales_price','$total_stock')");
    if ($i == $max){
      $pdf->Ln(10);
      $pdf->Cell(0, $row_height2, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial);
      //$pdf->SetX(10);
      $pdf->Cell(30, $row_height, 'Product code', 1, 0, 'C', 1);
      $pdf->Cell(100, $row_height, 'Product Name', 1, 0, 'C', 1);
      $pdf->Cell(20, $row_height, 'Quantity', 1, 0, 'C', 1);
      $y = $pdf->GetY();
      $x = $pdf->GetX(); 
      $y4 = $pdf->GetY();
      $x4 = $pdf->GetX();
      $width = 65;
      $pdf->MultiCell($width, 9, 'Weighted Average Cost rate (per product)', 1,0, 'L', 1);
      $pdf->SetXY($x + $width, $y);
      $y2 = $pdf->GetY();
      $x2 = $pdf->GetX();
      $width2 = 35;
      $pdf->MultiCell($width2, 9, 'Sales price (per product)', 1,0, 'L', FALSE);
      $pdf->SetXY($x2 + $width2, $y2);
      $y3 = $pdf->GetY();
      $x3 = $pdf->GetX();
      $width3 = 30;
      $pdf->MultiCell($width3, 9, 'Total value in stock', 1,0, 'L', FALSE);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height2;
      
    }
    //$pdf->Ln(5);
  $pdf->Cell(30, $row_height2, $row['cm_code'], 1, 0, 'C', 1);
  $pdf->Cell(100, $row_height2, $row['cm_name'], 1, 0, 'L', 1);
  $pdf->Cell(20, $row_height2, $available, 1, 0, 'C', 1);
  $pdf->Cell(65, $row_height2, number_format($total,2), 1,0, 'C', 1);
  $pdf->Cell(35, $row_height2, number_format($row['cm_sellrate'],2), 1, 0,'C', 1);
  $pdf->Cell(30, $row_height2, number_format($total_stock,2), 1,0, 'C', 1);
    $y_axis = $y_axis + $row_height2;
    $i = $i + 1;
  $pdf->Ln(10);
  }
  $pdf->Ln(8);
  $sum_sales = mysql_query("SELECT SUM(`sales_price`) AS sales FROM `temp_stock_summaery`");
  $sr = mysql_fetch_array($sum_sales);
  $sum_sales2 = mysql_query("SELECT SUM(`total_stock`) AS t_stok FROM `temp_stock_summaery`");
  $sr2 = mysql_fetch_array($sum_sales2);
  $pdf->Cell(215, $row_height2, 'Total', 0, 0, 'R', 0);
  $pdf->Cell(35, $row_height2, number_format($sr['sales'],2), 0, 0, 'C', 0);
  $pdf->Cell(30, $row_height2, number_format($sr2['t_stok'],2), 0, 0, 'C', 0);
  $pdf->Output();
  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Summary Stock Balance</h2><br>
          <h3 class="text-center">For '.$final_f_word.'</h3>
          <h5 class="text-center">As at  '.$from_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Product code</th>
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Quantity</th>
          <th style="border:1px solid #000; text-align:center">Weighted Average Cost rate (per product)</th>
          <th style="border:1px solid #000; text-align:center">Sales price (per product)</th>
          <th style="border:1px solid #000; text-align:center">Total value in stock</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql)){  
           $cm_code = $row['cm_code'];
         $query = mysql_query("SELECT * FROM `im_grndetail` WHERE cm_code='$cm_code'") or die(mysql_error());
         $r = mysql_fetch_array($query);
         $ro = mysql_num_rows($query);
         if($ro==1 or $ro == 0){
           $ro = '';
         }else{
           $ro = $r['cm_code'];
         }
         $cquery = mysql_query("SELECT COUNT(`im_costprice`) AS total, SUM(`im_costprice`) AS total_money FROM im_grndetail WHERE `cm_code`='$ro'");
         $rr = mysql_fetch_array($cquery);
            $total = $rr['total'];
                      $total_money = $rr['total_money'];
                      if($total==0){
                        $total = $r['im_costprice'];
                      }else{
                        $total = $total_money/$rr['total'];
                      }
          $available = $row['available'];
                      if($available<0){
                        $available='';
                      }
                       $total_stock = $total*$available;
                       $sales_price = $row['cm_sellrate'];
                       mysql_query("INSERT INTO `temp_stock_summaery` VALUES('','$sales_price','$total_stock')");
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
              <td style="border:1px solid #000; text-align:left">'.$row['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$available.'</td>
              <td style="border:1px solid #000; text-align:center">'.$total.'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_sellrate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$total_stock.'</td>
            </tr>  
                ';  
    }  
    $sum_sales = mysql_query("SELECT SUM(`sales_price`) AS sales FROM `temp_stock_summaery`");
                    $sr = mysql_fetch_array($sum_sales);
                    $sum_sales2 = mysql_query("SELECT SUM(`total_stock`) AS t_stok FROM `temp_stock_summaery`");
                    $sr2 = mysql_fetch_array($sum_sales2);
                    $output.='
                    <tr>
                        <td colspan="4" class="text-right"><b>Total</b></td>
                        <td><b>'.$sr['sales'].'</b></td>
                        <td><b>'.$sr2['t_stok'].'</b></td>
                      </tr>
                    ';
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Summary Stock Report.xls");  
    echo $output;  
  }

}  
mysql_query("DELETE  FROM `temp_stock_summaery`") or die(mysql_error());
?>