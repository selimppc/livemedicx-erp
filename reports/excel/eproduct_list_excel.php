
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$cm_code = $_GET['cm_code'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
$sql='';
if($f_word==false){
  $sql = mysql_query("SELECT * FROM `cm_productmaster`") or die(mysql_error());
}else{
 $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$f_word'") or die(mysql_error()); 
}

 $r = mysql_fetch_array($sql);
 $cm_code = $r['cm_code'];
 $sql2 = mysql_query("SELECT * FROM `im_grndetail` WHERE cm_code='$cm_code'") or die(mysql_error());
 $rg = mysql_fetch_array($sql2);
 $im_grnnumber = $rg['im_grnnumber'];
 $sql3 = mysql_query("SELECT * FROM `im_grnheader` WHERE im_grnnumber='$im_grnnumber'") or die(mysql_error());
 $st = mysql_fetch_array($sql3);
$im_store = $st['im_store'];
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Expired Product List',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'For '.$im_store,0,0,'C');
  $pdf->Ln(8);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(0,0,'Product Category : '.$f_word,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(0,0,'From : '.$from_date. ' To '.$to_date,0,0,'C');
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 40;
  $y_axis_initial2 = 40;
  $row_height = 12;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(25, $row_height, 'Product code', 1, 0, 'C', 1);
  $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(18, $row_height, 'Cost Rate', 1, 0, 'C', 1);
  $pdf->Cell(18, $row_height, 'Sales Rate', 1, 0, 'C', 1);
  $pdf->Cell(23, $row_height, 'Batch Number', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Expiry Date', 1, 0, 'C', 1);
  $pdf->Cell(30, $row_height, 'Quantity Expired', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Total Value', 1, 0, 'C', 1);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
       $p_code = $row['cm_code'];
       $query = mysql_query("SELECT * FROM im_vw_grndetail WHERE cm_code='$p_code' AND im_ExpireDate BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
       $rr = mysql_fetch_array($query);
       $a = $row['cm_costprice'];
       $b = $rr['im_RcvQuantity'];
       $c = $a*$b;
    if ($i == $max){
      $pdf->Ln(10);
      $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial2);
      $pdf->SetX(10);
      $pdf->Cell(25, $row_height, 'Product Code', 1, 0, 'C', 1);
      $pdf->Cell(120, $row_height, 'Product Name', 1, 0, 'C', 1);
      $pdf->Cell(18, $row_height, 'Cost Rate', 1, 0, 'C', 1);
      $pdf->Cell(18, $row_height, 'Sales Rate', 1, 0, 'C', 1);
      $pdf->Cell(23, $row_height, 'Batch Number', 1, 0, 'C', 1);
      $pdf->Cell(20, $row_height, 'Expiry Date', 1, 0, 'C', 1);
      $pdf->Cell(30, $row_height, 'Q.Expired', 1, 0, 'C', 1);
      $pdf->Cell(25, $row_height, 'Total Value', 1, 0, 'C', 1);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height;
      
    }
    $cm_code = $row['cm_code'];
    $cm_name = $row['cm_name'];
    $cm_costprice = $row['cm_costprice'];
    $cm_sellrate = $row['cm_sellrate'];
    $im_BatchNumber = $rr['im_BatchNumber'];
    $im_ExpireDate = $rr['im_ExpireDate'];
    $im_RcvQuantity = $rr['im_RcvQuantity'];

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(25, $row_height, $cm_code, 1, 0, 'L', 1);
    $pdf->Cell(120, $row_height, $cm_name, 1, 0, 'L', 1);
    $pdf->Cell(18, $row_height, $cm_costprice, 1, 0, 'L', 1);
    $pdf->Cell(18, $row_height, $cm_sellrate, 1, 0, 'L', 1);
    $pdf->Cell(23, $row_height, $im_BatchNumber, 1, 0, 'L', 1);
    $pdf->Cell(20, $row_height, $im_ExpireDate, 1, 0, 'L', 1);
    $pdf->Cell(30, $row_height, $im_RcvQuantity, 1, 0, 'L', 1);
    $pdf->Cell(25, $row_height, $c, 1, 0, 'L', 1);


    $y_axis = $y_axis + $row_height;

    $i = $i + 1;
    

  }
  $pdf->Output();





  }elseif(isset($_POST["export_excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
$sql='';
if($f_word==false){
  $sql = mysql_query("SELECT * FROM `cm_productmaster`") or die(mysql_error());
}else{
 $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$f_word'") or die(mysql_error()); 
}
 $r = mysql_fetch_array($sql);
 $cm_code = $r['cm_code'];
 $sql2 = mysql_query("SELECT * FROM `im_grndetail` WHERE cm_code='$cm_code'") or die(mysql_error());
 $rg = mysql_fetch_array($sql2);
 $im_grnnumber = $rg['im_grnnumber'];
 $sql3 = mysql_query("SELECT * FROM `im_grnheader` WHERE im_grnnumber='$im_grnnumber'") or die(mysql_error());
 $st = mysql_fetch_array($sql3);
  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Expired Product List</h2><br>
          <h3 class="text-center">For "'.$st['im_store'].'"</h3>
          <h4 class="text-center">Product Category : '.$f_word.'</h4>
          <h5 class="text-center">From: '.$from_date.' To: '.$to_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Product code</th>
          <th style="border:1px solid #000; text-align:center">Product Name</th>
          <th style="border:1px solid #000; text-align:center">Cost Rate</th>
          <th style="border:1px solid #000; text-align:center">Sales Rate</th>
          <th style="border:1px solid #000; text-align:center">Batch Number</th>
          <th style="border:1px solid #000; text-align:center">Expiry Date</th>
          <th style="border:1px solid #000; text-align:center">Quantity Expired</th>
          <th style="border:1px solid #000; text-align:center">Total Value</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            $p_code = $row['cm_code'];
            $query = mysql_query("SELECT * FROM im_vw_grndetail WHERE cm_code='$p_code' AND im_ExpireDate BETWEEN '$from_date' AND '$to_date'") or die(mysql_error());
            $rr = mysql_fetch_array($query);
            $a = $row['cm_costprice'];
            $b = $rr['im_RcvQuantity'];
             $c = $a*$b;
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_costprice'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_sellrate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$rr['im_BatchNumber'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$rr['im_ExpireDate'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$rr['im_RcvQuantity'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$c.'</td>
            </tr>  
                ';  
    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=download.xls");  
    echo $output;  
  }

}  

?>