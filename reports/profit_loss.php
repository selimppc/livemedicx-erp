<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Profit & Loss Report</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="portlet">
            <div class="portlet-content">
              <?php
                function url_origin( $s,$use_forwarded_host = false){
                  $ssl = (! empty($s['HTTPS'])&& $s['HTTPS'] == 'on');
                  $sp = strtolower($s['SERVER_PROTOCOL']);
                  $protocol = substr( $sp, 0, strpos($sp, '/')).(($ssl)?'s':'');
                  $port = $s['SERVER_PORT'];
                  $port = ((! $ssl && $port=='80')||($ssl && $port=='443'))?'':':'.$port;
                  $host = ($use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST']))?$s['HTTP_X_FORWARDED_HOST']:(isset( $s['HTTP_HOST'])?$s['HTTP_HOST']:null);
                  $host = isset($host)? $host :$s['SERVER_NAME'].$port;
                  return $protocol.'://'.$host;
                }

                function full_url($s,$use_forwarded_host = false)
                {
                    return url_origin($s,$use_forwarded_host).$s['REQUEST_URI'];
                }
                $absolute_url = full_url( $_SERVER );
                function first_sentence($absolute_url){
                  $pos = strpos($absolute_url, '=');
                  if($pos === false){
                    return $absolute_url;
                  }else{
                    return substr($absolute_url, 0, $pos+1);
                  }
                }
                $count = substr_count($absolute_url,'=');
                $name_array = explode('=', $absolute_url);
                $name_arry = array_filter($name_array);
                $countt = $count;
                print'<input type="hidden" name="name" value="'.first_sentence($absolute_url).'">';
                for($i=1;$i<=$count;$i++){
                  $name =  next($name_arry);
                  print'<input type="hidden" name="name'.$i.'" value="'.$name.'">';
                  $s   = $name;
                  mysql_query("INSERT INTO temp VALUES('','$s','$i')");
                  }
                $query = mysql_query("SELECT * FROM `temp` WHERE flag = 1");
                $row = mysql_fetch_array($query);
                $first_value =  $row['sentence'];
                $arr = explode('&',trim($first_value));
                $word_one =  $arr[0];

                $query1 = mysql_query("SELECT * FROM `temp` WHERE flag = 2");
                $row1 = mysql_fetch_array($query1);
                $first_value1 =  $row1['sentence'];
                $arr1 = explode('&',trim($first_value1));
                $word_two =  $arr1[0];
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
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 3");
                $row2 = mysql_fetch_array($query2);
                $first_value2 =  $row2['sentence'];
                $arr2 = explode('&',trim($first_value2));
                $w_three =  $arr2[0];
                $word_three = str_replace('+', ' ', $w_three);
                $query3 = mysql_query("SELECT * FROM `temp` WHERE flag = 4");
                $row3 = mysql_fetch_array($query3);
                $first_value3 =  $row3['sentence'];
                $arr3 = explode('&',trim($first_value3));
                $word_four =  $arr3[0];

                //echo $word_one.'<br>';
                //echo $word_two.'<br>';
                //echo $word_three.'<br>';
                //echo $word_four;
                //echo $star_month.'<br>';
                //echo $end_month;
                
              ?>
              
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-center"><b>Profit & Loss Statement<br>As at<br><?php echo $word_two?>, <?php echo $word_one?></b></h2>
                </div>
              </div>
              <div class="row">
              <div class="col-md-12">
              <h3 style="border-bottom:1px solid #CCC">For Branch: <?php echo $word_three?></h3>
          <div class="table-responsive">
                <form method="post" action="excel/profit_loss.php?word_one=<?php echo $word_one?>&word_two=<?php echo $word_two?>&word_three=<?php echo $word_three?>&word_four=<?php echo $word_four?>" >
                
                  <table  class="table table-bordered">
                    <thead style="border: 1px solid #666; background: #CCC; height: 40px;">
                      <tr>
                        <th colspan="2">PARTICULARS</th>
                        <th class="text-right">CURRENT MONTH</th>
                        <th class="text-right">YEAR-TO-DATE</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($word_four=='Summary'){
                      $sql = mysql_query("SELECT * FROM `am_group_one` ORDER BY id DESC LIMIT 2")or die(mysql_error());
                      while($head = mysql_fetch_array($sql)){
                        $head_name = $head['am_description'];
                        $am_groupone = $head['am_groupone'];
                        $group = $head['am_groupone'];
                        print'
                      <tr>
                        <th colspan="4">'.$head_name.'</th>
                      </tr>
                      ';
                      $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                      while($sub_row = mysql_fetch_array($subsql)){
                        $am_description = $sub_row['am_description'];
                        $am_grouptwo = $sub_row['am_grouptwo'];
                        //echo $am_grouptwo;
                        
                        $car_acc  = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'") or die(mysql_error());
                        while($car_acc_row = mysql_fetch_array($car_acc)){
                          $am_accountcode = $car_acc_row['am_accountcode'];
                          $am_groupone = $car_acc_row['am_groupone'];
                          //echo $am_groupone;
                          $am_grouptwo = $car_acc_row['am_grouptwo'];
                          $base_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Base_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_date BETWEEN '$star_month' AND '$end_month' AND `c_branch`='$word_three'")or die(mysql_error());
                          $base_row = mysql_fetch_array($base_sql);

                          $prime_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Prime_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_year='$word_one' AND `c_branch`='$word_three'") or die(mysql_error());
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
                        print'
                        <tr>
                          <th colspan="2">'.$am_grouptwo.'-'.$am_description.'</th>
                          <td class="text-right">'.number_format($head_row['base'],2).'</td>
                          <td class="text-right">'.number_format($head_row2['prime'],2).'</td>
                        <tr>
                        ';
                      }
                      $sum_subhead_base = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE group_one=4");
                      $subhead_row = mysql_fetch_array($sum_subhead_base);
                      $sum_subhead_base2 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE group_one=4");
                      $subhead_row2 = mysql_fetch_array($sum_subhead_base2);

                      $sum_subhead_base3 = mysql_query("SELECT SUM(base_amount)As base FROM balancesheet_total WHERE group_one=3");
                      $subhead_row3 = mysql_fetch_array($sum_subhead_base3);
                      $sum_subhead_base4 = mysql_query("SELECT SUM(parime_amount)As prime FROM balancesheet_total WHERE group_one=3");
                      $subhead_row4 = mysql_fetch_array($sum_subhead_base4);

                      $sum_base = $subhead_row['base'];
                      $sum_base2 = $subhead_row3['base'];
                      $t_base = $sum_base+$sum_base2;

                      $sum_prime = $subhead_row2['prime'];
                      $sum_prime2 = $subhead_row4['prime'];
                      $t_prime = $sum_prime+$sum_prime2;
                      if($group==4){

                        print'
                      <tr>
                        <th colspan="2" class="text-right">Total '.$head_name.'</th>
                        <th class="text-right">'.number_format($subhead_row['base'],2).'</th>
                        <th class="text-right">'.number_format($subhead_row2['prime'],2).'</th>
                      </tr>
                      '; 
                      }else{
                        print'
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
                      print'
                    <tr>
                      <th colspan="2">Add: Profit / Loss During The Period</th>
                      <th class="text-right">'.number_format($t_base,2).'</th>
                      <th class="text-right">'.number_format($t_prime,2).'</th>
                    </tr>
                    <tr>
                      <th colspan="2">Total Expenses</th>
                      <th class="text-right">'.number_format($add,2).'</th>
                      <th class="text-right">'.number_format($add2,2).'</th>
                    </tr>
                    ';

                    }else{
                    $sql = mysql_query("SELECT * FROM `am_group_one` ORDER BY id DESC LIMIT 2")or die(mysql_error());
                    while($head = mysql_fetch_array($sql)){
                      $head_name = $head['am_description'];
                      $am_groupone = $head['am_groupone'];
                      //echo $am_groupone;
                      $group = $head['am_groupone'];
                      //echo $group;
                      print'
                      <tr>
                        <th colspan="4">'.$head_name.'</th>
                      </tr>
                      ';
                      $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                      while($sub_row = mysql_fetch_array($subsql)){

                        $am_description = $sub_row['am_description'];
                        //echo $am_description;
                        $am_grouptwo = $sub_row['am_grouptwo'];
                        //echo $am_grouptwo;
                        print'
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

                          $prime_sql = mysql_query("SELECT SUM(`c_baseamt`)AS Prime_Amount FROM `am_balance` WHERE c_accountcode='$am_accountcode' AND c_year='$word_one' AND `c_branch`='$word_three'");
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
                            print'
                          <tr>
                            <td colspan="2">'.$car_acc_row['am_accountcode'].'&nbsp;'.$car_acc_row['am_description'].'</td>
                            <td class="text-right">'.$f.''.number_format($t_b,2).''.$l.'</td>
                            <td class="text-right">'.$f.''.number_format($t_p,2).''.$l.'</td>
                          </tr>
                          ';
                          }
                          
                        }
                        
                      }
                      $sum_sql_base = mysql_query("SELECT SUM(base_amount)AS total_base FROM `balancesheet_total` WHERE group_one=4");
                      $sum_row_base = mysql_fetch_array($sum_sql_base);
                      $sum_base = $sum_row_base['total_base'];

                      $sum_sql_prime = mysql_query("SELECT SUM(parime_amount)AS total_prime FROM `balancesheet_total` WHERE group_one=4");
                      $sum_row_prime = mysql_fetch_array($sum_sql_prime);
                      $sum_prime = $sum_row_prime['total_prime'];

                      $sum_sql_base2 = mysql_query("SELECT SUM(base_amount)AS total_base FROM `balancesheet_total` WHERE group_one=3");
                      $sum_row_base2 = mysql_fetch_array($sum_sql_base2);
                      $sum_base2 = $sum_row_base2['total_base'];

                      $sum_sql_prime2 = mysql_query("SELECT SUM(parime_amount)AS total_prime FROM `balancesheet_total` WHERE group_one=3");
                      $sum_row_prime2 = mysql_fetch_array($sum_sql_prime2);
                      $sum_prime2 = $sum_row_prime2['total_prime'];
                      // echo $sum_prime2;

                      $t_sum_base = '';
                      $t_sum_base2 = '';
                      $t_sum_prime = '';
                      $t_sum_prime2 = '';
                      if($group==4){
                        $t_sum_base = number_format($sum_base,2);
                        $t_sum_prime = number_format($sum_prime,2);
                        $t_sum_base2 = '';
                        $t_sum_prime2 = '';
                        mysql_query("INSERT INTO `balancesheet_sum` VALUES('','$sum_base','$sum_prime','$am_groupone')");
                      }elseif($group==3){
                        $t_sum_base2 = number_format($sum_base2,2);
                        $t_sum_prime2 = number_format($sum_prime2,2);
                        $t_sum_base = '';
                        $t_sum_prime = '';
                        mysql_query("INSERT INTO `balancesheet_sum` VALUES('','$sum_base2','$sum_prime2','$am_groupone')");
                      }

                      print'
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
                    print'
                    <tr>
                      <th colspan="2">Add: Profit / Loss During The Period</th>
                      <th class="text-right">'.number_format($sum_r['totalBase'],2).'</th>
                      <th class="text-right">'.number_format($sum_r2['totalBase'],2).'</th>
                    </tr>
                    <tr>
                      <th colspan="2">Total Expenses</th>
                      <th class="text-right">'.number_format($fi_b_am,2).'</th>
                      <th class="text-right">'.number_format($fi_p_am,2).'</th>
                    </tr>
                    ';
                  }
                    ?>     
                    </tbody>
                  </table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div></div></div>
             </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
mysql_query("DELETE  FROM `balancesheet_total`") or die(mysql_error());
mysql_query("DELETE  FROM `balancesheet_sum`") or die(mysql_error());

?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>