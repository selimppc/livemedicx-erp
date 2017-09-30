<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Trial Balance Report</title>

    <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/font-awesome.min.css">
  <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet">
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
                $row1 = mysql_fetch_array($query);
                $first_value =  $row1['sentence'];
                $arr = explode('&',trim($first_value));
                $f_word =  $arr[0];
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
              ?>
              
  						<div class="row">
  							<div class="col-md-6">
  								<h3><b>Trial Balance of <?php echo $des?></b></h3>
                  <h4 style="border-bottom:1px solid #CCC"><b>From  <?php echo $from_date?> To <?php echo $to_date?></b></h4>
  							</div>
                <div class="col-md-2"></div>
  						</div>
                <form method="post" action="excel/trial_balance_consider.php?f_word=<?php echo $f_word?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" >
  							<table class="table table-striped table-bordered table-hover table-highlight" data-provide="datatable" data-info="false"data-search="false"data-display-rows="15"data-length-change="false"data-paginate="true">
  								<thead>
  									<tr>
                      <th data-filterable="true">SL Account Code & Description</th>
  										<th>Balance B/F (Debit)</th>
  										<th>Balance B/F (Credit)</th>
                      <th>Current Date Range(Debit)</th>
                      <th>Current Date Range(Credit)</th>
  										<th>Balance C/F(Debit)</th>
                      <th>Balance C/F(Credit)</th>
  									</tr>
  								</thead>
  								<tbody>
                    <?php
                    $sql = mysql_query("SELECT * FROM `am_group_one`");
                    while($row = mysql_fetch_array($sql)){
                      $am_groupone = $row['am_groupone'];
                      $sub_sql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                      while($sub_row = mysql_fetch_array($sub_sql)){
                        $am_grouptwo = $sub_row['am_grouptwo'];
                        $content = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'") or die(mysql_error());
                        while($con_row = mysql_fetch_array($content)){
                          $am_accountcode = $con_row['am_accountcode'];
                          $sum_bf = mysql_query("SELECT SUM(c_baseamt)AS sumbf FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date <'$from_date'") or die(mysql_error());
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
                          $sum_cdr = mysql_query("SELECT SUM(c_baseamt)AS sumcdr FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date BETWEEN '$from_date' and '$to_date'") or die(mysql_error());
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

                          $sum_cf = mysql_query("SELECT SUM(c_baseamt)AS sumcf FROM am_balance WHERE c_accountcode='$am_accountcode' AND c_branch='$f_word' AND c_date BETWEEN '$from_date' and '$to_date'") or die(mysql_error());
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
                            if($sumbfC==false){
                              $sumbfC = '0.00';
                            }
                            if($sumbfD==false){
                              $sumbfD = '0.00';
                            }
                          print'
                              <tr>
                                <td>'.$con_row['am_accountcode'].'&nbsp;'.$con_row['am_description'].'</td>
                                <td>'.number_format((float)$sumbfC,2).'</td>
                                <td>'.number_format((float)$sumbfD,2).'</td>
                                <td>'.number_format((float)$sumcdrC,2).'</td>
                                <td>'.number_format((float)$sumcdrD,2).'</td>
                                <td>'.number_format((float)$sumcfC,2).'</td>
                                <td>'.number_format((float)$sumcfD,2).'</td>
                              </tr>
                              ';
                              }
                        }
                      }
                    }
                    echo '</tbody>';
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
                  print'
                  <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>'.number_format($bfc_row['bfc'],2).'</th>
                    <th>'.number_format($bfd_row['bfd'],2).'</th>
                    <th>'.number_format($drC_row['drC'],2).'</th>
                    <th>'.number_format($drd_row['drd'],2).'</th>
                    <th>'.number_format($cfC_row['cfC'],2).'</th>
                    <th>'.number_format($cfd_row['cfd'],2).'</th>
                  </tr>
                  </tfoot>
                  ';
                    ?>
  							</table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
             </form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
mysql_query("DELETE  FROM `trial_sum`") or die(mysql_error());
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="./js/libs/jquery-1.10.1.min.js"></script>
  <script src="./js/libs/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="./js/libs/bootstrap.min.js"></script>
  
  <!-- Plugin JS -->
  <script src="./js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="./js/plugins/datatables/DT_bootstrap.js"></script>
  <script src="./js/plugins/tableCheckable/jquery.tableCheckable.js"></script>
  <script src="./js/plugins/icheck/jquery.icheck.min.js"></script>

  <!-- App JS -->
  <script src="./js/target-admin.js"></script>
  </body>
</html>