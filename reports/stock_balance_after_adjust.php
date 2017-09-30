<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Accounts Receivable Voucher</title>

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
                $row1 = mysql_fetch_array($query);
                $first_value =  $row1['sentence'];
                $arr = explode('&',trim($first_value));
                $f_word =  $arr[0];
                $first_word = str_replace('+', ' ', $f_word);
                //echo $first_word;
                $date = $_GET['from_date'];
                
              ?>
              
  						<div class="row">
                <div class="col-md-12">
                  <h2 class="text-center"><b>Stock Balance after Adjustment</b><br>For <?php echo $first_word;?><br></h2>
                  <h3 class="text-center">As at <?php echo $_GET['from_date']?></h3>
                </div>
  						</div>
              <div class="row">
              <div class="col-md-12">
  						<div class="table-responsive">
                <form method="post" action="excel/stock_balance_adjust.php?first_word=<?php echo $first_word?>&date=<?php echo $date?>" >
  							
                <table  class="table table-bordered">
                  <thead style="border:1px solid #CCC">
                    <tr>
                      <th>Code</th>
                      <th>Product Name</th>
                      <th>Batch Number</th>
                      <th>Before Adjustment Quantity</th>
                      <th>Positive Adjustment Quantity</th>
                      <th>Negative Adjustment Quantity</th>
                      <th>After Adjustment Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = mysql_query("SELECT * FROM `im_adjusthd` WHERE branch='$first_word' AND DATE='$date'") or die(mysql_error());
                    while($row = mysql_fetch_array($sql)){
                      $transaction_number = $row['transaction_number'];
                      $type = $row['adjustment_type'];
                      $query = mysql_query("SELECT * FROM `im_adjustdt` WHERE transaction_number='$transaction_number'");
                      $rr = mysql_fetch_array($query);
                      $product_code = $rr['product_code'];
                      $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$product_code'");
                      $r = mysql_fetch_array($query2);
                      $positive = '';
                      $negative = '';
                      if($type=='1'){
                        $positive = $rr['quantity'];
                      }elseif($type=='-1'){
                        $negative = $rr['quantity'];
                      }else{

                      }
                      if($positive==false){
                        $positive = '0';
                      }elseif($negative==false){
                        $negative = '0';
                      }
                      print'
                      <tr>
                      <td>'.$rr['product_code'].'</td>
                      <td>'.$r['cm_name'].'</td>
                      <td>'.$rr['batch_number'].'</td>
                      <td>'.$positive.'</td>
                      <td></td>
                      <td></td>
                      <td>'.$negative.'</td>
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

?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>