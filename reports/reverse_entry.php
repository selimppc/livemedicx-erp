<?php 
error_reporting(0);
include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Reverse Entry Voucher</title>

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
                  //mysql_query("INSERT INTO temp VALUES('','$s','$i')");
                  }
                $query = mysql_query("SELECT * FROM `temp` WHERE flag = 1");
                
                //echo $first_word.'<br>';
                //echo $second_word.'<br>';
                //echo $third_word.'<br>';
                $pVoucherNo = $_GET['pVoucherNo'];

              ?>
              
  						<div class="row">
                <div class="col-md-12">
                  <h2 style="border-bottom:2px solid #000" class="col-md-5"><b>Reverse Entry Voucher</b></h2>
                </div>
  						</div>
              <div class="row">
              <div class="col-md-12">
  						<div>
                <form method="post" action="excel/reverse_entry.php?pVoucherNo=<?php echo $pVoucherNo?>">
  							<?php
                $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE am_vouchernumber='$pVoucherNo'");
                while($row = mysql_fetch_array($sql)){              
                print'<table  class="table table-borderless2">
                  <thead>
                    <tr>
                      <th>Voucher Number</th>
                      <td>'.$row['am_vouchernumber'].'</td>
                      <th>Year</th>
                      <td>'.$row['am_year'].'</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <td>'.$row['am_date'].'</td>
                      <th>Period</th>
                      <td>'.$row['am_period'].'</td>
                      <td></td>
                      <td></td>
                      <th>Status</th>
                      <td>'.$row['am_status'].'</td>
                    </tr>
                    <tr>
                      <th>Branch</th>
                      <td>'.$row['am_branch'].'</td>
                      <th>Note</th>
                      <td colspan="5">'.$row['am_note'].'</td>
                    </tr>
                  </thead>';
                  
                  print'
                  <tbody>
                    <tr>
                        <th style="border:1px solid #000">Code</th>
                        <th style="border:1px solid #000">Accounts Description</th> 
                        <th style="border:1px solid #000">Currency</th>   
                        <th style="border:1px solid #000">Ex. Rate</th>   
                        <th style="border:1px solid #000">Debit</th>    
                        <th style="border:1px solid #000">Credit</th> 
                        <th style="border:1px solid #000">Debit Local</th>  
                        <th style="border:1px solid #000">Credit Local</th> 
                      </tr>';
                  $product = mysql_query("SELECT * FROM `am_voucherdetail`,`am_chartofaccounts` WHERE (am_voucherdetail.am_accountcode=am_chartofaccounts.am_accountcode) AND am_voucherdetail.am_vouchernumber='$pVoucherNo'");
                  while($product_row = mysql_fetch_array($product)){
                    $am_primeamt = $product_row['am_primeamt'];
                    $am_baseamt = $product_row['am_baseamt'];
                    $debit = '';
                    $credit = '';
                    $debitl = '';
                    $creditl = '';
                    $fcredit = '';
                    $fcreditl = '';
                    if($am_primeamt>0){
                      $debit = number_format($am_primeamt,2);
                    }else{
                      $credit = number_format($am_primeamt,2);
                      $fcredit = str_replace('-','',$credit);
                    }
                    if($am_baseamt>0){
                      $debitl = number_format($am_baseamt,2);
                    }else{
                      $creditl = number_format($am_baseamt,2);
                      $fcreditl = str_replace('-', '', $creditl);
                    }
                    $am_vouchernumber = $product_row['am_vouchernumber'];
                    $sum_debet = mysql_query("SELECT SUM(`am_primeamt`)AS Dabet FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_primeamt>0");
                    $sum_debet_row = mysql_fetch_array($sum_debet);
                    $sum_credit = mysql_query("SELECT SUM(`am_primeamt`)AS Credit FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_primeamt<0");
                    $sum_credit_row = mysql_fetch_array($sum_credit);
                    $Dabet = number_format($sum_debet_row['Dabet'],2);
                    $Dabets = $sum_debet_row['Dabet'];
                    $Credit = number_format($sum_credit_row['Credit'],2);
                    $Credits = $sum_credit_row['Credit'];
                    $fCredit = str_replace('-', '', $Credit);
                    $fCredits = str_replace('-', '', $Credits);
                    $sum_debetl = mysql_query("SELECT SUM(`am_baseamt`)AS Dabetl FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_baseamt>0");
                    $sum_debetl_row = mysql_fetch_array($sum_debetl);
                    $sum_creditl = mysql_query("SELECT SUM(`am_baseamt`)AS Creditl FROM `am_voucherdetail` WHERE `am_vouchernumber`='$am_vouchernumber' AND am_baseamt<0");
                    $sum_creditl_row = mysql_fetch_array($sum_creditl);
                    $Dabetl = number_format($sum_debetl_row['Dabetl'],2);
                    $Dabetls = $sum_debetl_row['Dabetl'];
                    $Creditl = number_format($sum_creditl_row['Creditl'],2);
                    $Creditls = $sum_creditl_row['Creditl'];
                    $fCreditl = str_replace('-', '', $Creditl);
                    $fCreditls = str_replace('-', '', $Creditls);
                    
                  print'
                    <tr>
                      <td>'.$product_row['am_accountcode'].'</td>
                      <td>'.$product_row['am_description'].'</td>
                      <td>'.$product_row['am_currency'].'</td>
                      <td>'.$product_row['am_exchagerate'].'</td>
                      <td>'.$debit.'</td>
                      <td>'.$fcredit.'</td>
                      <td>'.$debitl.'</td>
                      <td>'.$fcreditl.'</td>
                    </tr>';
                    }
                  mysql_query("INSERT INTO `jurnal_sum` VALUES('','$Dabets','$fCredits','$Dabetls','$fCreditls')");
                  print'
                    <tr>
                      <td colspan="4"></td>
                      <th style="border-top:1px solid #000;font-size:11px">'.$Dabet.'</th>
                      <th style="border-top:1px solid #000;font-size:11px">'.$fCredit.'</th>
                      <th style="border-top:1px solid #000;font-size:11px">'.$Dabetl.'</th>
                      <th style="border-top:1px solid #000;font-size:11px">'.$fCreditl.'</th>
                    </tr>
                  </tbody>
                </table>';
              }
              $dabet_sum = mysql_query("SELECT SUM(`Dabet`) AS dabet_sum FROM `jurnal_sum`");
              $debet_sum_row = mysql_fetch_array($dabet_sum);
              $credit_sum = mysql_query("SELECT SUM(`fCredit`) AS credit_sum FROM `jurnal_sum`");
              $credit_sum_row = mysql_fetch_array($credit_sum);
              $dabetl_sum = mysql_query("SELECT SUM(`Dabetl`) AS dabetl_sum FROM `jurnal_sum`");
              $debetl_sum_row = mysql_fetch_array($dabetl_sum);
              $creditl_sum = mysql_query("SELECT SUM(`fCreditl`) AS creditl_sum FROM `jurnal_sum`");
              $creditl_sum_row = mysql_fetch_array($creditl_sum);
              print'
              <table  class="table table-borderless2">
                <tr>
                  <th width="533px" class="text-right">Total Local Report Summary</th>
                  <th style="border-top:1px solid #000;font-size:11px">'.number_format($debetl_sum_row['dabetl_sum'],2).'</th>
                  <th style="border-top:1px solid #000;font-size:11px">'.number_format($creditl_sum_row['creditl_sum'],2).'</th>
                </tr>
              </table>
              ';
                ?>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div></div></div></div>
             <!-- </form>-->
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
<?php
mysql_query("DELETE  FROM `jurnal_sum`") or die(mysql_error());
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>