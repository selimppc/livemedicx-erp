<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Branch List Report</title>


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
  					<div class="portlet-content"><div id="DivIdToPrint">
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
                // $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 4");
                // $row2 = mysql_fetch_array($query2);
                // $second_word = $row2['sentence'];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                if($f_word == true){
                  $sql = mysql_query("SELECT * FROM `cm_branchmaster` WHERE cm_branch='$f_word'") or die(mysql_error());
                }elseif($f_word == false){
                  $sql = mysql_query("SELECT * FROM `cm_branchmaster`") or die(mysql_error());
                }else{}
                $ru = mysql_num_rows($sql);
              ?>
              
  						<div class="row">
                <form action="excel/branch_list_report.php?f_word=<?php echo $f_word?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" method="post">
  							<div class="row">
                <div class="col-md-4">
                  <?php
                  $equery = mysql_query("SELECT * FROM `companyprofile`");
                  while($ro = mysql_fetch_array($equery)){
                    print'
                    <img class="logo" src="../images/companyprofile/'.$ro['photo'].'">
                    ';
                  }
                  ?>
                </div>
  							<div class="col-md-4">
                  <h2 class="text-center">Branch List Report<br>
                    <h4 class="text-center"><b>From <?php echo $from_date.' To '. $to_date?></b></h4></h2>
                </div>
  						</div>
              <div class="col-md-12">
  							<table class="table table-striped table-bordered table-hover table-highlight">
  								<thead>
  									<tr>
  										<th>Branch</th>
  										<th>Branch Description</th>
  										<th>Contact Person</th>
  										<th>Email</th>
  										<th>Cell Phone</th>
  										<th>Phone</th>
  									</tr>
  								</thead>
  								<tbody>
                    <?php
                    
                    $i = 1;
                    $no = $i;
                    while($row = mysql_fetch_array($sql)){
                      print'
                      <tr>
                      <td>'.$row['cm_branch'].'</td>
                      <td>'.$row['cm_description'].'</td>
                      <td>'.$row['cm_contacperson'].'</td>
                      <td>'.$row['cm_mailingaddress'].'</td>
                      <td>'.$row['cm_cell'].'</td>
                      <td>'.$row['cm_phone'].'</td>
                    </tr>
                      ';
                    }
                    
                    ?>
  								</tbody>
  							</table>
                </div>
              <div class="col-md-12">
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
              </form>
  					</div></div>
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