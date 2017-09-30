
<?php
include('../connection/dB.php');
$word_one = $_GET['word_one'];
$word_two = $_GET['word_two'];
$word_three = $_GET['word_three'];
$word_four = $_GET['word_four'];
$star_month = '';
$end_month = '';
if($word_two==1){
  $word_two = 'January';
  $star_month = $word_one.'-'.'01'.'-'.'1';
  $end_month = $word_one.'-'.'01'.'-'.'31';
}elseif($word_two==2){
  $word_two = 'February';
  $star_month = $word_one.'-'.'02'.'-'.'1';
  $end_month = $word_one.'-'.'02'.'-'.'29';
}elseif($word_two==3){
  $word_two = 'March';
  $star_month = $word_one.'-'.'03'.'-'.'1';
  $end_month = $word_one.'-'.'03'.'-'.'31';
}elseif($word_two==4){
  $word_two = 'April';
  $star_month = $word_one.'-'.'04'.'-'.'1';
  $end_month = $word_one.'-'.'04'.'-'.'30';
}elseif($word_two==5){
  $word_two = 'May';
  $star_month = $word_one.'-'.'05'.'-'.'1';
  $end_month = $word_one.'-'.'05'.'-'.'30';
}elseif($word_two==6){
  $word_two = 'June';
  $star_month = $word_one.'-'.'06'.'-'.'1';
  $end_month = $word_one.'-'.'06'.'-'.'30';
}elseif($word_two==7){
  $word_two = 'July';
  $star_month = $word_one.'-'.'07'.'-'.'1';
  $end_month = $word_one.'-'.'07'.'-'.'31';
}elseif($word_two==8){
  $word_two = 'August';
  $star_month = $word_one.'-'.'08'.'-'.'1';
  $end_month = $word_one.'-'.'08'.'-'.'31';
}elseif($word_two==9){
  $word_two = 'September';
  $star_month = $word_one.'-'.'09'.'-'.'1';
  $end_month = $word_one.'-'.'09'.'-'.'30';
}elseif($word_two==10){
  $word_two = 'October';
  $star_month = $word_one.'-'.'10'.'-'.'1';
  $end_month = $word_one.'-'.'10'.'-'.'31';
}elseif($word_two==11){
  $word_two = 'November';
  $star_month = $word_one.'-'.'11'.'-'.'1';
  $end_month = $word_one.'-'.'11'.'-'.'30';
}elseif($word_two==12){
  $word_two = 'December';
  $star_month = $word_one.'-'.'12'.'-'.'1';
  $end_month = $word_one.'-'.'12'.'-'.'31';
}
$output = ''; 
if(isset($_POST["pdf"])){
  require('../fpdf/fpdf.php');

  $pdf=new FPDF("L", "mm", "A4");
  $pdf->AddPage();
  $pdf->AliasNbPages();
  $pdf->AliasNbPages('{totalPages}');
  $pdf->SetFont('Arial','B',25);
  $pdf->Cell(0,0,'Balance Sheet',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',18);
  $pdf->Cell(0,0,'As At',0,0,'C');
  $pdf->Ln(10);
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(0,0,$word_two.', '.$word_one,0,0,'C');
  $pdf->Ln(10);
  $pdf->Cell(0,0,'For Brance '.$word_three,0,0,'L');
  $pdf->Ln(10);
  $pdf->SetLineWidth(0.5);
  // $pdf->Line(10,45,80,45);
  $pdf->SetAutoPageBreak(false);
  $y_axis_initial = 47;
  $y_axis_initial2 = 47;
  $row_height = 12;
  $pdf->SetFillColor(255, 255, 255);
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->SetY($y_axis_initial);
  $pdf->SetX(10);
  $pdf->Cell(135, $row_height, 'PARTICULARS', 1, 0, 'L', 1);
  $pdf->Cell(70, $row_height, 'CURRENT MONTH', 1, 0, 'C', 1);
  $pdf->Cell(70, $row_height, 'YEAR-TO-DATE', 1, 0, 'C', 1);
  $pdf->Ln(10);
  $i = 0;
  $max = 5;
  $y_axis = $y_axis_initial2 + $row_height;
  $pdf->SetY($y_axis);
  $pdf->SetX(10);
    if($word_four=='Summary'){
      $sql = mysql_query("SELECT * FROM am_group_one LIMIT 2")or die(mysql_error());
      while($head = mysql_fetch_array($sql)){
         $head_name = $head['am_description'];
         $am_groupone = $head['am_groupone'];
         $group = $head['am_groupone'];
         $pdf->Ln(10);
         $pdf->SetFont('Arial', 'B', 13);
         $pdf->Cell(70, $row_height, $head_name, 0, 0, 'L', 1);
         $pdf->Ln(10);
         $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
          while($sub_row = mysql_fetch_array($subsql)){
            $am_description = $sub_row['am_description'];
            $am_grouptwo = $sub_row['am_grouptwo'];
             $car_acc  = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'") or die(mysql_error());
             while($car_acc_row = mysql_fetch_array($car_acc)){
              $am_accountcode = $car_acc_row['am_accountcode'];
              $am_groupone = $car_acc_row['am_groupone'];
              $am_grouptwo = $car_acc_row['am_grouptwo'];
              $base_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Base_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_date BETWEEN '$star_month' AND '$end_month' AND `c_branch`='$word_three'")or die(mysql_error());
              $base_row = mysql_fetch_array($base_sql);
              $prime_sql = mysql_query("SELECT SUM(`c_primeamt`)AS Prime_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_year='$word_one' AND `c_branch`='$word_three'") or die(mysql_error());
              $prime_row = mysql_fetch_array($prime_sql);
              $Base_Amount = $base_row['Base_Amount'];
              $Prime_Amount = $prime_row['Prime_Amount'];
              $t_b_a = number_format($Base_Amount,2);
              $t_p_a = number_format($Prime_Amount,2);
              $t_b = str_replace('-','', $Base_Amount);
              $t_p = str_replace('-','', $Prime_Amount);
              mysql_query("INSERT INTO `balancesheet_total` VALUES('','$t_p','$t_b','$am_groupone','$am_grouptwo')") or die(mysql_error());
             }
             $sum_head_base = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE am_grouptwo='$am_grouptwo'");
             $head_row = mysql_fetch_array($sum_head_base);
             $sum_head_base2 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE am_grouptwo='$am_grouptwo'");
             $head_row2 = mysql_fetch_array($sum_head_base2);
             if($i==$max){
              $pdf->Ln(10);
              $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
               $pdf->AddPage();
               $pdf->SetY($y_axis_initial2);
               $pdf->SetX(10);
               $pdf->SetFont('Arial', 'B', 14);
               $pdf->Cell(135, $row_height, 'PARTICULARS', 1, 0, 'L', 1);
              $pdf->Cell(70, $row_height, 'CURRENT MONTH', 1, 0, 'C', 1);
              $pdf->Cell(70, $row_height, 'YEAR-TO-DATE', 1, 0, 'C', 1);
              $pdf->Ln(15);
              $i = 0;
              $y_axis = $y_axis_initial2 + $row_height;
             }
             $pdf->SetFont('Arial', 'B', 12);
             $pdf->Cell(135, $row_height, $am_grouptwo.'- '.$am_description, 0, 0, 'L', 1);
             $pdf->Cell(70, $row_height, number_format($head_row['base'],2), 0, 0, 'C', 1);
             $pdf->Cell(70, $row_height, number_format($head_row2['prime'],2), 0, 0, 'C', 1);
             $pdf->Ln(10);
             $y_axis = $y_axis + $row_height;
            $i = $i + 1;
          }
          $sum_subhead_base = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE group_one='1'");
          $subhead_row = mysql_fetch_array($sum_subhead_base);
          $sum_subhead_base2 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE group_one='1'");
          $subhead_row2 = mysql_fetch_array($sum_subhead_base2);
          $sum_subhead_base3 = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE group_one='2'");
          $subhead_row3 = mysql_fetch_array($sum_subhead_base3);
          $sum_subhead_base4 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE group_one='2'");
          $subhead_row4 = mysql_fetch_array($sum_subhead_base4);
          $sum_base = $subhead_row['base'];
          $sum_base2 = $subhead_row3['base'];
           $t_base = $sum_base+$sum_base2;
           $sum_prime = $subhead_row2['prime'];
           $sum_prime2 = $subhead_row4['prime'];
           $t_prime = $sum_prime+$sum_prime2;
           if($group==1){
            $pdf->Ln(15);
            $pdf->Cell(135, $row_height, 'Total '.$head_name, 0, 0, 'R', 1);
            $pdf->Cell(70, $row_height, number_format($subhead_row['base'],2), 0, 0, 'C', 1);
            $pdf->Cell(70, $row_height, number_format($subhead_row2['prime'],2), 0, 0, 'C', 1);
           }else{
            $pdf->Ln(15);
            $pdf->Cell(135, $row_height, 'Total '.$head_name, 0, 0, 'R', 1);
            $pdf->Cell(70, $row_height, number_format($subhead_row3['base'],2), 0, 0, 'C', 1);
            $pdf->Cell(70, $row_height, number_format($subhead_row4['prime'],2), 0, 0, 'C', 1);
           }
      }
      $pdf->Ln(15);
      $add = $t_base-$sum_base2;
      $add2 = $t_prime-$sum_prime2;
      $pdf->Cell(135, $row_height, 'Add: Profit / Loss During The Period', 0, 0, 'R', 1);
      $pdf->Cell(70, $row_height, number_format($t_base,2), 0, 0, 'C', 1);
      $pdf->Cell(70, $row_height, number_format($t_prime,2), 0, 0, 'C', 1);
      $pdf->Ln(15);
      $pdf->Cell(135, $row_height, 'Total Liabilities', 0, 0, 'R', 1);
      $pdf->Cell(70, $row_height, number_format($add,2), 0, 0, 'C', 1);
      $pdf->Cell(70, $row_height, number_format($add2,2), 0, 0, 'C', 1);
    }else{
      $sql = mysql_query("SELECT * FROM am_group_one LIMIT 2")or die(mysql_error());
      while($head = mysql_fetch_array($sql)){
        $head_name = $head['am_description'];
        $am_groupone = $head['am_groupone'];
        $group = $head['am_groupone'];
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(70, $row_height, $head_name, 0, 0, 'L', 1);
        $pdf->Ln(10);
        $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
         while($sub_row = mysql_fetch_array($subsql)){
          $am_description = $sub_row['am_description'];
          $am_grouptwo = $sub_row['am_grouptwo'];
          $pdf->Cell(135, $row_height, $am_grouptwo.'- '.$am_description, 0, 0, 'L', 1);
          $pdf->Ln(10);
          $car_acc  = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
          while($car_acc_row = mysql_fetch_array($car_acc)){
            $am_accountcode = $car_acc_row['am_accountcode'];
             $am_groupone = $car_acc_row['am_groupone'];
             $base_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Base_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_date BETWEEN '$star_month' AND '$end_month' AND `c_branch`='$word_three'")or die(mysql_error());
             $base_row = mysql_fetch_array($base_sql);
             $prime_sql = mysql_query("SELECT SUM(`c_primeamt`)AS Prime_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_year='$word_one' AND `c_branch`='$word_three'");
             $prime_row = mysql_fetch_array($prime_sql);
             $Base_Amount = $base_row['Base_Amount'];
             $Prime_Amount = $prime_row['Prime_Amount'];
             $t_b_a = number_format($Base_Amount,2);
             $t_p_a = number_format($Prime_Amount,2);
             $t_b = str_replace('-','', $Base_Amount);
             $t_p = str_replace('-','', $Prime_Amount);
             mysql_query("INSERT INTO `balancesheet_total` VALUES('','$t_p','$t_b','$am_groupone','')") or die(mysql_error());
             $f = '';
             $l = '';
              if($t_b_a<=0){
                $f = '(';
                  $l = ')';
              }elseif($t_p_a<=0){
                $f = '(';
                $l = ')';
              }else{
                $f = '';
                $l = '';
              }
              if($t_b_a && $t_p_a=='0.00'){

              }else{
                if($f=='(' && $l==')' && $t_b==''){
                  $f= '';
                  $l = '';
                  $t_b = '0.00';
                }elseif($f=='(' && $l==')' && $t_p==''){
                  $f= '';
                  $l = '';
                  $t_p = '0.00';
                }
                if($i==$max){
                    $pdf->Ln(10);
                    $pdf->Cell(0, $row_height, "Page " . $pdf->PageNo() . "/{totalPages}", 0, 1,'R');
                    $pdf->AddPage();
                    $pdf->SetY($y_axis_initial2);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial', 'B', 14);
                    $pdf->Cell(135, $row_height, 'PARTICULARS', 1, 0, 'L', 1);
                    $pdf->Cell(70, $row_height, 'CURRENT MONTH', 1, 0, 'C', 1);
                    $pdf->Cell(70, $row_height, 'YEAR-TO-DATE', 1, 0, 'C', 1);
                    $pdf->Ln(15);
                    $i = 0;
                    $y_axis = $y_axis_initial2 + $row_height;
                  }
                  $pdf->SetFont('Arial', 'B', 12);
                  $pdf->Cell(135, $row_height, $car_acc_row['am_accountcode'].' '.$car_acc_row['am_description'], 0, 0, 'L', 1);
                  $pdf->Cell(70, $row_height, $f.''.number_format($t_b,2).''.$l, 0, 0, 'C', 1);
                  $pdf->Cell(70, $row_height, $f.''.number_format($t_p,2).''.$l, 0, 0, 'C', 1);
                  $pdf->Ln(10);
                  $y_axis = $y_axis + $row_height;
                  $i = $i + 1;
              }
          }
          
            
         }
         $sum_sql_base = mysql_query("SELECT SUM(base_amount)AS total_base FROM `balancesheet_total` WHERE group_one=1");
         $sum_row_base = mysql_fetch_array($sum_sql_base);
         $sum_base = $sum_row_base['total_base'];
         $sum_sql_prime = mysql_query("SELECT SUM(parime_amount)AS total_prime FROM `balancesheet_total` WHERE group_one=1");
         $sum_row_prime = mysql_fetch_array($sum_sql_prime);
         $sum_prime = $sum_row_prime['total_prime'];
         $sum_sql_base2 = mysql_query("SELECT SUM(base_amount)AS total_base FROM `balancesheet_total` WHERE group_one=2");
         $sum_row_base2 = mysql_fetch_array($sum_sql_base2);
         $sum_base2 = $sum_row_base2['total_base'];
         $sum_sql_prime2 = mysql_query("SELECT SUM(parime_amount)AS total_prime FROM `balancesheet_total` WHERE group_one=2");
         $sum_row_prime2 = mysql_fetch_array($sum_sql_prime2);
         $sum_prime2 = $sum_row_prime2['total_prime'];
         $t_sum_base = '';
         $t_sum_base2 = '';
         $t_sum_prime = '';
         $t_sum_prime2 = '';
         if($group==1){
          $t_sum_base = number_format($sum_base,2);
           $t_sum_prime = number_format($sum_prime,2);
           $t_sum_base2 = '';
           $t_sum_prime2 = '';
            mysql_query("INSERT INTO `balancesheet_sum` VALUES('','$sum_base','$sum_prime','$am_groupone')");
         }elseif($group==2){
          $t_sum_base2 = number_format($sum_base2,2);
          $t_sum_prime2 = number_format($sum_prime2,2);
          $t_sum_base = '';
          $t_sum_prime = '';
          mysql_query("INSERT INTO `balancesheet_sum` VALUES('','$sum_base2','$sum_prime2','$am_groupone')");
         }
         $pdf->Ln(10);
        $pdf->Cell(135, $row_height, 'Total '.$head_name, 0, 0, 'R', 1);
        $pdf->Cell(70, $row_height, $t_sum_base.$t_sum_base2, 0, 0, 'C', 1);
        $pdf->Cell(70, $row_height, $t_sum_prime.$t_sum_prime2, 0, 0, 'C', 1);
      }
      $sum = mysql_query("SELECT SUM(base_amount)AS totalBase FROM `balancesheet_sum`");
      $sum_r = mysql_fetch_array($sum);
      $sum2 = mysql_query("SELECT SUM(prime_amount)AS totalBase FROM `balancesheet_sum`");
      $sum_r2 = mysql_fetch_array($sum2);
      $t_t_b_a =  $sum_r['totalBase'];
      $t_t_p_a =  $sum_r2['totalBase'];
      $li_sql = mysql_query("SELECT * FROM `balancesheet_sum` WHERE group_one=2");
      $li_row = mysql_fetch_array($li_sql);
      $li_am_b = $li_row['base_amount'];
      $li_am_p = $li_row['prime_amount'];
      $fi_b_am = $t_t_b_a-$li_am_b;
      $fi_p_am = $t_t_p_a-$li_am_p;
      $pdf->Ln(15);
      $pdf->Cell(135, $row_height, 'Add: Profit / Loss During The Period', 0, 0, 'R', 1);
      $pdf->Cell(70, $row_height, number_format($sum_r['totalBase'],2), 0, 0, 'C', 1);
      $pdf->Cell(70, $row_height, number_format($sum_r2['totalBase'],2), 0, 0, 'C', 1);
      $pdf->Ln(15);
      $pdf->Cell(135, $row_height, 'Total Liabilities', 0, 0, 'R', 1);
      $pdf->Cell(70, $row_height, number_format($fi_b_am,2), 0, 0, 'C', 1);
      $pdf->Cell(70, $row_height, number_format($fi_p_am,2), 0, 0, 'C', 1);
      //
    }
  $pdf->Output();

  }elseif(isset($_POST["excel"])){  
  print'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />'; 
  if($word_four=='Summary'){
    $sql = mysql_query("SELECT * FROM am_group_one LIMIT 2")or die(mysql_error());
    if(mysql_num_rows($sql) > 0){
        $output .= '
        <table  class="table table-bordered" width="900">
          <tr>
            <th colspan="4" class="text-center"><h2>Balance Sheet <br>As at  '.$word_two.' '.$word_one.'</h2></th>
          </tr>
          <tr>
            <th colspan="4" class="text-left">For Branch: '.$word_three.'</th>
          </tr>
          <tr>
            <th colspan="2">PARTICULARS</th>
            <th class="text-right">CURRENT MONTH</th>
            <th class="text-right">YEAR-TO-DATE</th>
          </tr>
        ';
      }
    while($head = mysql_fetch_array($sql)){
      $head_name = $head['am_description'];
      $am_groupone = $head['am_groupone'];
      $group = $head['am_groupone'];
      $output.='
      <tr>
        <th colspan="4" class="text-left">'.$head_name.'</th>
      </tr>
      ';
      $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
      while($sub_row = mysql_fetch_array($subsql)){
        $am_description = $sub_row['am_description'];
        $am_grouptwo = $sub_row['am_grouptwo'];
        $car_acc  = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'") or die(mysql_error());
        while($car_acc_row = mysql_fetch_array($car_acc)){
          $am_accountcode = $car_acc_row['am_accountcode'];
          $am_groupone = $car_acc_row['am_groupone'];
          $am_grouptwo = $car_acc_row['am_grouptwo'];
          $base_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Base_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_date BETWEEN '$star_month' AND '$end_month' AND `c_branch`='$word_three'")or die(mysql_error());
          $base_row = mysql_fetch_array($base_sql);
          $prime_sql = mysql_query("SELECT SUM(`c_primeamt`)AS Prime_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_year='$word_one' AND `c_branch`='$word_three'") or die(mysql_error());
          $prime_row = mysql_fetch_array($prime_sql);
          $Base_Amount = $base_row['Base_Amount'];
          $Prime_Amount = $prime_row['Prime_Amount'];
          $t_b_a = number_format($Base_Amount,2);
          $t_p_a = number_format($Prime_Amount,2);
          $t_b = str_replace('-','', $Base_Amount);
          $t_p = str_replace('-','', $Prime_Amount);
          mysql_query("INSERT INTO `balancesheet_total` VALUES('','$t_p','$t_b','$am_groupone','$am_grouptwo')") or die(mysql_error());
        }
        $sum_head_base = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE am_grouptwo='$am_grouptwo'");
        $head_row = mysql_fetch_array($sum_head_base);
        $sum_head_base2 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE am_grouptwo='$am_grouptwo'");
        $head_row2 = mysql_fetch_array($sum_head_base2);
        $output .='
        <tr>
          <th colspan="2">'.$am_grouptwo.'-'.$am_description.'</th>
          <td class="text-right">'.number_format($head_row['base'],2).'</td>
          <td class="text-right">'.number_format($head_row2['prime'],2).'</td>
        <tr>
        ';
      }
      $sum_subhead_base = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE group_one='1'");
      $subhead_row = mysql_fetch_array($sum_subhead_base);
      $sum_subhead_base2 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE group_one='1'");
      $subhead_row2 = mysql_fetch_array($sum_subhead_base2);
      $sum_subhead_base3 = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE group_one='2'");
      $subhead_row3 = mysql_fetch_array($sum_subhead_base3);
      $sum_subhead_base4 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE group_one='2'");
      $subhead_row4 = mysql_fetch_array($sum_subhead_base4);
      $sum_base = $subhead_row['base'];
      $sum_base2 = $subhead_row3['base'];
      $t_base = $sum_base+$sum_base2;
      $sum_prime = $subhead_row2['prime'];
      $sum_prime2 = $subhead_row4['prime'];
      $t_prime = $sum_prime+$sum_prime2;
      if($group==1){
        $output.='
        <tr>
          <th colspan="2" class="text-right">Total '.$head_name.'</th>
          <th class="text-right">'.number_format($subhead_row['base'],2).'</th>
          <th class="text-right">'.number_format($subhead_row2['prime'],2).'</th>
        </tr>
        ';
      }else{
        $output.='
        <tr>
          <th colspan="2" class="text-right">Total '.$head_name.'</th>
          <th class="text-right">'.number_format($subhead_row3['base'],2).'</th>
          <th class="text-right">'.number_format($subhead_row4['prime'],2).'</th>
        </tr>
        ';
      }
    }
    $add = $t_base-$sum_base2;
    $add2 = $t_prime-$sum_prime2;
    $output.='
    <tr>
      <th colspan="2">Add: Profit / Loss During The Period</th>
      <th class="text-right">'.number_format($t_base,2).'</th>
      <th class="text-right">'.number_format($t_prime,2).'</th>
    </tr>
    <tr>
      <th colspan="2">Total Liabilities</th>
      <th class="text-right">'.number_format($add,2).'</th>
      <th class="text-right">'.number_format($add2,2).'</th>
    </tr>
    ';
  }else{
    $sql = mysql_query("SELECT * FROM am_group_one LIMIT 2")or die(mysql_error());
    if(mysql_num_rows($sql) > 0){
        $output .= '
        <table  class="table table-bordered" width="900">
          <tr>
            <th colspan="4" class="text-center"><h2>Balance Sheet <br>As at  '.$word_two.' '.$word_one.'</h2></th>
          </tr>
          <tr>
            <th colspan="4" class="text-left">For Branch: '.$word_three.'</th>
          </tr>
          <tr>
            <th colspan="2">PARTICULARS</th>
            <th class="text-right">CURRENT MONTH</th>
            <th class="text-right">YEAR-TO-DATE</th>
          </tr>
        ';
      }
      while($head = mysql_fetch_array($sql)){
        $head_name = $head['am_description'];
        $am_groupone = $head['am_groupone'];
        $group = $head['am_groupone'];
        $output.='
        <tr>
          <th colspan="4">'.$head_name.'</th>
        </tr>
        ';
        $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
        while($sub_row = mysql_fetch_array($subsql)){
          $am_description = $sub_row['am_description'];
          $am_grouptwo = $sub_row['am_grouptwo'];
          $output.='
          <tr>
            <th colspan="4">'.$am_grouptwo.'-'.$am_description.'</th>
          <tr>
          ';
          $car_acc  = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
          while($car_acc_row = mysql_fetch_array($car_acc)){
            $am_accountcode = $car_acc_row['am_accountcode'];
            $am_groupone = $car_acc_row['am_groupone'];
            $base_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Base_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_date BETWEEN '$star_month' AND '$end_month' AND `c_branch`='$word_three'")or die(mysql_error());
            $base_row = mysql_fetch_array($base_sql);
            $prime_sql = mysql_query("SELECT SUM(`c_primeamt`)AS Prime_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_year='$word_one' AND `c_branch`='$word_three'");
            $prime_row = mysql_fetch_array($prime_sql);
            $Base_Amount = $base_row['Base_Amount'];
            $Prime_Amount = $prime_row['Prime_Amount'];
            $t_b_a = number_format($Base_Amount,2);
            $t_p_a = number_format($Prime_Amount,2);
            $t_b = str_replace('-','', $Base_Amount);
            $t_p = str_replace('-','', $Prime_Amount);
            mysql_query("INSERT INTO `balancesheet_total` VALUES('','$t_p','$t_b','$am_groupone','')") or die(mysql_error());
            $f = '';
            $l = '';
            if($t_b_a<=0){
              $f = '(';
              $l = ')';
            }elseif($t_p_a<=0){
              $f = '(';
              $l = ')';
            }else{
              $f = '';
              $l = '';
            }
            if($t_b_a && $t_p_a=='0.00'){

            }else{
              if($f=='(' && $l==')' && $t_b==''){
                $f= '';
                $l = '';
                $t_b = '0.00';
              }elseif($f=='(' && $l==')' && $t_p==''){
                $f= '';
                $l = '';
                $t_p = '0.00';
              }
              $output.='
              <tr>
                <td colspan="2">'.$car_acc_row['am_accountcode'].'&nbsp;'.$car_acc_row['am_description'].'</td>
                <td class="text-right">'.$f.''.number_format($t_b,2).''.$l.'</td>
                <td class="text-right">'.$f.''.number_format($t_p,2).''.$l.'</td>
              </tr>
              ';
            }
          }
        }
        $sum_sql_base = mysql_query("SELECT SUM(base_amount)AS total_base FROM `balancesheet_total` WHERE group_one=1");
        $sum_row_base = mysql_fetch_array($sum_sql_base);
        $sum_base = $sum_row_base['total_base'];
        $sum_sql_prime = mysql_query("SELECT SUM(parime_amount)AS total_prime FROM `balancesheet_total` WHERE group_one=1");
        $sum_row_prime = mysql_fetch_array($sum_sql_prime);
        $sum_prime = $sum_row_prime['total_prime'];
        $sum_sql_base2 = mysql_query("SELECT SUM(base_amount)AS total_base FROM `balancesheet_total` WHERE group_one=2");
        $sum_row_base2 = mysql_fetch_array($sum_sql_base2);
        $sum_base2 = $sum_row_base2['total_base'];
        $sum_sql_prime2 = mysql_query("SELECT SUM(parime_amount)AS total_prime FROM `balancesheet_total` WHERE group_one=2");
        $sum_row_prime2 = mysql_fetch_array($sum_sql_prime2);
        $sum_prime2 = $sum_row_prime2['total_prime'];
        $t_sum_base = '';
        $t_sum_base2 = '';
        $t_sum_prime = '';
        $t_sum_prime2 = '';
        if($group==1){
          $t_sum_base = number_format($sum_base,2);
          $t_sum_prime = number_format($sum_prime,2);
          $t_sum_base2 = '';
          $t_sum_prime2 = '';
          mysql_query("INSERT INTO `balancesheet_sum` VALUES('','$sum_base','$sum_prime','$am_groupone')");
        }elseif($group==2){
          $t_sum_base2 = number_format($sum_base2,2);
          $t_sum_prime2 = number_format($sum_prime2,2);
          $t_sum_base = '';
          $t_sum_prime = '';
          mysql_query("INSERT INTO `balancesheet_sum` VALUES('','$sum_base2','$sum_prime2','$am_groupone')");
        }
        $output.='
        <tr>
          <th colspan="2" class="text-right">Total '.$head_name.'</th>
          <th class="text-right">'.$t_sum_base.''.$t_sum_base2.'</th>
          <th class="text-right">'.$t_sum_prime.''.$t_sum_prime2.'</th>
        </tr>
        ';
      }
      $sum = mysql_query("SELECT SUM(base_amount)AS totalBase FROM `balancesheet_sum`");
      $sum_r = mysql_fetch_array($sum);
      $sum2 = mysql_query("SELECT SUM(prime_amount)AS totalBase FROM `balancesheet_sum`");
      $sum_r2 = mysql_fetch_array($sum2);
      $t_t_b_a =  $sum_r['totalBase'];
      $t_t_p_a =  $sum_r2['totalBase'];
      $li_sql = mysql_query("SELECT * FROM `balancesheet_sum` WHERE group_one=2");
      $li_row = mysql_fetch_array($li_sql);
      $li_am_b = $li_row['base_amount'];
      $li_am_p = $li_row['prime_amount'];
      $fi_b_am = $t_t_b_a-$li_am_b;
      $fi_p_am = $t_t_p_a-$li_am_p;
      $output.='
      <tr>
        <th colspan="2">Add: Profit / Loss During The Period</th>
        <th class="text-right">'.number_format($sum_r['totalBase'],2).'</th>
        <th class="text-right">'.number_format($sum_r2['totalBase'],2).'</th>
      </tr>
      <tr>
      <th colspan="2">Total Liabilities</th>
      <th class="text-right">'.number_format($fi_b_am,2).'</th>
      <th class="text-right">'.number_format($fi_p_am,2).'</th>
    </tr>
      ';
  }

                    
    $output .= '</table>';  
    header("Content-Type: application/xls");   
    header("Content-Disposition: attachment; filename=Balance Sheet.xls");  
    echo $output;  

}

mysql_query("DELETE  FROM `balancesheet_total`") or die(mysql_error());
mysql_query("DELETE  FROM `balancesheet_sum`") or die(mysql_error());
?>