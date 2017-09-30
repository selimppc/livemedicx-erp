
<?php
include('../connection/dB.php');
$f_word = $_GET['pp_store'];
$second_word = $_GET['cm_supplierid'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$sql='';
if($f_word == true && $second_word==true){
  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date,`cm_supplierid`='$second_word' AS supplier,`pp_store`='$f_word' AS pp_store FROM `pp_purchaseordhd` GROUP BY supplierid HAVING supplier >=1") or die(mysql_error());
}elseif($f_word==true && $second_word==false){
  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date, `pp_store`='$f_word' AS pp_store FROM `pp_purchaseordhd` GROUP BY supplierid HAVING pp_store >=1") or die(mysql_error());
}elseif($f_word==false && $second_word==true){
  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date,`cm_supplierid`='$second_word' AS supplier FROM `pp_purchaseordhd` GROUP BY supplierid HAVING supplier >=1") or die(mysql_error());
}elseif($f_word == false && $second_word==false){
  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date FROM `pp_purchaseordhd` GROUP BY supplierid HAVING pp_date >=1") or die(mysql_error());
}else{}
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Supplier List Report',0,0,'C');
  $pdf->SetFont('Arial','B',12);
  $pdf->Ln(10);
  $pdf->Cell(0,0,'Date From : '.$from_date. ' To '.$to_date,0,0,'C');
  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 40;
  $y_axis_initial2 = 40;
  $row_height = 14;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 8);
  $pdf->SetY($y_axis_initial);
  //for line breack
  $start_x=$pdf->GetX();
  $current_y = $pdf->GetY();
  $current_x = $pdf->GetX();
  $cell_width = 20;
  $cell_height=7;
  //for line break
  $pdf->SetX(10);
  $pdf->Cell(23, $row_height, 'Supplier Code', 1, 0, 'C', 1);
  $pdf->Cell(30, $row_height, 'Supplier Name', 1, 0, 'C', 1);
  $pdf->Cell(55, $row_height, 'Address', 1, 0, 'C', 1);
  $pdf->Cell(16, $row_height, 'City', 1, 0, 'C', 1);
  $pdf->Cell(16, $row_height, 'ZIP Code', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Country', 1, 0, 'C', 1);
  $pdf->Cell(28, $row_height, 'Contact Person', 1, 0, 'C', 1);
  $pdf->Cell(32, $row_height, 'Cell Phone Number', 1, 0, 'C', 1);
  $pdf->Cell(40, $row_height, 'Email', 1, 0, 'C', 1);
  $pdf->MultiCell($cell_width,$cell_height,'Outstanding Balance',1, 0);
  $current_x+=$cell_width;
  $pdf->SetXY($current_x, $current_y);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
    while($row = mysql_fetch_array($sql)){
        $supplier_id = $row['supplierid'];
        $query = mysql_query("SELECT am_vouchernumber, SUM(im_netamt) AS im_netamt FROM im_grnheader WHERE cm_supplierid='$supplier_id'");
        $rq = mysql_fetch_array($query);
        $im_netamt = $rq['im_netamt'];
        $am_vouchernumber = $rq['am_vouchernumber'];
        $query2 = mysql_query("SELECT * FROM am_apalc WHERE am_invnumber='$am_vouchernumber'") or die(mysql_error());
        $rq2 = mysql_fetch_array($query2);
        $am_amount = $rq2['am_amount'];
        $balance = $im_netamt-$am_amount;
        mysql_query("INSERT INTO `balance` VALUES('','$balance')") or die(mysql_error());
        $sq = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$supplier_id'");
        $r = mysql_fetch_array($sq);
     if ($i == $max){
       $pdf->Ln(10);
       $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
       $pdf->AddPage();
       $pdf->SetY($y_axis_initial2);
       $pdf->SetX(10);
        $pdf->Cell(23, $row_height, 'Supplier Code', 1, 0, 'C', 1);
        $pdf->Cell(30, $row_height, 'Supplier Name', 1, 0, 'C', 1);
        $pdf->Cell(55, $row_height, 'Address', 1, 0, 'C', 1);
        $pdf->Cell(16, $row_height, 'City', 1, 0, 'C', 1);
        $pdf->Cell(16, $row_height, 'ZIP Code', 1, 0, 'C', 1);
        $pdf->Cell(25, $row_height, 'Country', 1, 0, 'C', 1);
        $pdf->Cell(28, $row_height, 'Contact Person', 1, 0, 'C', 1);
        $pdf->Cell(32, $row_height, 'Cell Phone Number', 1, 0, 'C', 1);
        $pdf->Cell(40, $row_height, 'Email', 1, 0, 'C', 1);
        $pdf->MultiCell($cell_width,$cell_height,'Outstanding Balance',1, 0);
        $current_x+=$cell_width;
        $pdf->SetXY($current_x, $current_y);
       $i = 0;
       $y_axis = $y_axis_initial2 + $row_height;
      
     }
    $cm_supplierid = $row['supplierid'];
    $cm_orgname = $r['cm_orgname'];
    $cm_address = $r['cm_address'];
    $cm_district = $r['cm_district'];
    $cm_postcode = $r['cm_postcode'];
    $cm_post = $r['cm_post'];
    $cm_contactperson = $r['cm_contactperson'];
    $cm_cellphone = $r['cm_cellphone'];
    $cm_email = $r['cm_email'];

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(23, $row_height, $cm_supplierid, 1, 0, 'C', 1);
    $pdf->Cell(30, $row_height, $cm_orgname, 1, 0, 'C', 1);
    $pdf->Cell(55, $row_height, $cm_address, 1, 0, 'C', 1);
    $pdf->Cell(16, $row_height, $cm_district, 1, 0, 'C', 1);
    $pdf->Cell(16, $row_height, $cm_postcode, 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, $cm_post, 1, 0, 'C', 1);
    $pdf->Cell(28, $row_height, $cm_contactperson, 1, 0, 'C', 1);
    $pdf->Cell(32, $row_height, $cm_cellphone, 1, 0, 'C', 1);
    $pdf->Cell(40, $row_height, $cm_email, 1, 0, 'C', 1);
    $pdf->Cell(20,$row_height,$balance,1, 0,'C',1);

    $y_axis = $y_axis + $row_height;

    $i = $i + 1;
    

  }
  $pdf->SetFont('Arial','B',12);
  $pdf->Ln(12);
  $tq = mysql_query("SELECT SUM(value) FROM `balance`") or die(mysql_error());
  $tr = mysql_fetch_array($tq);
  $total = $tr['SUM(value)'];
  $pdf->Cell(240,$row_height,'Total : ',0, 0,'R',0);
  $pdf->Cell(30,$row_height,number_format($total,2),0, 0,'C',0);
  $pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  if(mysql_num_rows($sql) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Supplier List Report</h2><br>
          <h5 class="text-center">Date From: '.$from_date.' To: '.$to_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border:1px solid #000; text-align:center">Supplier Code</th>
          <th style="border:1px solid #000; text-align:center">Supplier Name</th>
          <th style="border:1px solid #000; text-align:center">Address</th>
          <th style="border:1px solid #000; text-align:center">City</th>
          <th style="border:1px solid #000; text-align:center">ZIP Code</th>
          <th style="border:1px solid #000; text-align:center">Country</th>
          <th style="border:1px solid #000; text-align:center">Contact Person</th>
          <th style="border:1px solid #000; text-align:center">Cell Phone Number</th>
          <th style="border:1px solid #000; text-align:center">Cell Email</th>
          <th style="border:1px solid #000; text-align:center">Outstanding Balance</th>
        </tr> 
           ';  
        while($row = mysql_fetch_array($sql))  
          {  
            $supplier_id = $row['supplierid'];
            $query = mysql_query("SELECT am_vouchernumber, SUM(im_netamt) AS im_netamt FROM im_grnheader WHERE cm_supplierid='$supplier_id'");
            $rq = mysql_fetch_array($query);
            $im_netamt = $rq['im_netamt'];
            $am_vouchernumber = $rq['am_vouchernumber'];
            $query2 = mysql_query("SELECT * FROM am_apalc WHERE am_invnumber='$am_vouchernumber'") or die(mysql_error());
            $rq2 = mysql_fetch_array($query2);
            $am_amount = $rq2['am_amount'];
            $balance = $im_netamt-$am_amount;
            mysql_query("INSERT INTO `balance` VALUES('','$balance')") or die(mysql_error());
           $sq = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$supplier_id'");

             $r = mysql_fetch_array($sq);
            $output .= '  
            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['supplierid'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_orgname'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_address'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_district'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_postcode'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_post'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_contactperson'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_cellphone'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$r['cm_email'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$balance.'</td>
            </tr>  
                ';}
                $tq = mysql_query("SELECT SUM(value) FROM `balance`") or die(mysql_error());
                      $tr = mysql_fetch_array($tq);
                $output.='
                <tr>
                  <th colspan="9" class="text-right">Total :</th>
                      <th><b> '.number_format($tr['SUM(value)'],2).'</b></th>
                </tr>
                ';  
      
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=supplier_list_report.xls");  
    echo $output;  
  }

}  
mysql_query("DELETE  FROM `balance`") or die(mysql_error());
?>