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
                //echo $f_word;
                
              ?>
              
  						<div class="row">
                <div class="col-md-12">
                  <h2 class="text-left"><b>Chart of Account List</b></h2>
                </div>
  						</div>
              <div class="row">
              <div class="col-md-12">
               <form method="post" action="excel/chart_of_account.php?f_word=<?php echo $f_word?>" >
  							
                <table class="table table-bordered  table-highlight" data-provide="datatable" data-info="false"data-search="false"data-display-rows="15"data-length-change="false"data-paginate="true">
                  <thead>
                    <tr>
                      <th data-filterable="true">Code</th>
                      <th data-filterable="true">Description</th>
                      <th data-filterable="true">Usage</th>
                      <th data-filterable="true">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = '';
                    if($f_word==true){
                      $sql = mysql_query("SELECT * FROM  am_chartofaccounts, am_group_one, am_group_two WHERE (am_chartofaccounts.am_groupone=am_group_one.am_groupone) AND (am_chartofaccounts.am_grouptwo=am_group_two.am_grouptwo)AND am_chartofaccounts.am_accounttype='$f_word'") or die(mysql_error());
                      $head = mysql_fetch_array($sql);
                    $head_name = $head['am_accounttype'];
                    $am_groupone = $head['am_groupone'];
                    //echo $am_groupone;
                    print'
                    <tr>
                      <th style="border:0px">'.$head_name.'</th>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                    </tr>
                    '; 
                    $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                    while($row = mysql_fetch_array($subsql)){
                      $am_grouptwo = $row['am_grouptwo'];
                      $consql = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
                      print'
                      <tr>
                        <th style="border:0px">'.$row['am_grouptwo'].'-'.$row['am_description'].'</th>
                        <td style="border:0px"></td>
                        <td style="border:0px"></td>
                        <td style="border:0px"></td>
                      </tr>
                      ';
                      while($con_row = mysql_fetch_array($consql)){

                      print'
                      <tr>
                        <td>'.$con_row['am_accountcode'].'</td>
                        <td>'.$con_row['am_description'].'</td>
                        <td>'.$con_row['am_accountusage'].'</td>
                        <td>'.$con_row['am_status'].'</td>
                      </tr>
                      ';
                      }
                    }
                    }else{
                      $sql = mysql_query("SELECT * FROM am_group_one")or die(mysql_error());
                      while($head = mysql_fetch_array($sql)){


                    $head_name = $head['am_description'];
                    $am_groupone = $head['am_groupone'];
                    //echo $am_groupone;
                    print'
                    <tr>
                      <th style="border:0px">'.$head_name.'</th>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                    </tr>
                    
                    '; 
                    
                     $subsql = mysql_query("SELECT * FROM `am_group_two` WHERE am_groupone='$am_groupone'");
                     while($row = mysql_fetch_array($subsql)){
                       $am_grouptwo = $row['am_grouptwo'];
                      $consql = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_grouptwo='$am_grouptwo'");
                       print'
                      <tr>
                        <th style="border:0px">'.$row['am_grouptwo'].'-'.$row['am_description'].'</th>
                        <td style="border:0px"></td>
                        <td style="border:0px"></td>
                        <td style="border:0px"></td>
                       </tr>
                      ';

                      while($con_row = mysql_fetch_array($consql)){

                      print'
                      <tr>
                        <td>'.$con_row['am_accountcode'].'</td>
                        <td>'.$con_row['am_description'].'</td>
                        <td>'.$con_row['am_accountusage'].'</td>
                        <td>'.$con_row['am_status'].'</td>
                      </tr>
                      ';
                      }
                    }}
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