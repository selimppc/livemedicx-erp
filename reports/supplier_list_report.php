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
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 4");
                $row2 = mysql_fetch_array($query2);
                $second_word = $row2['sentence'];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                if($f_word == true && $second_word==true){
                  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date,`cm_supplierid`='$second_word' AS supplier,`pp_store`='$f_word' AS pp_store FROM `pp_purchaseordhd` GROUP BY supplierid HAVING supplier >=1") or die(mysql_error());
                }elseif($f_word==true && $second_word==false){
                  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date, `pp_store`='$f_word' AS pp_store FROM `pp_purchaseordhd` GROUP BY supplierid HAVING pp_store >=1") or die(mysql_error());
                }elseif($f_word==false && $second_word==true){
                  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date,`cm_supplierid`='$second_word' AS supplier FROM `pp_purchaseordhd` GROUP BY supplierid HAVING supplier >=1") or die(mysql_error());
                }elseif($f_word == false && $second_word==false){
                  $sql = mysql_query("SELECT DISTINCT(cm_supplierid)AS supplierid,`pp_deliverydate` BETWEEN '$from_date' AND '$to_date' AS pp_date FROM `pp_purchaseordhd` GROUP BY supplierid HAVING pp_date >=1") or die(mysql_error());
                }else{}
                
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
                <div class="col-md-4">
                  <h2 class="text-center">Supplier List Report</h2><br>
                  <h4  class="text-center"><b>Date From <?php echo $from_date.' To '. $to_date?></b></h4>
                </div>
                <div class="col-md-4">
                  
                </div>
              </div>
                <form method="post" action="excel/supplier_list_report.php?pp_store=<?php echo $f_word?>&cm_supplierid=<?php echo $second_word?>&to_date=<?php echo $to_date?>&from_date=<?php echo $from_date?>" >
                <table class="table table-striped table-bordered table-hover table-highlight table-checkable" data-provide="datatable" data-info="false"data-search="false"data-display-rows="10"data-length-change="false"data-paginate="true">
                  <thead>
                    <tr>
                      <th data-filterable="true">Supplier Code</th>
                      <th data-filterable="true">Supplier Name</th>
                      <th data-filterable="true">Address</th>
                      <th data-filterable="true">City</th>
                      <th data-filterable="true">ZIP Code</th>
                      <th data-filterable="true">Country</th>
                      <th  data-filterable="true">Contact Person</th>
                      <th data-filterable="true">Cell Phone Number</th>
                      <th data-filterable="true">Email</th>
                      <th>Outstanding Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    $i = 1;
                    $no = $i;
                    while($row = mysql_fetch_array($sql)){
                      $supplier_id = $row['supplierid'];
                      $query = mysql_query("SELECT am_vouchernumber, SUM(im_netamt) AS im_netamt FROM im_grnheader WHERE cm_supplierid='$supplier_id'");
                      $rq = mysql_fetch_array($query);
                      $im_netamt = $rq['im_netamt'];
                      $am_vouchernumber = $rq['am_vouchernumber'];
                      $query2 = mysql_query("SELECT * FROM am_apalc WHERE am_invnumber='$am_vouchernumber'") or die(mysql_error());
                      $rq2 = mysql_fetch_array($query2);
                      $am_amount = $rq2['am_amount'];
                      //echo 'Amount'.$am_amount;
                      $balance = $im_netamt-$am_amount;
                      mysql_query("INSERT INTO `balance` VALUES('','$balance')") or die(mysql_error());
                      $sq = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$supplier_id'");
                      $r = mysql_fetch_array($sq);
                      print'
                      <tr>
                      <td>'.$row['supplierid'].'</td>
                      <td>'.$r['cm_orgname'].'</td>
                      <td>'.$r['cm_address'].'</td>
                      <td>'.$r['cm_district'].'</td>
                      <td>'.$r['cm_postcode'].'</td>
                      <td>'.$r['cm_post'].'</td>
                      <td>'.$r['cm_contactperson'].'</td>
                      <td>'.$r['cm_cellphone'].'</td>
                      <td>'.$r['cm_email'].'</td>
                      <td>'.$balance.'</td>
                    </tr>
                      ';
                    }
                    echo '</tbody>';
                    $tq = mysql_query("SELECT SUM(value) FROM `balance`") or die(mysql_error());
                      $tr = mysql_fetch_array($tq);
                    print'
                    <tfoot>
                    <tr>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <td style="border:0px"></td>
                      <th>Total :</th>
                      <th> '.number_format($tr['SUM(value)'],2).'</th>
                      </tr></tfoot>';
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
mysql_query("DELETE  FROM `balance`") or die(mysql_error());
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