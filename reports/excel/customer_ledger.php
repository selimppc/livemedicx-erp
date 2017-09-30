
<?php
error_reporting(0);
include('../connection/dB.php');
$first_word = $_GET['word_one'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$output = ''; 
$sql='';
$all='';
$cm_code1='';
$diff='';
$tc='';
$rable='';
 $flag=true;
$flap=0;
 $Totalrable=0.00;
 $Totalrecd=0.00;
 $nEtamt=0.00;

  $cm=mysql_query("SELECT COUNT(*) FROM cm_customermst");
        $cma=mysql_fetch_array($cm);
        $call=$cma[0];

/*if(empty($first_word))
{
	 $sql = mysql_query("SELECT * FROM `cm_customermst`");
  $all='ALL';
}
else{
 
  $sql = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$first_word'");
}*/
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');
  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',18);
   $pdf->Cell(0,0,'Date Wise Customer Ledger',0,0,'L');
  //$pdf->Cell(0,20,'Customer Ledger',0,0,'C');
   $pdf->SetLineWidth(0.5);
   $pdf->Line(10,25,130,25);
   $pdf->Ln(8);
  $pdf->SetFont('Arial','',12);
$pdf->Cell(45,10,'No. of Customer : '.$call,0,0,'L');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(0,0,'From Date : '.$from_date,0,0,'L');
  $pdf->Ln(5);
  $pdf->Cell(0,0,'To Date : '.$to_date,0,0,'L');
  $pdf->Ln(5);
  
  //$pdf->Cell(0,20,'Customer Ledger',0,0,'C');
  

  $pdf->SetAutoPageBreak(false);
  //$pdf->AddPage();
  $y_axis_initial = 40;
  $y_axis_initial2 = 40;
  $row_height = 8;
  $pdf->SetFillColor(255, 255, 240);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
   
  $pdf->Cell(28, $row_height, 'Customer ID', 1, 0, 'C', 1);
  $pdf->Cell(33, $row_height, 'Document Number', 1, 0, 'C', 1);
  $pdf->Cell(23, $row_height, 'Description', 1, 0, 'C', 1);
  $pdf->Cell(25, $row_height, 'Cash Or Credit', 1, 0, 'C', 1);
  $pdf->Cell(23, $row_height, 'Exch. Rate', 1, 0, 'C', 1);
  $pdf->Cell(28, $row_height, 'Receivable', 1, 0, 'C', 1);
  $pdf->Cell(28, $row_height, 'Received', 1, 0, 'C', 1);
  $pdf->Cell(33, $row_height, 'NET Balance', 1, 0, 'C', 1);
  //$pdf->Cell(30, $row_height, 'Outstanding Bal.', 1, 0, 'C', 1);
  $pdf->Cell(33, $row_height, 'Allocate Invoice', 1, 0, 'C', 1);
 
  

  $i = 0;
  $max = 13;
  $y_axis = $y_axis_initial2 + $row_height;
  
 if(!empty($first_word)){
   $sql = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='".$first_word."'");
/*$sql = mysql_query("SELECT cm_customermst.cm_name,sm_header.sm_payterms, sm_detail.sm_quantity FROM 
		  ((sm_header INNER JOIN cm_customermst ON sm_header.cm_cuscode = cm_customermst.cm_cuscode) 
		  INNER JOIN sm_detail ON sm_header.sm_number = sm_detail.sm_number) 
		  WHERE sm_header.sm_payterms='".$first_word."' AND cm_customermst.cm_name='".$from_date."'");*/
  }else{
    $sqlall = mysql_query("SELECT * FROM `cm_customermst`");
  }
  $allc=mysql_fetch_array($sqlall);
  $sall=$allc['cm_cuscode'];
  ///here will be change
  $re=mysql_fetch_array($sql);
  $cm_code1=$re['cm_cuscode'];
  //print_r($sall);
 
  $sqlsm=mysql_query("SELECT * FROM sm_header WHERE sm_header.cm_cuscode='$cm_code1'");
if(empty($cm_code1))
{
	
  $sqlsm = mysql_query("SELECT * FROM `sm_header`");
  $all='';
}
else{
  $sqlsm=mysql_query("SELECT * FROM sm_header WHERE sm_header.cm_cuscode='$cm_code1'");
  
}

            

    while($row = mysql_fetch_array($sqlsm)){
          $cm_code = $row['cm_cuscode'];
		  $cm_name = $row['sm_number'];
		  $ct=$row['sm_doc_type'];
      $sm_sign=$row['sm_sign'];
       $sm_cur=$row['sm_currency'];

        if($sm_sign=='-1')
       /*some change for all customer list*/
       //$sqltamt=mysql_query("SELECT * FROM sm_header WHERE sm_header.cm_cuscode='$cm_code' AND sm_header.sm_sign='-1'");
        $sqltamt=mysql_query("SELECT * FROM sm_header WHERE cm_cuscode='$cm_code' AND sm_date BETWEEN '$from_date' AND '$to_date' AND sm_stataus<>'Cancel'");
       $r=mysql_fetch_array($sqltamt);
       $rs=$r['sm_sign'];
       $rsa=$r['sm_number'];
      // echo $rs.'<br>'.$rsa;
       $sqlinvc = mysql_query("SELECT * FROM sm_invalc WHERE sm_number='$rsa'");
       $m=mysql_fetch_array($sqlinvc);
       $mn=$m['sm_number'];
      // echo $mn;
      if($sm_sign=='-1'){
                    $mquery = mysql_query("SELECT * FROM sm_invalc WHERE sm_number='$sm_sign'");
                    $mrow = mysql_fetch_array($mquery);
                   $smamnt=$mrow['sm_amount'];
                  }
                   $sm_number = substr($res['sm_number'],0,4);
                  if($sm_number=='IN--'){
                    $sm_number = 'Invoiced';
                  }elseif($sm_number=='MR--'){
                    $sm_number = 'Money Receipt';
                  }
                  else{
                      $sm_number='Direct Sale';
                  }
		  if(!empty($cm_code))
{
 $sqltrec = mysql_query("SELECT SUM(sm_netamt * '1.00000') AS Totalrec FROM sm_header WHERE cm_cuscode='$cm_code' AND sm_sign='-1'");
}
  else
  {
 $sqltrec=mysql_query("SELECT SUM(sm_netamt * '1.00000') AS Totalrec 
FROM ((sm_header
INNER JOIN sm_invalc ON sm_header.sm_number = sm_invalc.sm_invnumber)
INNER JOIN cm_customermst ON sm_header.cm_cuscode = cm_customermst.cm_cuscode)");
  }
   
    // $rc=mysql_fetch_array($sqltrec);
    // $tc=$rc['Totalrec']; 
      // echo $tc;;  
      // $sqltrec = mysql_query("SELECT SUM(sm_amount * '1.00000') AS Totalrec 
//FROM ((sm_header
//INNER JOIN sm_invalc ON sm_header.sm_number = sm_invalc.sm_invnumber)
//INNER JOIN cm_customermst ON sm_header.cm_cuscode = cm_customermst.cm_cuscode) WHERE sm_header.cm_cuscode='$sum'");
    
       $rc=mysql_fetch_array($sqltrec);
       $tc=$rc['Totalrec']; 
       //echo $tc.'<br>';
      $sqltrable = mysql_query("SELECT SUM(sm_totalamt) AS Totalrable FROM sm_header WHERE cm_cuscode='$cm_code' AND sm_sign='1'");
       $rable=mysql_fetch_array($sqltrable);
       $rble=$rable['Totalrable']; 
      

       $diff=$rable['Totalrable']-$rc['Totalrec'];
       //echo $diff;
       $diff=abs($diff);
       
       $Totalrable=$rble;
       $Totalrecd=$tc;
       $nEtamt=$diff;


  

 

		 //echo $Totalrable.' '.$Totalrecd.' '.$nEtamt.'<br>';
       //$pdf->Cell(30,$row_height,'Total Receivable',1,0,'C',1);
         
        
        
          if( $first_word=='00'){

          }else{
          if ($i == $max){
            $pdf->Ln(10);
            $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
            $pdf->AddPage();
            $pdf->SetY($y_axis_initial2);
            $pdf->SetX(10);

           $pdf->Cell(28, $row_height, 'Customer ID', 1, 0, 'C', 1);
			$pdf->Cell(33, $row_height, 'Document Number', 1, 0, 'C', 1);
			$pdf->Cell(23, $row_height, 'Description', 1, 0, 'C', 1);
			$pdf->Cell(25, $row_height, 'Cash Or Credit', 1, 0, 'C', 1);
			$pdf->Cell(23, $row_height, 'Exch. Rate', 1, 0, 'C', 1);
			$pdf->Cell(28, $row_height, 'Receivable', 1, 0, 'C', 1);
			$pdf->Cell(28, $row_height, 'Received', 1, 0, 'C', 1);
			$pdf->Cell(33, $row_height, 'NET Balance', 1, 0, 'C', 1);
			//$pdf->Cell(30, $row_height, 'Outstanding Bal.', 1, 0, 'C', 1);
            $pdf->Cell(33, $row_height, 'Allocate Invoice', 1, 0, 'C', 1);
            $i = 0;
            $y_axis = $y_axis_initial2 + $row_height;
            
          }
        $pdf->SetFont('Arial', '', 10);
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(28, $row_height, $row['cm_cuscode'], 1, 0, 'L', 1);
    $pdf->Cell(33, $row_height, $sm_number, 1, 0, 'L', 1);
    $pdf->Cell(23,$row_height,$row['sm_doc_type'], 1, 0, 'C', 1);
    $pdf->Cell(25, $row_height, $row['sm_payterms'], 1, 0, 'C', 1);
    $pdf->Cell(23, $row_height, $row['sm_currency'].' '.$row['sm_exchrate'], 1, 0, 'C', 1);
    $pdf->Cell(28, $row_height, $row['sm_totalamt'], 1, 0, 'C', 1);
	$pdf->Cell(28, $row_height, $m['sm_amount'], 1, 0, 'C', 1);
    $pdf->Cell(33, $row_height, $row['sm_netamt'], 1, 0, 'C', 1);
	//$pdf->Cell(30, $row_height, $row['sm_netamt'], 1, 0, 'C', 1);
     $pdf->Cell(33, $row_height, $m['sm_invnumber'], 1, 0, 'C', 1);

    $y_axis = $y_axis + $row_height;

    $i = $i + 1;
    } 


   

  }



   
 $pdf->SetFont('Arial','B',12);
  $pdf->Ln(12);
 // $tq = mysql_query("SELECT SUM(value) FROM `balance`") or die(mysql_error());
  //$tr = mysql_fetch_array($tq);
  //$total = $tr['SUM(value)'];
  $pdf->Cell(210,$row_height,'Total Receivable:  ',0, 0,'R',0);
 // $pdf->Cell(30,$row_height,number_format($total,2),0, 0,'C',0);
   $pdf->Cell(40,$row_height,''.$Totalrable,0, 0,'C',0);

   $pdf->SetFont('Arial','B',12);
  $pdf->Ln(12);
 // $tq = mysql_query("SELECT SUM(value) FROM `balance`") or die(mysql_error());
  //$tr = mysql_fetch_array($tq);
  //$total = $tr['SUM(value)'];
  $pdf->Cell(210,$row_height,'Total Received:  ',0, 0,'R',0);
 // $pdf->Cell(30,$row_height,number_format($total,2),0, 0,'C',0);
   $pdf->Cell(40,$row_height,''.$Totalrecd,0, 0,'C',0);
   $pdf->SetLineWidth(0.5);
  //$pdf->Line(100, 105, 290-5, 105);

   $pdf->SetFont('Arial','B',12);
  $pdf->Ln(15);
 // $tq = mysql_query("SELECT SUM(value) FROM `balance`") or die(mysql_error());
  //$tr = mysql_fetch_array($tq);
  //$total = $tr['SUM(value)'];
  $pdf->Cell(210,$row_height,'NET Amount:  ',0, 0,'R',0);
 // $pdf->Cell(30,$row_height,number_format($total,2),0, 0,'C',0);
   $pdf->Cell(40,$row_height,''.$nEtamt,0, 0,'C',0);
   
   $pdf->Cell(-40,29,'Outstanding Bal.:  ',0, 0,'R',0);
 // $pdf->Cell(30,$row_height,number_format($total,2),0, 0,'C',0);
   $pdf->Cell(40,29,''.$nEtamt,0, 0,'C',0);
   
  $pdf->Output();





  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  
  if($first_word==true)
{
	$sql = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$first_word'");
}
else{
  $sql = mysql_query("SELECT * FROM `cm_customermst`");
}
//$sql = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='".$first_word."' ");

  if(mysql_num_rows($sql) > 0)  
    {  
       $cm=mysql_query("SELECT COUNT(*) FROM cm_customermst");
        $cma=mysql_fetch_array($cm);
        $call=$cma[0];
       
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-left">Date Wise Customer Ledger</h2><br>
          <h4 class="text-left">From Date : '.$from_date.'</h4>
          <h4 class="text-left">To Date : '.$to_date.'</h4>
          <h3 class="text-left">No. of Customer: '.$call.'</h3>
          </th>    
        </tr>

        
         
           '; 


		   
		   $re=mysql_fetch_array($sql);
  if($a==$re['cm_cuscode'])
  {
	  $sqlsm=mysql_query("SELECT * FROM sm_header WHERE sm_header.cm_cuscode='$a'");
  }
  else{
	   $sqlsm=mysql_query("SELECT * FROM sm_header ");
  }
  
        while($row = mysql_fetch_array($sqlsm))  
          {  

            $sum=$row['cm_cuscode'];
       $sm_sign=$row['sm_sign'];
       $sm_cur=$row['sm_currency'];
       if($sm_sign=='-1')
       /*some change for all customer list*/
       $sqltamt=mysql_query("SELECT * FROM sm_header WHERE sm_header.cm_cuscode='$sum' AND sm_header.sm_sign='-1'");
       $r=mysql_fetch_array($sqltamt);
       $rs=$r['sm_sign'];
       $rsa=$r['sm_number'];
       //echo $rs.''.$rsa;
       $sqlinvc = mysql_query("SELECT * FROM sm_invalc WHERE sm_number='$rsa'");
       $m=mysql_fetch_array($sqlinvc);
       $mn=$m['sm_number'];
            
        if($sm_sign=='-1'){
                    $mquery = mysql_query("SELECT * FROM sm_invalc WHERE sm_number='$sm_sign'");
                    $mrow = mysql_fetch_array($mquery);
                   $smamnt=$mrow['sm_amount'];
                  }
                   $sm_number = substr($row['sm_number'],0,4);
                  if($sm_number=='IN--'){
                    $sm_number = 'Invoiced';
                  }elseif($sm_number=='MR--'){
                    $sm_number = 'Money Receipt';
                  }
                  else{
                      $sm_number='Direct Sale';
                  }


    $received = '';
   
    //$receive = '';
     $sqltrec = mysql_query("SELECT SUM(sm_amount * '1.00000') AS Totalrec 
FROM ((sm_header
INNER JOIN sm_invalc ON sm_header.sm_number = sm_invalc.sm_invnumber)
INNER JOIN cm_customermst ON sm_header.cm_cuscode = cm_customermst.cm_cuscode) WHERE sm_header.cm_cuscode='$sum'");
     $sqltrec=mysql_query("SELECT SUM(sm_amount * '1.00000') AS Totalrec 
FROM ((sm_header
INNER JOIN sm_invalc ON sm_header.sm_number = sm_invalc.sm_invnumber)
INNER JOIN cm_customermst ON sm_header.cm_cuscode = cm_customermst.cm_cuscode)");
       $rc=mysql_fetch_array($sqltrec);
       $tc=$rc['Totalrec']; 
      // echo $tc;;  
  $sqltrable = mysql_query("SELECT SUM(sm_totalamt) AS Totalrable FROM sm_header WHERE cm_cuscode='$sum' AND sm_sign='1'");
        $sqltrable = mysql_query("SELECT SUM(sm_totalamt) AS Totalrable FROM sm_header WHERE sm_sign='1'");


       $rable=mysql_fetch_array($sqltrable);
       $rble=$rable['Totalrable']; 
      // echo $rble;

       $diff=$rable['Totalrable']-$rc['Totalrec'];
      // echo $diff;
       $diff=abs($diff);
 if($flag==true)
             {
              //echo $tc.'<br>'.$rble.'<br>'.$diff;
               $output .= ' 
         
              <tr>  
          <th colspan="5"></th>
          
         <th style="border:2px solid #000; text-align:center">Total Receivable</th>
          <th style="border:2px solid #000; text-align:center;"><strong>Total Received</strong></th>
          <th style="border:2px solid #000; text-align:center"><strong>NET Bal.</strong></th>
          <th style="border:2px solid #000; text-align:center"><strong>Outstanding Balance</strong></th>
          
         
        </tr>
        

            <tr>  
             <td colspan="5" ></td>
              <td style="border:2px solid #000; text-align:center; swf_fontsize(12)">'.$tc.'</td>
              <td style="border:1px solid #000; text-align:center">'.$rble.'</td>
              <td style="border:1px solid #000; text-align:center">'.$diff.'</td>
              <td style="border:1px solid #000; text-align:center">'.$diff.'</td>
              
            </tr> 
            tr>
         <th colspan="8"></th>
        </tr>

             <tr>  
          <th style="border:1px solid #000; text-align:center">Customer ID</th>
          <th style="border:1px solid #000; text-align:center">Document Number</th>
          <th style="border:1px solid #000; text-align:center">Description</th>
          <th style="border:1px solid #000; text-align:center">Cash or Credit</th>
          <th style="border:1px solid #000; text-align:center">Exch. Rate</th>
          <th style="border:1px solid #000; text-align:center">Receivable</th>
          <th style="border:1px solid #000; text-align:center">Received</th>
       <th style="border:1px solid #000; text-align:center">NET Balance</th>
        <th style="border:1px solid #000; text-align:center">Allocate Invoice</th>
        </tr> 
                ';

             }
                   
                   $flag=false;



            $output .= ' 
            


            <tr>  
              <td style="border:1px solid #000; text-align:center">'.$row['cm_cuscode'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$sm_number.'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['sm_doc_type'].'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['sm_payterms'].'</td>
              <td style="border:1px solid #000; text-align:center">'.'CDF 1.00000'.'</td>
              <td style="border:1px solid #000; text-align:center">'.$row['sm_totalamt'].'</td>
			  <td style="border:1px solid #000; text-align:center">'.$m['sm_amount'].'</td>
			   <th style="border:1px solid #000; text-align:center">'.$row['sm_netamt'].'</th>
          <th style="border:1px solid #000; text-align:center">'.$m['sm_invnumber'].'</th>
            </tr>  
                ';

                   
              
    }  

   
    
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Item Ledger.xls");  
    echo $output;  
  }



}  

?>






<?php

?>