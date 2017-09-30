<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Summary Stock Balance Report</title>

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
                $final_f_word = str_replace('+', ' ', $f_word);
                //echo $final_f_word;
                $from_date = $_GET['from_date'];
                $sql = mysql_query("SELECT * FROM `im_vw_stock` WHERE im_storeid='$final_f_word'") or die(mysql_error());
              ?>
              
  						<div class="row">
  							<div class="col-md-4">
  								
  							</div>
  							<div class="col-md-4">
  								<h2 class="text-center">Summary Stock Balance</h2>
                  <h3 class="text-center">For <?php echo $final_f_word?></h3>
                  <h5 class="text-center">On <b><?php echo $from_date?></b></h5>
  							</div>
  							<div class="col-md-4">
                  
                </div>
  						</div>
  						<div class="">
                <form method="post" action="excel/summary_stock.php?final_f_word=<?php echo $final_f_word?>&from_date=<?php echo $from_date?>" >
                <table class="table table-striped table-bordered table-hover table-highlight" data-provide="datatable" data-info="false"data-search="false"data-display-rows="15"data-length-change="false"data-paginate="true">
                  <thead>
                    <tr>
                      <th data-direction="asc" data-filterable="true">Product Code</th>
                      <th data-direction="asc" data-filterable="true">Product Name</th>
                      <th class="text-center">Quantity</th>
                      <th class="text-center">Weighted Average Cost rate (per product)</th>
                      <th class="text-center">Sales price (per product)</th>
                      <th class="text-center">Total value in stock</th>
                    </tr>
                  </thead>

  								<tbody>
                    <?php
                    error_reporting(0);
                    $i=1;
                    $no = $i;
                    while($row = mysql_fetch_array($sql)){
                      $cm_code = $row['cm_code'];
                      $query = mysql_query("SELECT * FROM `im_grndetail` WHERE cm_code='$cm_code'") or die(mysql_error());
                      $r = mysql_fetch_array($query);
                      $ro = mysql_num_rows($query);
                      if($ro==1 or $ro == 0){
                        $ro = '';
                      }else{
                        $ro = $r['cm_code'];
                      }
                      //echo $ro.'<br>'; 
                      $cquery = mysql_query("SELECT COUNT(`im_costprice`) AS total, SUM(`im_costprice`) AS total_money FROM im_grndetail WHERE `cm_code`='$ro'");
                      $rr = mysql_fetch_array($cquery);
                      $total = $rr['total'];
                      $total_money = $rr['total_money'];
                      if($total==0){
                        $total = $r['im_costprice'];
                      }else{
                        $total = $total_money/$rr['total'];
                      }
                      //$sum_total = $total_money/$total;
                      // echo $total.'<br>';
                      // echo $total_money.'<br>';
                      // echo $sum_total.'<br>';
                       $available = $row['available'];
                      if($available<0){
                        $available='0.00';
                      }
                       $total_stock = $total*$available;
                       $sales_price = $row['cm_sellrate'];
                       mysql_query("INSERT INTO `temp_stock_summaery` VALUES('','$sales_price','$total_stock')");

                      print'
                      <tr>
                      <td>'.$row['cm_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td class="text-center">'.number_format($available,2).'</td>
                      <td class="text-center">'.number_format($total,2).'</td>
                      <td class="text-center">'.number_format($row['cm_sellrate'],2).'</td>
                      <td class="text-center">'.number_format($total_stock,2).'</td>
                    </tr>
                      ';
                    }
                    echo'</tbody>';
                    $sum_sales = mysql_query("SELECT SUM(`sales_price`) AS sales FROM `temp_stock_summaery`");
                    $sr = mysql_fetch_array($sum_sales);
                    $sum_sales2 = mysql_query("SELECT SUM(`total_stock`) AS t_stok FROM `temp_stock_summaery`");
                    $sr2 = mysql_fetch_array($sum_sales2);
                    print'
                    <tfoot>
                      <tr>
                        <td colspan="4" class="text-right"><b>Total</b></td>
                        <td><b>'.number_format($sr['sales'],2).'</b></td>
                        <td><b>'.number_format($sr2['t_stok'],2).'</b></td>
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
  	</div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
mysql_query("DELETE  FROM `balance`") or die(mysql_error());
mysql_query("DELETE  FROM `temp_stock_summaery`") or die(mysql_error());
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