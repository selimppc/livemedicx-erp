
<?php
include('../connection/dB.php');
$pPoNumber = $_GET['pPoNumber'];
$sql = mysql_query("SELECT * FROM `pp_purchaseordhd`,`cm_suppliermaster`,`cm_branchmaster` WHERE(pp_purchaseordhd.cm_supplierid=cm_suppliermaster.cm_supplierid) AND (pp_purchaseordhd.pp_store=cm_branchmaster.cm_branch) AND pp_purchaseordhd.pp_purordnum='$pPoNumber'") or die(mysql_error());
$ro = mysql_fetch_array($sql);
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',20);
  //$pdf->Cell(80);
  $pdf->Cell(0,10,'Purchase Order wise GRN',0,0,'L');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(0,10,$pPoNumber,0,0,'L');
  $pdf->Cell(0,10,'Order Date '.$ro['pp_date'],0,0,'R');
  $pdf->Ln(5);
  $pdf->Cell(0,10,'Supplier Name: '.$ro['cm_orgname'],0,0,'L');
  $pdf->Cell(0,10,'Currency: '.$ro['pp_currency'].' '.$ro['pp_exchrate'],0,0,'R');
  $pdf->Ln(5);
  $pdf->Cell(0,10,'PO For: '.$ro['pp_store'].' '.$ro['cm_description'],0,0,'L');
  $pdf->Cell(0,10,'Order Status: '.$ro['pp_status'],0,0,'R');
  $pdf->Ln(10);
   $pdf->SetFont('Arial','B',16);
   $row_height = 10;
  $pdf->Cell(0,10,'Purchase Order Detail',0,0,'C');
    $pdf->SetFillColor(255, 255, 150);
   //$pdf->SetFillColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 10);
  $pdf->Ln(10);
  $pdf->SetFillColor(245,124,0);
  $pdf->Cell(40,$row_height,'Code ',1,0,'L',0);
  $pdf->Cell(150,$row_height,'Product Name',1,0,'L',0);
  $pdf->Cell(80,$row_height,'Ordered Quantity',1,0,'R',0);
  $pdf->Ln(10);
  $sq = mysql_query("SELECT * FROM `pp_purchaseorddt`,`cm_productmaster` WHERE (pp_purchaseorddt.cm_code=cm_productmaster.cm_code) AND pp_purchaseorddt.pp_purordnum='$pPoNumber'");
  while($row= mysql_fetch_array($sq)){
    $pdf->Cell(40,$row_height,$row['cm_code'],1,0,'L',0);
    $pdf->Cell(150,$row_height,$row['cm_name'],1,0,'L',0);
    $pdf->Cell(80,$row_height,$row['pp_quantity'],1,0,'R',0);
    $pdf->Ln(10);
  }
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',16);
  $pdf->SetDrawColor(245, 124, 0); 
  
  $pdf->Cell(0,10,'GRN Detail',1,1,'C',0);
 
  //$pdf->Ln(10);
  $row_height = 10;
  
  //$pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  //$y_axis_initial = 20;
  
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  //$pdf->SetY($y_axis_initial);
  $pdf->Cell(20,$row_height,'SL. No',1,0,'C',0);
  $pdf->Cell(30,$row_height,'GRN Number',1,0,'C',0);
  $pdf->Cell(30,$row_height,'GRN Date',1,0,'C',0);
  $pdf->Cell(27,$row_height,'Status',1,0,'C',0);
  $pdf->Cell(30,$row_height,'Code',1,0,'C',0);
  $pdf->Cell(120,$row_height,'Product Name',1,0,'C',0);
  $pdf->Cell(20,$row_height,'GRN Qty',1,0,'C',0);
  $pdf->Ln(10);
  $sq = mysql_query("SELECT * FROM `im_grnheader`,`im_grndetail`,`cm_productmaster` WHERE (im_grnheader.im_grnnumber=im_grndetail.im_grnnumber) AND(im_grndetail.cm_code=cm_productmaster.cm_code) AND im_grnheader.im_purordnum='$pPoNumber'");
  $i = 1;
  $no = $i;
   while($row= mysql_fetch_array($sq)){
    $pdf->Cell(20,$row_height,$no++,1,0,'C',0);
  $pdf->Cell(30,$row_height,$row['im_grnnumber'],1,0,'C',0);
  $pdf->Cell(30,$row_height,$row['im_date'],1,0,'C',0);
  $pdf->Cell(27,$row_height,$row['im_status'],1,0,'C',0);
  $pdf->Cell(30,$row_height,$row['cm_code'],1,0,'C',0);
  $pdf->Cell(120,$row_height,$row['cm_name'],1,0,'C',0);
  $pdf->Cell(20,$row_height,$row['im_RcvQuantity'],1,0,'C',0);
  $pdf->Ln(10);
   }
  $pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 

        if(mysql_num_rows($sql) > 0)  
    {
         $output .= '  
      <table class="table" >  
        <tr align="center">  
          <th colspan="8" align="center"><h2><u>Purchase Order wise GRN</u></h2></th>    
        </tr> 
		<tr>
		</tr>
        <tr style="border:2px solid #000">  
          <th align="left">'.$pPoNumber.'<br>'.'</th>
		 <th align="left">Order Date : '.$ro['pp_date'].'</th>
		  </tr>
		  <tr style="border:2px solid #010">
          <th align="left">Supplier Name: '.$ro['cm_orgname'].'</th>
		  <th align="left">Currency : '.$ro['pp_currency'].'&nbsp;'.$ro['pp_exchrate'].'</th>
		  </tr>
		  <tr style="border:2px solid #010">
          <th align="left">Po For: '.$ro['pp_store'].'&nbsp;'.$ro['cm_description'].'</th>
		   <th align="left">Order Status:'.$ro['pp_status'].'</th>
        </tr> 
		<tr>
		</tr>
        <tr>
                      <th colspan="3" style="border:1px solid #000 "><h4 class="text-center"><b>Purchase Order Detail</b></h4></th>
                    </tr>
                    <tr style="background-color:#9e9e9e">
                      <th style="border:1px solid #000">Code</th>
                      <th style="border:1px solid #000">Product Name</th>
                      <th style="border:1px solid #000">Ordered Quantity</th>
                    </tr>
           ';  
      $sq = mysql_query("SELECT * FROM `pp_purchaseorddt`,`cm_productmaster` WHERE (pp_purchaseorddt.cm_code=cm_productmaster.cm_code) AND pp_purchaseorddt.pp_purordnum='$pPoNumber'");

       while($row= mysql_fetch_array($sq)){ 
          
              
            $output .= '  
            <tr style="border:1px solid #000">
                      <td>'.$row['cm_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td>'.$row['pp_quantity'].'</td>
                    </tr>';
          }
          $output.='
          <table  class="table table-border">
                  <thead>
				  <tr style="background-color:#3e2723">
				  <th colspan="10" style="background-color:#3e2723"></th>
				  </tr>
                    <tr>
                      <th colspan="7" style="border:1px solid #000"><h4 class="text-center"><b>GRN Detail</b></h4></th>
                    </tr>
                    <tr style="background-color:#ffb74d">
                      <th style="border:1px solid #000">SL. No</th>
                      <th style="border:1px solid #000">GRN Number</th>
                      <th style="border:1px solid #000">GRN Date</th>
                      <th style="border:1px solid #000">Status</th>
                      <th style="border:1px solid #000">Code</th>
                      <th style="border:1px solid #000">Product Name</th>
                      <th style="border:1px solid #000">GRN Qty</th>
                    </tr>
                  </thead>
                  <tbody>';

                  $sq = mysql_query("SELECT * FROM `im_grnheader`,`im_grndetail`,`cm_productmaster` WHERE (im_grnheader.im_grnnumber=im_grndetail.im_grnnumber) AND(im_grndetail.cm_code=cm_productmaster.cm_code) AND im_grnheader.im_purordnum='$pPoNumber'");
                  $i = 1;
                  $no = $i;
                  while($row= mysql_fetch_array($sq)){
                    $output.='
                    <tr style="border:1px solid #000" align="center">
                      <td>'.$no++.'</td>
                      <td>'.$row['im_grnnumber'].'</td>
                      <td>'.$row['im_date'].'</td>
                      <td>'.$row['im_status'].'</td>
                      <td>'.$row['cm_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td>'.$row['im_RcvQuantity'].'</td>
                    </tr>';
                  }
         }  
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=GRN.xls");  
    echo $output;  

}  
mysql_query("DELETE  FROM `jurnal_sum`") or die(mysql_error());
?>