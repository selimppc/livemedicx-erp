
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
if($f_word == true){
    $sql = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$f_word'") or die(mysql_error());
}elseif($f_word == false){
    $sql = mysql_query("SELECT * FROM `cm_customermst`") or die(mysql_error());
}else{}

$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Customer List Report',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(0,0,'From : '.$from_date. ' To '.$to_date,0,0,'C');
  $pdf->Ln(5);
  
  
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 30;
  $y_axis_initial2 = 30;
  $row_height = 14;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  $start_x=$pdf->GetX();
  $current_y = $pdf->GetY();
  $current_x = $pdf->GetX();
  $cell_width = 20;
  $cell_height=7;
  $pdf->SetX(10);
  $pdf->Cell(25, $row_height, 'Customer Code', 1, 0, 'C', 1);
  $pdf->Cell(28, $row_height, 'Customer Group', 1, 0, 'C', 1);
  $pdf->Cell(28, $row_height, 'Customer Name', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Address', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Cell Phone', 1, 0, 'C', 1);
  $pdf->Cell(50, $row_height, 'Email', 1, 0, 'C', 1);
  $pdf->Cell(30, $row_height, 'Gerant ID', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Sales Person', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Branch', 1, 0, 'C', 1);
  $pdf->MultiCell($cell_width,$cell_height,'Outstanding Balance',1, 0);
  $current_x+=$cell_width;
  $pdf->SetXY($current_x, $current_y);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
       $cm_cuscode = $row['cm_cuscode'];
       $query = mysql_query("SELECT * FROM `sm_header` WHERE cm_cuscode='$cm_cuscode'");
       $cr = mysql_fetch_array($query);
	   $sm_number = $cr['sm_number'];
     $sm_netamt = $cr['sm_netamt'];
       $query2 = mysql_query("SELECT * FROM `sm_invalc` WHERE sm_number='$sm_number'");
       $br = mysql_fetch_array($query2);
       $sm_amount = $br['sm_amount'];
       $balance = $sm_netamt-$sm_amount;
    if ($i == $max){
      $pdf->Ln(10);
      $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial2);
      $pdf->SetX(10);
      $pdf->Cell(25, $row_height, 'Customer Code', 1, 0, 'C', 1);
	  $pdf->Cell(28, $row_height, 'Customer Group', 1, 0, 'C', 1);
	  $pdf->Cell(28, $row_height, 'Customer Name', 1, 0, 'C', 1);
	  $pdf->Cell(25, $row_height, 'Address', 1, 0, 'C', 1);
	  $pdf->Cell(25, $row_height, 'Cell Phone', 1, 0, 'C', 1);
	  $pdf->Cell(50, $row_height, 'Email', 1, 0, 'C', 1);
	  $pdf->Cell(30, $row_height, 'Gerant ID', 1, 0, 'C', 1);
	  $pdf->Cell(25, $row_height, 'Sales Person', 1, 0, 'C', 1);
	  $pdf->Cell(25, $row_height, 'Branch', 1, 0, 'C', 1);
	  $pdf->MultiCell($cell_width,$cell_height,'Outstanding Balance',1, 0);
	  $current_x+=$cell_width;
      $pdf->SetXY($current_x, $current_y);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height;
      
    }
    $cm_cuscode = $row['cm_cuscode'];
    $cm_group = $row['cm_group'];
    $cm_name = $row['cm_name'];
    $cm_address = $row['cm_address'];
    $cm_cellnumber = $row['cm_cellnumber'];
    $cm_email = $row['cm_email'];
    $gerant_id = $row['gerant_id'];
	$cm_sp = $row['cm_sp'];
	$cm_branch = $row['cm_branch'];


    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(25, $row_height, $cm_cuscode, 1, 0, 'L', 1);
    $pdf->Cell(28, $row_height, $cm_group, 1, 0, 'L', 1);
    $pdf->Cell(28, $row_height, $cm_name, 1, 0, 'L', 1);
    $pdf->Cell(25, $row_height, $cm_address, 1, 0, 'L', 1);
	$pdf->Cell(25, $row_height, $cm_cellnumber, 1, 0, 'L', 1);
    $pdf->Cell(50, $row_height, $cm_email, 1, 0, 'L', 1);
    $pdf->Cell(30, $row_height, $gerant_id, 1, 0, 'L', 1);
    $pdf->Cell(25, $row_height, $cm_sp, 1, 0, 'L', 1);
    $pdf->Cell(25, $row_height, $cm_branch, 1, 0, 'L', 1);
	$pdf->Cell(20,$row_height,$balance,1, 0);

    $y_axis = $y_axis + $row_height;

    $i = $i + 1;
    

  }
  $pdf->Output();





  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Customer List Report</h2>
          <h5 class="text-center">From: '.$from_date.' To: '.$to_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Customer Code</th>
          <th style="border:1px solid #000; text-align:center">Customer Group</th>
          <th style="border:1px solid #000; text-align:center">Customer Name</th>
          <th style="border:1px solid #000; text-align:center">Address</th>
          <th style="border:1px solid #000; text-align:center">Cell Phone</th>
          <th style="border:1px solid #000; text-align:center">Email</th>
          <th style="border:1px solid #000; text-align:center">Gerant ID</th>
          <th style="border:1px solid #000; text-align:center">Sales Person</th>
          <th style="border:1px solid #000; text-align:center">Branch</th>
          <th style="border:1px solid #000; text-align:center">Outstanding Balance</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            $cm_cuscode = $row['cm_cuscode'];
            $query = mysql_query("SELECT * FROM `sm_header` WHERE cm_cuscode='$cm_cuscode'");
            $cr = mysql_fetch_array($query);
            $sm_number = $cr['sm_number'];
            $sm_netamt = $cr['sm_netamt'];
            $query2 = mysql_query("SELECT * FROM `sm_invalc` WHERE sm_number='$sm_number'");
            $br = mysql_fetch_array($query2);
            $sm_amount = $br['sm_amount'];
            $balance = $sm_netamt-$sm_amount;
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['cm_cuscode'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_group'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_name'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_address'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_cellnumber'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_email'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['gerant_id'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_sp'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_branch'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$balance.'</td>
            </tr>  
                ';  
    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Customer List Report.xls");  
    echo $output;  
  }

}  

?>