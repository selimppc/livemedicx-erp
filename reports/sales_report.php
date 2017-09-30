<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sales Report</title>

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
                $branch =  $arr[0];
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 2");
                $row2 = mysql_fetch_array($query2);
                $second_word = $row2['sentence'];
                $arr2 = explode('&',trim($second_word));
                $cm_type =  $arr2[0];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                //echo $cm_type.'<br>';
                //echo $branch;
                $c = '';
                $b = '';
                if($cm_type==false){
                  $c = 'All';
                }
                if($branch==false){
                  $b = 'All';
                }
              ?>
              
  						<div class="row">
                <div class="col-md-4">
                  
                </div>
  							<div class="col-md-4">
  								<h2 class="text-center">Sales Report</h2>
                  <h3 class="text-center">For <?php echo $b?></h3>
  							</div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                  <h4 class="text-left">Customer type: &nbsp;<?php echo $c?></h4>
                  <h4 class="text-left">From Date: <?php echo $from_date?> To <?php echo $to_date?></h4>
                </div>
  						</div>
                <form method="post" action="excel/sales_report.php?cm_type=<?php echo $cm_type?>&branch=<?php echo $branch?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" >
                  <!--For Excel-->
                  
  							<table class="table table-bordered table-highlight" data-provide="datatable" data-info="false" data-search="false" data-display-rows="15"data-length-change="false"data-paginate="true">
  								<thead>
  									<tr>
                      <th data-filterable="true">Code</th>
  										<th data-filterable="true">Product Name</th>
                      <th>Quantity sold</th>
  										<th>Cost rate (per product)</th>
  										<th>Sales price (per product)</th>
  										<th>Mark-up (per product)</th>
  										<th>Total mark-up</th>
  									</tr>
  								</thead>
  								<tbody>
                    <?php
                    $sql = '';
                    if($cm_type == true && $branch == true){
                      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE d.cm_group='$cm_type' AND e.cm_branch='$branch' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
                    }elseif($cm_type == true && $branch == false){
                      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE d.cm_group='$cm_type' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
                    }elseif($cm_type == false && $branch == true){
                      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE e.cm_branch='$branch' AND a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
                    }elseif($cm_type == false && $branch == false){
                      $sql = mysql_query("SELECT a.sm_number,a.sm_date,e.cm_branch,a.cm_cuscode,d.cm_name AS cusname, d.cm_address,d.cm_phone,d.cm_group,c.cm_category,c.cm_sellrate,c.cm_costprice,b.cm_code,c.cm_name AS proname, b.sm_unit,b.sm_quantity,b.sm_rate,b.sm_tax_rate,a.sm_total_tax_amt,a.sm_disc_amt,b.sm_lineamt, a.sm_currency,a.sm_exchrate,a.sm_stataus,b.sm_unit_qty FROM sm_header a INNER JOIN sm_detail b ON a.sm_number=b.sm_number INNER JOIN cm_productmaster c ON b.cm_code=c.cm_code INNER JOIN cm_customermst d ON a.cm_cuscode=d.cm_cuscode INNER JOIN cm_branchmaster e ON a.sm_storeid=e.cm_branch WHERE a.sm_date BETWEEN '$from_date' AND '$to_date' ORDER BY a.sm_number,c.cm_category");
                    }
                    while($row = mysql_fetch_array($sql)){
                      $sm_quantity = $row['sm_quantity'];
                      $cm_costprice = $row['cm_costprice'];
                      $cm_sellrate = $row['cm_sellrate'];
                      $mark = $cm_sellrate-$cm_costprice;
                      $total = $mark * $cm_costprice;
                      echo'
                      <tr>
                        <td>'.$row['cm_code'].'</td>
                        <td>'.$row['proname'].'</td>
                        <td>'.$sm_quantity.'</td>
                        <td>'.$cm_costprice.'</td>
                        <td>'.$cm_sellrate.'</td>
                        <td>'.$mark.'</td>
                        <td>'.$total.'</td>
                      </tr>
                      ';
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