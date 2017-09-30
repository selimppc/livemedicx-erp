<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Supplier List Report</title>

    <!-- Bootstrap -->
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
                $row1 = mysql_fetch_array($query);
                $first_value =  $row1['sentence'];
                $arr = explode('&',trim($first_value));
                $f_word =  $arr[0];
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 4");
                $row2 = mysql_fetch_array($query2);
                $second_word = $row2['sentence'];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                $b=$_GET['b_word'];
              //print_r($b);
               // echo $second_word;
              ?>
              
  						<div class="row">
                <form action="excel/supplier_report.php?f_word=<?php echo $f_word?>&second_word=<?php echo $second_word?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" method="post">
  							<div class="col-md-12" style="border-bottom:1px solid #000; margin-bottom:10px;">
  								<h2 class="text-center"><b>Supplier Ledger</b></h2>
                  <h4 class="text-center"><b>Form <?php echo $from_date.' To '. $to_date?></b></h4>
                </div>
                <?php
                $ssql = '';
                 
                  $ssql = mysql_query("SELECT * FROM `cm_suppliermaster`");
               
                 

                 while($row = mysql_fetch_array($ssql)){
                 $cm_supplierid = $row['cm_supplierid'];
                
                print'
                <div class="col-md-12" style="border-bottom:2px dotted #000; margin-bottom:10px;">
                  <div class="col-md-7">
                    <h4><b>'.$cm_supplierid.'</b>&nbsp; '.$row['cm_orgname'].'</h4>
                    <h4>'.$row['cm_address'].'</h4>
                  </div>
                  <div class="col-md-5 text-right">
                    <h4>All amount shown in local currecny</h4>
                  </div>                  
                
                <div class="col-md-12">
                  <table class="table table-borderless2 table-responsive">
                    <thead>
                      <tr>
                        <th style="border:1px solid #000;">Date</th>
                        <th style="border:1px solid #000;">Voucher Number</th>
                        <th style="border:1px solid #000;">Description</th>
                        <th style="border:1px solid #000;">Currency & Exchange Rate</th>
                        <th style="border:1px solid #000;">Payable Amount</th>
                        <th style="border:1px solid #000;">Paid Amount</th>
                      </tr>
                    </thead>
                    <tbody>';
                    $sql = mysql_query("SELECT cm_suppliermaster.cm_supplierid,cm_suppliermaster.cm_orgname,cm_suppliermaster.cm_address,am_vouhcerheader.am_branch,am_vouhcerheader.am_vouchernumber,am_vouhcerheader.am_date,am_voucherdetail.am_currency,am_voucherdetail.am_exchagerate,am_voucherdetail.am_baseamt FROM ((am_voucherdetail INNER JOIN cm_suppliermaster ON am_voucherdetail.am_subacccode = cm_suppliermaster.cm_supplierid) INNER JOIN am_vouhcerheader ON am_voucherdetail.am_vouchernumber = am_vouhcerheader.am_vouchernumber) WHERE am_vouhcerheader.am_branch='$b' AND am_vouhcerheader.am_date <='$to_date'ORDER BY am_vouhcerheader.am_branch,cm_suppliermaster.cm_supplierid,am_vouhcerheader.am_date");
                  while($ro = mysql_fetch_array($sql)){
                    $am_vouchernumber = substr($ro['am_vouchernumber'],0,4);
                    $des = '';
                    if($am_vouchernumber=='AP--'){
                      $des = 'Account Payable';
                    }else{
                      $des = 'Payable Received';
                    }
                    $pay = '';
                    $paid = '';
                    $amount = $ro['am_baseamt'];
                    if($amount<0){
                      $pay = str_replace('-','',$amount);
                    }else{
                      $paid = $amount;
                    }
                    if($pay==false){
                      $pay = '0.00';
                    }
                    if($paid==false){
                      $paid = '0.00';
                    }
                    $cm_supplierid = $ro['cm_supplierid'];
                    mysql_query("INSERT INTO `supplier_total` VALUES('','$pay','$paid','$cm_supplierid')") or die(mysql_error());
                      print'
                      <tr>
                        <td>'.$ro['am_date'].'</td>
                        <td>'.$ro['am_vouchernumber'].'</td>
                        <td>'.$des.'</td>
                        <td>'.$ro['am_currency'].' &bnsp; '.$ro['am_exchagerate'].'</td>
                        <td>'.$pay.'</td>
                        <td>'.$paid.'</td>
                      </tr>
                      
                      ';
                   }
                   $paysql = mysql_query("SELECT SUM(`pay_total`) As Pay FROM `supplier_total` WHERE `supplier_id`='$cm_supplierid'") or die(mysql_error());
                   $payrow = mysql_fetch_array($paysql);
                   $paidsql = mysql_query("SELECT SUM(`paid_total`) As Paid FROM `supplier_total` WHERE `supplier_id`='$cm_supplierid'") or die(mysql_error());
                   $paidrow = mysql_fetch_array($paidsql);
                   $payable = $payrow['Pay'];
                   $paidable = $paidrow['Paid'];
                   $apay='';
                   $apaid = '';
                   if($payable<$paidable){
                    $apaid = $paidable-$payable;
                    $apay = '0.00';
                   }else{
                    $apay = '0.00';
                    $apaid = '0.00';
                   }
                   if($payable>$paidable){
                    $apay = $payable-$paidable;
                    $apaid = '0.00';
                   }else{
                    $apay = '0.00';
                    $apaid = '0.00';
                   }
                    print' 
                    <tr>
                        <td colspan="4" align="right"><b>Total Amount:</b></td>
                        <td style="border-top:1px solid #000;"><b>'.$payrow['Pay'].'</b></td>
                        <td style="border-top:1px solid #000;"><b>'.$paidrow['Paid'].'</b></td>
                      </tr>
                      <tr>
                        <td colspan="4" align="right"><b>Closing Balance:</b></td>
                        <td style="border-top:1px solid #000;"><b>'.$apay.'</b></td>
                        <td style="border-top:1px solid #000;"><b>'.$apaid.'</b></td>
                      </tr> 
                    </tbody>
                  </table>
                </div></div>
                ';
                 
               }
              ?>
              
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div></form>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
mysql_query("DELETE  FROM `supplier_total`") or die(mysql_error());
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>