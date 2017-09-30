
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$second_word = $_GET['second_word'];
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF();
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Product & Service List Report',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,0,'Product',0,0,'C');
  //$pdf->Ln(10);
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 23;
  $row_height = 10;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 8);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
  $pdf->Cell(130, $row_height, 'Product Name', 1, 0, 'C', 1);
  $pdf->Cell(16, $row_height, 'Sell Price', 1, 0, 'C', 1);
  $pdf->Cell(16, $row_height, 'Cost Price', 1, 0, 'C', 1);
  $pdf->Cell(16, $row_height, 'Sell Unit', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Sell U.Qty', 1, 0, 'C', 1);
  $pdf->Cell(16, $row_height, 'Pur. Unit', 1, 0, 'C', 1);
  $pdf->Cell(20, $row_height, 'Pur. Unit Qty', 1, 0, 'C', 1);
  $pdf->Cell(15, $row_height, 'Currency', 1, 0, 'C', 1);
  $pdf->Ln(10);
  $i = 0;
  $max = 14;
  $y_axis = $y_axis_initial + $row_height;
  if($second_word==false && $f_word==false){
    $sql1 = mysql_query("SELECT DISTINCT(`cm_category`) as Category, count(`cm_category`) AS Count FROM cm_productmaster GROUP BY cm_category HAVING Count > 1") or die(mysql_error());
    while($r = mysql_fetch_array($sql1)){
      $p_cat = $r['Category'];
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(28, $row_height, 'Category', 1, 0, 'L', 1);
      $pdf->Cell(249, $row_height, $p_cat, 1, 0, 'L', 1);
      $pdf->Ln(10);
      $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$p_cat'")or die(mysql_error());
      while($row = mysql_fetch_array($sql)){
        if ($i == $max){
          $pdf->Ln(10);
          $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
          $pdf->AddPage();
          $pdf->SetY($y_axis_initial);
          $pdf->SetX(10);
          $pdf->SetFont('Arial', '', 8);
          $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
          $pdf->Cell(130, $row_height, 'Product Name', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Cost Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Sell U.Qty', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Pur. Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Pur. Unit Qty', 1, 0, 'C', 1);
          $pdf->Cell(15, $row_height, 'Currency', 1, 0, 'C', 1);
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
        $pdf->SetFont('Arial', '', 8);
        $cm_code = $row['cm_code'];
        $cm_name = $row['cm_name'];
        $cm_sellrate = $row['cm_sellrate'];
        $cm_costprice = $row['cm_costprice'];
        $cm_sellunit = $row['cm_sellunit'];
        $cm_sellconfact = $row['cm_sellconfact'];
        $cm_purunit = $row['cm_purunit'];
        $cm_purconfact = $row['cm_purconfact'];
        $currency = $row['currency'];
        $pdf->Cell(28, $row_height, $cm_code, 1, 0, 'L', 1);
        $pdf->Cell(130, $row_height, $cm_name, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellrate, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_costprice, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_sellconfact, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_purunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_purconfact, 1, 0, 'L', 1);
        $pdf->Cell(15, $row_height, $currency, 1, 0, 'L', 1);
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
      }
    }
  }elseif($second_word==true && $f_word==true){
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(28, $row_height, 'Category', 1, 0, 'L', 1);
    $pdf->Cell(249, $row_height, $second_word, 1, 0, 'L', 1);
    $pdf->Ln(10);
    $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$second_word' AND cm_class='$f_word'") or die(mysql_error());
    while($row = mysql_fetch_array($sql)){
      if ($i == $max){
          $pdf->Ln(10);
          $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
          $pdf->AddPage();
          $pdf->SetY($y_axis_initial);
          $pdf->SetX(10);
          $pdf->SetFont('Arial', '', 8);
          $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
          $pdf->Cell(130, $row_height, 'Product Name', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Cost Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Sell U.Qty', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Pur. Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Pur. Unit Qty', 1, 0, 'C', 1);
          $pdf->Cell(15, $row_height, 'Currency', 1, 0, 'C', 1);
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
        $pdf->SetFont('Arial', '', 8);
        $cm_code = $row['cm_code'];
        $cm_name = $row['cm_name'];
        $cm_sellrate = $row['cm_sellrate'];
        $cm_costprice = $row['cm_costprice'];
        $cm_sellunit = $row['cm_sellunit'];
        $cm_sellconfact = $row['cm_sellconfact'];
        $cm_purunit = $row['cm_purunit'];
        $cm_purconfact = $row['cm_purconfact'];
        $currency = $row['currency'];
        $pdf->Cell(28, $row_height, $cm_code, 1, 0, 'L', 1);
        $pdf->Cell(130, $row_height, $cm_name, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellrate, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_costprice, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_sellconfact, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_purunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_purconfact, 1, 0, 'L', 1);
        $pdf->Cell(15, $row_height, $currency, 1, 0, 'L', 1);
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
    }
  }elseif($second_word==true && $f_word==false){
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(28, $row_height, 'Category', 1, 0, 'L', 1);
    $pdf->Cell(249, $row_height, $second_word, 1, 0, 'L', 1);
    $pdf->Ln(10);
    $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$second_word'") or die(mysql_error());
    while($row = mysql_fetch_array($sql)){
      if ($i == $max){
          $pdf->Ln(10);
          $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
          $pdf->AddPage();
          $pdf->SetY($y_axis_initial);
          $pdf->SetX(10);
          $pdf->SetFont('Arial', '', 8);
          $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
          $pdf->Cell(130, $row_height, 'Product Name', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Cost Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Sell U.Qty', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Pur. Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Pur. Unit Qty', 1, 0, 'C', 1);
          $pdf->Cell(15, $row_height, 'Currency', 1, 0, 'C', 1);
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
        $pdf->SetFont('Arial', '', 8);
        $cm_code = $row['cm_code'];
        $cm_name = $row['cm_name'];
        $cm_sellrate = $row['cm_sellrate'];
        $cm_costprice = $row['cm_costprice'];
        $cm_sellunit = $row['cm_sellunit'];
        $cm_sellconfact = $row['cm_sellconfact'];
        $cm_purunit = $row['cm_purunit'];
        $cm_purconfact = $row['cm_purconfact'];
        $currency = $row['currency'];
        $pdf->Cell(28, $row_height, $cm_code, 1, 0, 'L', 1);
        $pdf->Cell(130, $row_height, $cm_name, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellrate, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_costprice, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_sellconfact, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_purunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_purconfact, 1, 0, 'L', 1);
        $pdf->Cell(15, $row_height, $currency, 1, 0, 'L', 1);
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
    }
  }elseif($second_word==false && $f_word==true){
    $sql1 = mysql_query("SELECT DISTINCT(`cm_category`) as Category, count(`cm_category`) AS Count FROM cm_productmaster GROUP BY cm_category HAVING Count > 1") or die(mysql_error());
    while($r = mysql_fetch_array($sql1)){
      $p_cat = $r['Category'];
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(28, $row_height, 'Category', 1, 0, 'L', 1);
      $pdf->Cell(249, $row_height, $p_cat, 1, 0, 'L', 1);
      $pdf->Ln(10);
      $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$p_cat'")or die(mysql_error());
      while($row = mysql_fetch_array($sql)){
        if ($i == $max){
          $pdf->Ln(10);
          $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
          $pdf->AddPage();
          $pdf->SetY($y_axis_initial);
          $pdf->SetX(10);
          $pdf->SetFont('Arial', '', 8);
          $pdf->Cell(28, $row_height, 'Code', 1, 0, 'C', 1);
          $pdf->Cell(130, $row_height, 'Product Name', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Cost Price', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Sell Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Sell U.Qty', 1, 0, 'C', 1);
          $pdf->Cell(16, $row_height, 'Pur. Unit', 1, 0, 'C', 1);
          $pdf->Cell(20, $row_height, 'Pur. Unit Qty', 1, 0, 'C', 1);
          $pdf->Cell(15, $row_height, 'Currency', 1, 0, 'C', 1);
          $pdf->Ln(10);
          $i = 0;
          $y_axis = $y_axis_initial + $row_height;
        }
        $pdf->SetFont('Arial', '', 8);
        $cm_code = $row['cm_code'];
        $cm_name = $row['cm_name'];
        $cm_sellrate = $row['cm_sellrate'];
        $cm_costprice = $row['cm_costprice'];
        $cm_sellunit = $row['cm_sellunit'];
        $cm_sellconfact = $row['cm_sellconfact'];
        $cm_purunit = $row['cm_purunit'];
        $cm_purconfact = $row['cm_purconfact'];
        $currency = $row['currency'];
        $pdf->Cell(28, $row_height, $cm_code, 1, 0, 'L', 1);
        $pdf->Cell(130, $row_height, $cm_name, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellrate, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_costprice, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_sellunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_sellconfact, 1, 0, 'L', 1);
        $pdf->Cell(16, $row_height, $cm_purunit, 1, 0, 'L', 1);
        $pdf->Cell(20, $row_height, $cm_purconfact, 1, 0, 'L', 1);
        $pdf->Cell(15, $row_height, $currency, 1, 0, 'L', 1);
        $pdf->Ln(10);
        $y_axis = $y_axis + $row_height;
        $i = $i + 1;
      }
    }
  }


  $pdf->Output();

  }elseif(isset($_POST["export_excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  $output.='
  <table class="table table-bordered">
    <tr>
      <th colspan="9" align="center"><h2>Product & Service List Report</h2></th>  
    </tr>
    <tr>
      <th colspan="9" align="center"><h3>Product</h3></th>   
    </tr>
    <tr>
      <th style="border:1px solid #000; text-align:center">Code</th>
      <th style="border:1px solid #000; text-align:center">Product Name</th>
      <th style="border:1px solid #000; text-align:center">Sell Price</th>
      <th style="border:1px solid #000; text-align:center">Cost Price</th>
      <th style="border:1px solid #000; text-align:center">Sell Unit</th>
      <th style="border:1px solid #000; text-align:center">Sell Unit Qty</th>
      <th style="border:1px solid #000; text-align:center">Pur. Unit</th>
      <th style="border:1px solid #000; text-align:center">Pur. Unit Qty</th>
      <th style="border:1px solid #000; text-align:center">Currency</th>
    </tr>
  ';
  if($second_word==false && $f_word==false){
    $sql1 = mysql_query("SELECT DISTINCT(`cm_category`) as Category, count(`cm_category`) AS Count FROM cm_productmaster GROUP BY cm_category HAVING Count > 1") or die(mysql_error());
    while($r = mysql_fetch_array($sql1)){
      $p_cat = $r['Category'];
      $output.='
      <tr>
        <th style="border:0px;">Category:</th>
        <th style="border:0px;">'.$p_cat.'</th>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        </tr>
      ';
      $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$p_cat'")or die(mysql_error());
      while($row = mysql_fetch_array($sql)){
        $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_name'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellrate'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_costprice'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['currency'].'</td>
        </tr>
        ';
      }
    }
  }elseif($second_word==true && $f_word==true){
      $output.='
      <tr>
        <th style="border:0px;">Category:</th>
        <th style="border:0px;">'.$second_word.'</th>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        </tr>
      ';
      $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$second_word' AND cm_class='$f_word'") or die(mysql_error());
      while($row = mysql_fetch_array($sql)){
        $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_name'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellrate'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_costprice'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['currency'].'</td>
        </tr>
        ';
      }
  }elseif($second_word==true && $f_word==false){
    $output.='
      <tr>
        <th style="border:0px;">Category:</th>
        <th style="border:0px;">'.$second_word.'</th>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        </tr>
      ';
      $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$second_word'") or die(mysql_error());
      while($row = mysql_fetch_array($sql)){
        $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_name'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellrate'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_costprice'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['currency'].'</td>
        </tr>
        ';
      }
  }elseif($second_word==false && $f_word==true){
    $sql1 = mysql_query("SELECT DISTINCT(`cm_category`) as Category, count(`cm_category`) AS Count FROM cm_productmaster GROUP BY cm_category HAVING Count > 1") or die(mysql_error());
    while($r = mysql_fetch_array($sql1)){
      $p_cat = $r['Category'];
      $output.='
      <tr>
        <th style="border:0px;">Category:</th>
        <th style="border:0px;">'.$p_cat.'</th>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        <td style="border:0px;"></td>
        </tr>
      ';
      $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$p_cat' AND cm_class='$f_word'") or die(mysql_error());
      while($row = mysql_fetch_array($sql)){
        $output.='
        <tr>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_code'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_name'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellrate'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_costprice'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_sellconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purunit'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['cm_purconfact'].'</td>
          <td style="border:1px solid #000; text-align:center">'.$row['currency'].'</td>
        </tr>
        ';
      }
    }
  } 
  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Product List.xls");  
    echo $output;  
  }



?>