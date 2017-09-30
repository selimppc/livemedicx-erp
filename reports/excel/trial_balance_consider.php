<?php
include('../connection/dB.php');
$f_word = $_GET['f_word'];
$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$a = mysql_query("SELECT * FROM `cm_branchmaster` WHERE cm_branch='$f_word'");
$r = mysql_fetch_array($a);
$des = '';
$cm_description = $r['cm_description'];
if($cm_description==false){
  $des = 'All Brance';
}else{
  $des = $r['cm_description'];
}
$brance = $r['cm_branch'];
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,'Trial Balance of '.$des,0,0,'L');
  $pdf->SetFont('Arial','B',12);
  $pdf->Ln(7);
  $pdf->Cell(0,0,'From : '.$from_date. ' To '.$to_date,0,0,'L');
  $pdf->SetAutoPageBreak(false);
  $pdf->SetLineWidth(0.5);
  $pdf->Line(0,20,150,20);
  $y_axis_initial = 30;
  $y_axis_initial2 = 30;
  $row_height = 12;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetY($y_axis_initial);
  //for line breack
  $start_x=$pdf->GetX();
  $current_y = $pdf->GetY();
  $current_x = $pdf->GetX();
  $cell_width = 40;
  $cell_height=7;
  //for line break
  $pdf->SetX(10);
  $pdf->Cell(95, $row_height, 'SL Account Code & Description', 1, 0, 'C', 1);
  $pdf->Cell(60,7,'Balance B/F' ,1,0,'C',1);
  $pdf->Cell(60,7,'Current Date Range' ,1,0,'C',1);
  $pdf->Cell(60,7,'Balance B/F' ,1,0,'C',1);
  $pdf->Ln(7);
  $pdf->Cell(95,5, '', 0, 0, 'C', 0);
  $pdf->Cell(30,5,'Debit' ,1,0,'C',1);
  $pdf->Cell(30,5,'Credit' ,1,0,'C',1);
  $pdf->Cell(30,5,'Debit' ,1,0,'C',1);
  $pdf->Cell(30,5,'Credit' ,1,0,'C',1);
  $pdf->Cell(30,5,'Debit' ,1,0,'C',1);
  $pdf->Cell(30,5,'Credit' ,1,0,'C',1);
  $i = 0;
  $max = 10;
  $y_axis = $y_axis_initial2 + $row_height;
  $sql = mysql_query("SELECT * FROM `am_group_one`");
  while($row = mysql_fetch_array($sql)){
    $am_groupone = $row['am_groupone'];
    $sub_sql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
    while($sub_row = mysql_fetch_array($sub_sql)){
      $am_grouptwo = $sub_row['am_grouptwo'];
      $content = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'") or die(mysql_error());
       while($con_row = mysql_fetch_array($content)){
        $am_accountcode = $con_row['am_accountcode'];
        $sum_bf = mysql_query("SELECT SUM(c_primeamt)AS sumbf FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date <'$from_date'") or die(mysql_error());
        $sum_bf_row = mysql_fetch_array($sum_bf);
        $sumbf = $sum_bf_row['sumbf'];
        $sumbfC = '';
        $sumbfD = '';
        if($sumbf<0){
           $sumbfD = str_replace('-','',$sumbf);
         }elseif($sumbf>0){
          $sumbfC = $sumbf;
        }else{
          $sumbfC = '0.00';
          $sumbfD = '0.00';
        }
        $sum_cdr = mysql_query("SELECT SUM(c_primeamt)AS sumcdr FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date BETWEEN '$from_date' and '$to_date'") or die(mysql_error());
        $sum_cdr_row = mysql_fetch_array($sum_cdr);
        $sumcdr = $sum_cdr_row['sumcdr'];
        $sumcdrC = '';
        $sumcdrD = '';
        if($sumcdr<0){
          $sumcdrD = str_replace('-','',$sumcdr);
        }elseif($sumcdr>0){
          $sumcdrC = $sumcdr;
        }else{
          $sumcdrC = '0.00';
          $sumcdrD = '0.00';
        }
        $sum_cf = mysql_query("SELECT SUM(c_primeamt)AS sumcf FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date BETWEEN '$from_date' and '$to_date'") or die(mysql_error());
        $sum_cf_row = mysql_fetch_array($sum_cf);
        $sumcf = $sum_cf_row['sumcf'];
        $sumcfC = '';
        $sumcfD = '';
        if($sumcf<0){
          $sumcfD = str_replace('-','',$sumcf);
        }elseif($sumcf>0){
          $sumcfC = $sumcf;
        }else{
          $sumcfC = '0.00';
          $sumcfD = '0.00';
        }
        if($sumbfC&&$sumbfD&&$sumcdrC&&$sumcdrD&&$sumcfC&&$sumcfD=='0.00'){

        }else{
          mysql_query("INSERT INTO trial_sum VALUES('','$sumbfC','$sumbfD','$sumcdrC','$sumcdrD','$sumcfC','$sumcfD')") or die(mysql_error());
          $am_accountcode = $con_row['am_accountcode'];
          $am_description = $con_row['am_description'];
        
     if ($i == $max){
       $pdf->Ln(10);
       $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
       $pdf->AddPage();
       $pdf->SetY($y_axis_initial2);
       $pdf->SetX(10);
        $pdf->Cell(95, $row_height, 'SL Account Code & Description', 1, 0, 'C', 1);
          $pdf->Cell(60,7,'Balance B/F' ,1,0,'C',1);
          $pdf->Cell(60,7,'Current Date Range' ,1,0,'C',1);
          $pdf->Cell(60,7,'Balance B/F' ,1,0,'C',1);
          $pdf->Ln(7);
          $pdf->Cell(95,5, '', 0, 0, 'C', 0);
          $pdf->Cell(30,5,'Debit' ,1,0,'C',1);
          $pdf->Cell(30,5,'Credit' ,1,0,'C',1);
          $pdf->Cell(30,5,'Debit' ,1,0,'C',1);
          $pdf->Cell(30,5,'Credit' ,1,0,'C',1);
          $pdf->Cell(30,5,'Debit' ,1,0,'C',1);
          $pdf->Cell(30,5,'Credit' ,1,0,'C',1);
       $i = 0;
       $y_axis = $y_axis_initial2 + $row_height;
      
     }
if($sumbfC==false){
  $sumbfC = '0.00';
}
if($sumbfD==false){
  $sumbfD = '0.00';
}
    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(95, $row_height, $am_accountcode.$am_description, 1, 0, 'L', 1);
    $pdf->Cell(60,7,'' ,0,0,'C',0);
    $pdf->Cell(60,7,'' ,0,0,'C',0);
    $pdf->Cell(60,7,'' ,0,0,'C',0);
    $pdf->Ln(0);
    $pdf->Cell(95,0, '', 0, 0, 'C', 0);
    $pdf->Cell(30,$row_height,$sumbfC ,1,0,'C',1);
    $pdf->Cell(30,$row_height,$sumbfD ,1,0,'C',1);
    $pdf->Cell(30,$row_height,$sumcdrC ,1,0,'C',1);
    $pdf->Cell(30,$row_height,$sumcdrD ,1,0,'C',1);
    $pdf->Cell(30,$row_height,$sumcfC ,1,0,'C',1);
    $pdf->Cell(30,$row_height,$sumcfD ,1,0,'C',1);
 
    $y_axis = $y_axis + $row_height;

    $i = $i + 1;
   }
   }
  }  
}
$bfc = mysql_query("SELECT SUM(`sumbfC`) AS bfc FROM `trial_sum`");
$bfc_row = mysql_fetch_array($bfc);
$bfd = mysql_query("SELECT SUM(`sumbfD`) AS bfd FROM `trial_sum`");
$bfd_row = mysql_fetch_array($bfd);
$drC = mysql_query("SELECT SUM(`sumcdrC`) AS drC FROM `trial_sum`");
$drC_row = mysql_fetch_array($drC);
$drd = mysql_query("SELECT SUM(`sumcdrD`) AS drd FROM `trial_sum`");
$drd_row = mysql_fetch_array($drd);
$cfC = mysql_query("SELECT SUM(`sumcfC`) AS cfC FROM `trial_sum`");
$cfC_row = mysql_fetch_array($cfC);
$cfd = mysql_query("SELECT SUM(`sumcfD`) AS cfd FROM `trial_sum`");
$cfd_row = mysql_fetch_array($cfd);
    $pdf->Ln(12);
    $pdf->Cell(95,$row_height, 'Total Sum', 1, 0, 'R', 1);
    $pdf->Cell(30,$row_height,number_format($bfc_row['bfc'],2) ,1,0,'C',1);
    $pdf->Cell(30,$row_height,number_format($bfd_row['bfd'],2) ,1,0,'C',1);
    $pdf->Cell(30,$row_height,number_format($drC_row['drC'],2) ,1,0,'C',1);
    $pdf->Cell(30,$row_height,number_format($drd_row['drd'],2) ,1,0,'C',1);
    $pdf->Cell(30,$row_height,number_format($cfC_row['cfC'],2) ,1,0,'C',1);
    $pdf->Cell(30,$row_height,number_format($cfd_row['cfd'],2) ,1,0,'C',1);
    $pdf->Output();
  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  if(mysql_num_rows($a) > 0)  
    {  
      $output .= '  
      <table class="table">  
        <tr>  
          <th colspan="9" align="center">
          <h2 class="text-center">Trial Balance of '.$des.'</h2>
          <h5 class="text-center">From: '.$from_date.' To: '.$to_date.'</h5>
          </th>    
        </tr> 
        <tr>  
          <th style="border: 1px solid #000;">SL Account Code & Description</th>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="2"><b>Balance B/F</b>
            <table style="width:100%;">
              <tr>
                <td style="border: 1px solid #000;"><b>Debit</b></td>
                <td style="border: 1px solid #000;"><b>Credit</b></td>
              </tr>
            </table>
          </td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="2"><b>Current Date Range</b>
            <table style="width:100%;">
              <tr>
                <td style="border: 1px solid #000;"><b>Debit</b></td>
                <td style="border: 1px solid #000;"><b>Credit</b></td>
              </tr>
            </table>
          </td>
          <td style="border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="2"><b>Balance C/F</b>
            <table style="width:100%;">
              <tr>
                <td style="border: 1px solid #000;"><b>Debit</b></td>
                <td style="border: 1px solid #000;"><b>Credit</b></td>
              </tr>
            </table>
          </td>
        </tr>
           ';  
           $sql = mysql_query("SELECT * FROM `am_group_one`");
           while($row = mysql_fetch_array($sql)){
            $am_groupone = $row['am_groupone'];
            $sub_sql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
            while($sub_row = mysql_fetch_array($sub_sql)){
              $am_grouptwo = $sub_row['am_grouptwo'];
              $content = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'") or die(mysql_error());
              while($con_row = mysql_fetch_array($content)){
                $am_accountcode = $con_row['am_accountcode'];
                $sum_bf = mysql_query("SELECT SUM(c_primeamt)AS sumbf FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date <'$from_date'") or die(mysql_error());
                $sum_bf_row = mysql_fetch_array($sum_bf);
                $sumbf = $sum_bf_row['sumbf'];
                $sumbfC = '';
                 $sumbfD = '';
                 if($sumbf<0){
                  $sumbfD = str_replace('-','',$sumbf);
                }elseif($sumbf>0){
                  $sumbfC = $sumbf;
                }else{
                  $sumbfC = '0.00';
                  $sumbfD = '0.00';
                }
                $sum_cdr = mysql_query("SELECT SUM(c_primeamt)AS sumcdr FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date BETWEEN '$from_date' and '$to_date'") or die(mysql_error());
                $sum_cdr_row = mysql_fetch_array($sum_cdr);
                $sumcdr = $sum_cdr_row['sumcdr'];
                $sumcdrC = '';
                 $sumcdrD = '';
                 if($sumcdr<0){
                  $sumcdrD = str_replace('-','',$sumcdr);
                }elseif($sumcdr>0){
                  $sumcdrC = $sumcdr;
                }else{
                  $sumcdrC = '0.00';
                   $sumcdrD = '0.00';
                }
                $sum_cf = mysql_query("SELECT SUM(c_primeamt)AS sumcf FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date BETWEEN '$from_date' and '$to_date'") or die(mysql_error());
                $sum_cf_row = mysql_fetch_array($sum_cf);
                 $sumcf = $sum_cf_row['sumcf'];
                 $sumcfC = '';
                 $sumcfD = '';
                 if($sumcf<0){
                  $sumcfD = str_replace('-','',$sumcf);
                }elseif($sumcf>0){
                  $sumcfC = $sumcf;
                }else{
                  $sumcfC = '0.00';
                  $sumcfD = '0.00';
                }
                if($sumbfC&&$sumbfD&&$sumcdrC&&$sumcdrD&&$sumcfC&&$sumcfD=='0.00'){

                }else{
                  mysql_query("INSERT INTO trial_sum VALUES('','$sumbfC','$sumbfD','$sumcdrC','$sumcdrD','$sumcfC','$sumcfD')") or die(mysql_error());
                  $output .= ' 
                  <tr>
                    <td style="border: 1px solid #000;">'.$con_row['am_accountcode'].'&nbsp;'.$con_row['am_description'].'</td>
                    <td style="border: 1px solid #000; text-align:center">'.$sumbfC.'</td>
                    <td style="border: 1px solid #000; text-align:center">'.$sumbfD.'</td>
                    <td style="border: 1px solid #000; text-align:center">'.$sumcdrC.'</td>
                    <td style="border: 1px solid #000; text-align:center">'.$sumcdrD.'</td>
                    <td style="border: 1px solid #000; text-align:center">'.$sumcfC.'</td>
                    <td style="border: 1px solid #000; text-align:center">'.$sumcfD.'</td>
                  </tr> 
                  ';
                }
              }
            }
           }
           $bfc = mysql_query("SELECT SUM(`sumbfC`) AS bfc FROM `trial_sum`");
           $bfc_row = mysql_fetch_array($bfc);
           $bfd = mysql_query("SELECT SUM(`sumbfD`) AS bfd FROM `trial_sum`");
           $bfd_row = mysql_fetch_array($bfd);
           $drC = mysql_query("SELECT SUM(`sumcdrC`) AS drC FROM `trial_sum`");
           $drC_row = mysql_fetch_array($drC);
           $drd = mysql_query("SELECT SUM(`sumcdrD`) AS drd FROM `trial_sum`");
           $drd_row = mysql_fetch_array($drd);
           $cfC = mysql_query("SELECT SUM(`sumcfC`) AS cfC FROM `trial_sum`");
            $cfC_row = mysql_fetch_array($cfC);
            $cfd = mysql_query("SELECT SUM(`sumcfD`) AS cfd FROM `trial_sum`");
            $cfd_row = mysql_fetch_array($cfd);
            $output .= '  
            <tr>  
              <th style="border: 1px solid #000; text-align:right">Total</th>
               <th style="border: 1px solid #000; text-align:center">'.number_format($bfc_row['bfc'],2).'</th>
               <th style="border: 1px solid #000; text-align:center">'.number_format($bfd_row['bfd'],2).'</th>
               <th style="border: 1px solid #000; text-align:center">'.number_format($drC_row['drC'],2).'</th>
               <th style="border: 1px solid #000; text-align:center">'.number_format($drd_row['drd'],2).'</th>
               <th style="border: 1px solid #000; text-align:center">'.number_format($cfC_row['cfC'],2).'</th>
               <th style="border: 1px solid #000; text-align:center">'.number_format($cfd_row['cfd'],2).'</th>
            </tr>  
                ';
      
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Trial Balance Consider.xls");  
    echo $output;  
  }

}  
mysql_query("DELETE  FROM `trial_sum`") or die(mysql_error());
?>