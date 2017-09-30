
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
if($f_word == true){
    $sql = mysql_query("SELECT * FROM `cm_branchmaster` WHERE cm_branch='$f_word'") or die(mysql_error());
}elseif($f_word == false){
    $sql = mysql_query("SELECT * FROM `cm_branchmaster`") or die(mysql_error());
}else{}

$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Branch List Report',0,0,'C');
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
  $pdf->Cell(30, $row_height, 'Branch', 1, 0, 'C', 1);
  $pdf->Cell(45, $row_height, 'Branch Description', 1, 0, 'C', 1);
  $pdf->Cell(50, $row_height, 'Contact Person', 1, 0, 'C', 1);
  $pdf->Cell(50, $row_height, 'Email', 1, 0, 'C', 1);
  $pdf->Cell(50, $row_height, 'Cell Phone', 1, 0, 'C', 1);
  $pdf->Cell(50, $row_height, 'Phone', 1, 0, 'C', 1);
  $current_x+=$cell_width;
  $pdf->SetXY($current_x, $current_y);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
   while($row = mysql_fetch_array($sql)){
       
    if ($i == $max){
      $pdf->Ln(10);
      $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
      $pdf->AddPage();
      $pdf->SetY($y_axis_initial2);
      $pdf->SetX(10);
      $pdf->Cell(30, $row_height, 'Branch', 1, 0, 'C', 1);
	  $pdf->Cell(45, $row_height, 'Branch Description', 1, 0, 'C', 1);
	  $pdf->Cell(50, $row_height, 'Contact Person', 1, 0, 'C', 1);
	  $pdf->Cell(50, $row_height, 'Email', 1, 0, 'C', 1);
	  $pdf->Cell(50, $row_height, 'Cell Phone', 1, 0, 'C', 1);
	  $pdf->Cell(50, $row_height, 'Phone', 1, 0, 'C', 1);
      $i = 0;
      $y_axis = $y_axis_initial2 + $row_height;
      
    }
    $cm_branch = $row['cm_branch'];
    $cm_description = $row['cm_description'];
    $cm_contacperson = $row['cm_contacperson'];
    $cm_mailingaddress = $row['cm_mailingaddress'];
    $cm_cell = $row['cm_cell'];
    $cm_phone = $row['cm_phone'];

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(30, $row_height, $cm_branch, 1, 0, 'L', 1);
    $pdf->Cell(45, $row_height, $cm_description, 1, 0, 'L', 1);
    $pdf->Cell(50, $row_height, $cm_contacperson, 1, 0, 'L', 1);
    $pdf->Cell(50, $row_height, $cm_mailingaddress, 1, 0, 'L', 1);
	$pdf->Cell(50, $row_height, $cm_cell, 1, 0, 'L', 1);
    $pdf->Cell(50, $row_height, $cm_phone, 1, 0, 'L', 1);

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
          <h2 class="text-center">Branch List Report</h2>
          <h5 class="text-center">From: '.$from_date.' To: '.$to_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Branch</th>
          <th style="border:1px solid #000; text-align:center">Branch Description</th>
          <th style="border:1px solid #000; text-align:center">Contact Person</th>
          <th style="border:1px solid #000; text-align:center">Email</th>
          <th style="border:1px solid #000; text-align:center">Cell Phone</th>
          <th style="border:1px solid #000; text-align:center">Phone</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['cm_branch'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_description'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_contacperson'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_mailingaddress'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_cell'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['cm_phone'].'</td>
            </tr>  
                ';  
    }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Branceh List Report.xls");  
    echo $output;  
  }

}  

?>