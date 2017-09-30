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
                $first_word = str_replace('+', ' ', $f_word);
                //echo $f_word;
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];

              ?>
              
  						<div class="row">
                <div class="col-md-12">
                  <h2 class="text-center" style="border-bottom:1px solid #CCC"><b>Item Ledger</b></h2>
                </div>
  						</div>
              <div class="row">
              <div class="col-md-12">
              <div class="col-md-4" style="border-bottom:1px solid #CCC">
                <h3>Branch: <?php echo $first_word;?></h3>
                <h3>From Date: <?php echo $_GET['from_date']?></h3>
                <h3>To Date : <?php echo $_GET['to_date']?></h3>
              </div>
              <div class="col-md-12"><br>
                <form method="post" action="excel/item_ledger.php?first_word=<?php echo $first_word?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" >
  							
                <table class="table table-striped table-bordered table-highlight" data-provide="datatable" data-info="false"data-search="false"data-display-rows="15"data-length-change="false"data-paginate="true">
                  <thead>
                    <tr>
                      <th data-filterable="true">Item Code</th>
                      <th data-filterable="true">Product Name</th>
                      <th>Opening Balance Qty</th>
                      <th>Receive Qty</th>
                      <th>Issue Qty</th>
                      <th>Closing Balance Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    $sql = mysql_query("SELECT * FROM `im_transaction` WHERE im_storeid='$first_word' ");
                    while($row = mysql_fetch_array($sql)){
                      $cm_code = $row['cm_code'];
                      $qu = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
                      $r = mysql_fetch_array($qu);
                      $opensql = mysql_query("SELECT SUM(`im_quantity`)AS openplus FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` <= '$from_date' AND `im_sign`='1'");
                      $openrow = mysql_fetch_array($opensql);
                      $openplus = $openrow['openplus'];

                      $opensql2 = mysql_query("SELECT SUM(`im_quantity`)AS openminus FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` <= '$from_date' AND `im_sign`='-1'");
                      $openrow2 = mysql_fetch_array($opensql2);
                      $openminus = $openrow2['openminus'];
                      $openqun = $openplus-$openminus;

                      $receivesql = mysql_query("SELECT SUM(`im_quantity`)AS RQ FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` BETWEEN '$from_date' AND '$to_date' AND `im_sign`='1'");
                      $receiverow = mysql_fetch_array($receivesql);
                      $RQ = $receiverow['RQ'];
                      if($RQ == false){
                        $RQ='00';
                      }
                      $issuesql = mysql_query("SELECT SUM(`im_quantity`)AS IQ FROM `im_transaction` WHERE `cm_code`='$cm_code' AND `im_date` BETWEEN '$from_date' AND '$to_date' AND `im_sign`='-1'");
                      $issuerow = mysql_fetch_array($issuesql);
                      $IQ = $issuerow['IQ'];
                      if($IQ == false){
                        $IQ='00';
                      }
                      $close = $openqun+$RQ-$IQ;
                      if($openqun=='0' && $RQ=='00' && $IQ =='00' &&$close == '0'){

                      }else{
                      print'
                      <tr>
                        <td>'.$cm_code.'</td>
                        <td>'.$r['cm_name'].'</td>
                        <td>'.$openqun.'</td>
                        <td>'.$RQ.'</td>
                        <td>'.$IQ.'</td>
                        <td>'.$close.'</td>
                      </tr> 
                      ';}
                    }

                    ?>
                                        
                  </tbody>
                </table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button>
             </form>
  						
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());

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