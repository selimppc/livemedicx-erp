<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GL Account Report</title>

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
                  //print_r($s);
                  mysql_query("INSERT INTO temp VALUES('','$s','$i')");
                  }
                $query = mysql_query("SELECT * FROM `temp` WHERE flag = 1");
                $row1 = mysql_fetch_array($query);
                $first_value =  $row1['sentence'];
                $arr = explode('&',trim($first_value));
                $f_word =  $arr[0];
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 2");
                $row2 = mysql_fetch_array($query2);
                $second_word = $row2['sentence'];
                $arr2 = explode('&',trim($second_word));
                $s_word =  $arr2[0];

                //echo $f_word.'<br>';
               // echo $s_word;
                print_r($f_word);
                echo '<br>';
                //print_r($s_word);
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                //echo $from_date;
                //echo $to_date;
                $sq = mysql_query("SELECT * FROM am_chartofaccounts WHERE am_accountcode='$f_word'");
                $rsq = mysql_fetch_array($sq);
              ?>
              
  						<div class="row">
  								<h3 class="text-center"><b>GL Account Report</b></h3>
                  <h3 class="text-center">GL Account : <?php echo $rsq['am_description']?></h3>
                  <h3 class="text-center">For : <?php echo $s_word?></h3>
                  <h3 class="text-center">From: <?php echo $from_date?> To: <?php echo $to_date?></h3>
  						</div>
                <form method="post" action="excel/ac_gl_report.php?f_word=<?php echo $f_word?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>&s_word=<?php echo $s_word?>" >
  							<table class="table table-striped table-bordered table-hover table-highlight table-checkable" data-provide="datatable" data-info="false"data-search="false"data-display-rows="15"data-length-change="false"data-paginate="true">
  								<thead>
  									<tr>
                      <th>GL Account Code</th>
  										<th>GL Account Description</th>
  										<th>Transaction Code</th>
  										<th>Date</th>
  										<th>Currency</th>
  										<th>Exchange Rate</th>
  										<th>Debit</th>
                      <th>Credit</th>
                      <th>Debit local</th>
  										<th>Credit local</th>
  									</tr>
  								</thead>
  								<tbody>
                    <?php
                    $sql = '';
					
                    if($s_word==false){
                      $sql =mysql_query("SELECT * FROM `am_balance` WHERE c_accountcode='$f_word' AND c_date BETWEEN '$from_date' AND '$to_date'");
                    }else{
                      $sql =mysql_query("SELECT * FROM `am_balance` WHERE c_accountcode='$f_word' AND c_date BETWEEN '$from_date' AND '$to_date' AND c_branch='$s_word'");
                    }
                    
                    while($r = mysql_fetch_array($sql)){
                      $c_vouchernumber = $r['c_vouchernumber'];

                      //print_r($c_vouchernumber);
                      $c_date = $r['c_date'];
                     //  print_r($c_date);
                      $query = mysql_query("SELECT * FROM `am_vw_voucher` WHERE am_vouchernumber='$c_vouchernumber'");

                      /* written by majeed*/
                      $test=mysql_fetch_assoc($query);
                      $tesr=$test['am_accountcode'];
                      $acd=$test['am_description'];
                      $acur=$test['am_currency'];

                      if($f_word==$tesr)
                      {
                        $sqltes=mysql_query("SELECT * FROM am_vw_voucher WHERE am_accountcode!='".$tesr."' AND am_vouchernumber='$c_vouchernumber'");
                      
                    /* end of majeed written*/
                    while($row = mysql_fetch_array($sqltes)){

    
                        $exchagerate = $row['am_exchagerate'];
                       // $acode=$row['am_accountcode'];
                        //print_r($acode);

                        $credit_local = $row['prime_debit'] * $exchagerate;
                        $debet_local = $row['prime_credit'] * $exchagerate;
                        print_r($f_word);
                        $cursql=mysql_query("SELECT c_currency from am_balance WHERE c_accountcode='$f_word'");
                        $curres=mysql_fetch_array($cursql);
                        $acurr=$curres['c_currency'];
                      echo'
                    
                      <tr>
                      <td>'.$tesr.'</td>
                      <td>'.$acd.'</td>
                      <td>'.$row['am_vouchernumber'].'</td>
                      <td>'.$c_date.'</td>
                      <td>'.$acurr.'</td>
                      <td>'.$row['am_exchagerate'].'</td>
                      <td>'.$row['prime_credit'].'</td>
                      <td>'.$row['prime_debit'].'</td>
                      <td>'.$debet_local.'</td>
                      <td>'.$credit_local.'</td>
                    </tr>';
                     }
                     }
                    }
                    ?> 
  								</tbody>
  							</table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="export_excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
             </form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
//mysql_query("DELETE  FROM `balance`") or die(mysql_error());
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