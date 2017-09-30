
<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];

$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',25);
  $pdf->Cell(0,0,'Chart of Account List',0,0,'L');
  $pdf->SetAutoPageBreak(false);
  $pdf->SetLineWidth(0.5);
  $pdf->Line(10,20,150,20);
  $y_axis_initial = 30;
  $y_axis_initial2 = 30;
  $row_height = 12;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(25, $row_height, 'Code', 0, 0, 'L', 1);
  $pdf->Cell(65, $row_height, 'Description', 0, 0, 'C', 1);
  $pdf->Cell(145, $row_height, 'Usage', 0, 0, 'R', 1);
  $pdf->Cell(30, $row_height, 'Status', 0, 0, 'R', 1);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $sql = '';
      if($f_word==true){
        $sql = mysql_query("SELECT * FROM  am_chartofaccounts, am_group_one, am_group_two WHERE (am_chartofaccounts.am_groupone=am_group_one.am_groupone) AND (am_chartofaccounts.am_grouptwo=am_group_two.am_grouptwo)AND am_chartofaccounts.am_accounttype='$f_word'") or die(mysql_error());
        $head = mysql_fetch_array($sql);
        $head_name = $head['am_accounttype'];
        $am_groupone = $head['am_groupone'];
        $pdf->Cell(25, $row_height, $head_name, 0, 0, 'L', 1);
        $pdf->Ln(10);
        $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
        while($row = mysql_fetch_array($subsql)){
          $am_grouptwo = $row['am_grouptwo'];
          $consql = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
          $pdf->SetFont('Arial', 'B', 14);
          $pdf->Cell(55, $row_height, $row['am_grouptwo'].'-'.$row['am_description'], 0, 0, 'L', 1);
          $pdf->Ln(10);
          while($con_row = mysql_fetch_array($consql)){
            if($i==$max){
              $pdf->Ln(10);
            $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
            $pdf->AddPage();
            $pdf->SetY($y_axis_initial2);
            $pdf->SetX(10);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(25, $row_height, 'Code', 0, 0, 'L', 1);
            $pdf->Cell(65, $row_height, 'Description', 0, 0, 'C', 1);
            $pdf->Cell(145, $row_height, 'Usage', 0, 0, 'R', 1);
            $pdf->Cell(30, $row_height, 'Status', 0, 0, 'R', 1);
            $pdf->Ln(10);
            $i = 0;
            $y_axis = $y_axis_initial2 + $row_height;
            }
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(15, $row_height, $con_row['am_accountcode'], 0, 0, 'L', 1);
            $pdf->Cell(45, $row_height, $con_row['am_description'], 0, 0, 'L', 1);
            $pdf->Cell(175, $row_height, $con_row['am_accountusage'], 0, 0, 'R', 1);
            $pdf->Cell(25, $row_height, $con_row['am_status'], 0, 0, 'R', 1);
            $pdf->Ln(10);
            $y_axis = $y_axis + $row_height;
            $i = $i + 1;
          }
        }
    }else{
      $sql = mysql_query("SELECT * FROM am_group_one")or die(mysql_error());
      while($head = mysql_fetch_array($sql)){
        $head_name = $head['am_description'];
        $am_groupone = $head['am_groupone'];
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(25, $row_height, $head_name, 0, 0, 'L', 1);
        $pdf->Ln(10);
        $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
        while($row = mysql_fetch_array($subsql)){
          $am_grouptwo = $row['am_grouptwo'];
          $consql = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
          $pdf->SetFont('Arial', '', 12);
          
          $pdf->SetFont('Arial', 'B', 12);
          $pdf->Cell(55, $row_height, $row['am_grouptwo'].'-'.$row['am_description'], 0, 0, 'L', 1);
          $pdf->Ln(10);
          while($con_row = mysql_fetch_array($consql)){
            if($i == $max){
             $pdf->Ln(10);
            $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
            $pdf->AddPage();
            $pdf->SetY($y_axis_initial2);
            $pdf->SetX(10);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(25, $row_height, 'Code', 0, 0, 'L', 1);
            $pdf->Cell(65, $row_height, 'Description', 0, 0, 'C', 1);
            $pdf->Cell(145, $row_height, 'Usage', 0, 0, 'R', 1);
            $pdf->Cell(30, $row_height, 'Status', 0, 0, 'R', 1);
            $pdf->Ln(10);
            $i = 0;
            $y_axis = $y_axis_initial2 + $row_height;
          }
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(15, $row_height, $con_row['am_accountcode'], 0, 0, 'L', 1);
            $pdf->Cell(45, $row_height, $con_row['am_description'], 0, 0, 'L', 1);
            $pdf->Cell(175, $row_height, $con_row['am_accountusage'], 0, 0, 'R', 1);
            $pdf->Cell(25, $row_height, $con_row['am_status'], 0, 0, 'R', 1);
            $pdf->Ln(10);
            $y_axis = $y_axis + $row_height;
        $i = $i + 1;
          }
          
        }
         
      }
    }


   


  $pdf->Output();





  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
 $sql = '';
                    if($f_word==true){
                      $sql = mysql_query("SELECT * FROM  am_chartofaccounts, am_group_one, am_group_two WHERE (am_chartofaccounts.am_groupone=am_group_one.am_groupone) AND (am_chartofaccounts.am_grouptwo=am_group_two.am_grouptwo)AND am_chartofaccounts.am_accounttype='$f_word'") or die(mysql_error());
                      $head = mysql_fetch_array($sql);
                    $head_name = $head['am_accounttype'];
                    $am_groupone = $head['am_groupone'];

  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '   <table  class="table table-borderless2">
      <tr>
                      <th colspan="4"align="left">'.$head_name.'</th>
                    </tr> 

           ';  
$subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                    while($row = mysql_fetch_array($subsql)){
                      $am_grouptwo = $row['am_grouptwo'];
                      $consql = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
                      $output .= '  
            <tr>
                        <th colspan="4">'.$row['am_grouptwo'].'-'.$row['am_description'].'</th>
                      </tr>
                ';  
                while($con_row = mysql_fetch_array($consql)){
                  $output .= '  
            <tr>
                        <td>'.$con_row['am_accountcode'].'</td>
                        <td>'.$con_row['am_description'].'</td>
                        <td>'.$con_row['am_accountusage'].'</td>
                        <td>'.$con_row['am_status'].'</td>
                      </tr>
                ';  
                }
                    }
            

    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=download.xls");  
    echo $output;  

}
}  
else{
  $sql = mysql_query("SELECT * FROM am_group_one")or die(mysql_error());
                      while($head = mysql_fetch_array($sql)){


                    $head_name = $head['am_description'];
                    $am_groupone = $head['am_groupone'];
                      if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '   <table  class="table table-borderless2">
      <tr>
                      <th colspan="4"align="left">'.$head_name.'</th>
                    </tr> 

           ';
           $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                     while($row = mysql_fetch_array($subsql)){
                       $am_grouptwo = $row['am_grouptwo'];
                      $consql = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
                      $output .= ' <tr>
                        <th colspan="4">'.$row['am_grouptwo'].'-'.$row['am_description'].'</th>
                       </tr>

           ';
           while($con_row = mysql_fetch_array($consql)){
            $output .= ' <tr>
                        <td>'.$con_row['am_accountcode'].'</td>
                        <td>'.$con_row['am_description'].'</td>
                        <td>'.$con_row['am_accountusage'].'</td>
                        <td>'.$con_row['am_status'].'</td>
                      </tr>
           ';
           }
                    }
           
                    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Chart of Account.xls");  
    echo $output;  
  }
                  }
}}
?>