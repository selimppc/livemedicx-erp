<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Product List Report</title>

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
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 2");
                $row2 = mysql_fetch_array($query2);
                $second_word = $row2['sentence'];
                //echo $f_word;
                //echo $second_word;
                
              ?>
              
  						<div class="row">
                <div class="col-md-4">
                  <?php
                  // $equery = mysql_query("SELECT * FROM `companyprofile`");
                  // while($ro = mysql_fetch_array($equery)){
                  //   print'
                  //   <img class="logo" src="../images/companyprofile/'.$ro['photo'].'">
                  //   ';
                  // }
                  ?>
                </div>
  							<div class="col-md-6">
  								<h2 class="text-center">Product & Service List Report</h2><br>
                  <h4 class="text-center">PRODUCT</h4>

  							</div>
                <div class="col-md-2"></div>
  						</div>
                <form method="post" action="excel/product_list_excel.php?f_word=<?php echo $f_word?>&second_word=<?php echo $second_word?>" >
                  <!--For Excel-->
                  
  							<table class="table table-bordered table-highlight" data-provide="datatable" data-info="false" data-search="false" data-display-rows="15"data-length-change="false"data-paginate="true">
  								<thead>
  									<tr>
                      <th data-filterable="true">Code</th>
  										<th data-filterable="true">Product Name</th>
  										<th>Sell Price</th>
  										<th>Cost Price</th>
  										<th>Sell Unit</th>
  										<th>Sell Unit Qty</th>
  										<th>Pur. Unit</th>
  										<th>Pur. Unit Qty</th>
  										<th>Currency</th>
  									</tr>
  								</thead>
  								<tbody>
                    <?php
                    if($second_word==false && $f_word==false){
                      $sql1 = mysql_query("SELECT DISTINCT(`cm_category`) as Category, count(`cm_category`) AS Count FROM cm_productmaster GROUP BY cm_category HAVING Count > 1") or die(mysql_error());
                      while($r = mysql_fetch_array($sql1)){
                        $p_cat = $r['Category'];
                          print'
                                <tr>
                                  <th style="border:0px;">Category:</th>
                                  <th style="border:0px;">'.$p_cat.'</th>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                </tr>
                                ';
                              $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$p_cat'")or die(mysql_error());
                              while($row = mysql_fetch_array($sql)){
                                    print'
                          <tr>
                          <td>'.$row['cm_code'].'</td>
                          <td>'.$row['cm_name'].'</td>
                          <td>'.$row['cm_sellrate'].'</td>
                          <td>'.$row['cm_costprice'].'</td>
                          <td>'.$row['cm_sellunit'].'</td>
                          <td>'.$row['cm_sellconfact'].'</td>
                          <td>'.$row['cm_purunit'].'</td>
                          <td>'.$row['cm_purconfact'].'</td>
                          <td>'.$row['currency'].'</td>
                        </tr>
                          ';
                              }
                            }  
                      }elseif($second_word==true && $f_word==true){
                        print'
                                <tr>
                                  <th style="border:0px;">Category:</th>
                                  <th style="border:0px;">'.$second_word.'</th>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                </tr>
                                ';
                        $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$second_word' AND cm_class='$f_word'") or die(mysql_error());
                        while($row = mysql_fetch_array($sql)){
                          print'
                          <tr>
                          <td>'.$row['cm_code'].'</td>
                          <td>'.$row['cm_name'].'</td>
                          <td>'.$row['cm_sellrate'].'</td>
                          <td>'.$row['cm_costprice'].'</td>
                          <td>'.$row['cm_sellunit'].'</td>
                          <td>'.$row['cm_sellconfact'].'</td>
                          <td>'.$row['cm_purunit'].'</td>
                          <td>'.$row['cm_purconfact'].'</td>
                          <td>'.$row['currency'].'</td>
                        </tr>
                          ';
                        }
                      }elseif($second_word==true && $f_word==false){
                        print'
                                <tr>
                                  <th style="border:0px;">Category:</th>
                                  <th style="border:0px;">'.$second_word.'</th>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                </tr>
                                ';
                        $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$second_word'") or die(mysql_error());
                        while($row = mysql_fetch_array($sql)){
                          print'
                          <tr>
                          <td>'.$row['cm_code'].'</td>
                          <td>'.$row['cm_name'].'</td>
                          <td>'.$row['cm_sellrate'].'</td>
                          <td>'.$row['cm_costprice'].'</td>
                          <td>'.$row['cm_sellunit'].'</td>
                          <td>'.$row['cm_sellconfact'].'</td>
                          <td>'.$row['cm_purunit'].'</td>
                          <td>'.$row['cm_purconfact'].'</td>
                          <td>'.$row['currency'].'</td>
                        </tr>
                          ';
                        }
                      }elseif($second_word==false && $f_word==true){
                        $sql1 = mysql_query("SELECT DISTINCT(`cm_category`) as Category, count(`cm_category`) AS Count FROM cm_productmaster GROUP BY cm_category HAVING Count > 1") or die(mysql_error());
                        while($r = mysql_fetch_array($sql1)){
                          $p_cat = $r['Category'];
                           print'
                                <tr>
                                  <th style="border:0px;">Category:</th>
                                  <th style="border:0px;">'.$p_cat.'</th>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                  <td style="border:0px;"></td>
                                </tr>
                                ';
                          $sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_category='$p_cat' AND cm_class='$f_word'") or die(mysql_error());
                          while($row = mysql_fetch_array($sql)){
                            print'
                          <tr>
                          <td>'.$row['cm_code'].'</td>
                          <td>'.$row['cm_name'].'</td>
                          <td>'.$row['cm_sellrate'].'</td>
                          <td>'.$row['cm_costprice'].'</td>
                          <td>'.$row['cm_sellunit'].'</td>
                          <td>'.$row['cm_sellconfact'].'</td>
                          <td>'.$row['cm_purunit'].'</td>
                          <td>'.$row['cm_purconfact'].'</td>
                          <td>'.$row['currency'].'</td>
                        </tr>
                          ';
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