<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Inventory Movement Report</title>

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
    <div>
      <div>
        <div>
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
                $arr2 = explode('&',trim($second_word));
                $second =  $arr2[0];

                $query3 = mysql_query("SELECT * FROM `temp` WHERE flag = 3");
                $row3 = mysql_fetch_array($query3);
                $third_word = $row3['sentence'];
                $arr3 = explode('&',trim($third_word));
                $third =  $arr3[0];

                $query4 = mysql_query("SELECT * FROM `temp` WHERE flag = 4");
                $row4 = mysql_fetch_array($query4);
                $four_word = $row4['sentence'];
                $arr4 = explode('&',trim($four_word));
                $four =  $arr4[0];
                //echo $f_word;//Brance
                //echo $second;//from date
                //echo $third;//to date
                //echo $four;//product code
               
              ?>
              
              <div class="row">
                <div class="col-md-3">
                  
                </div>
                <div class="col-md-6">
                  <h2 class="text-center"><b>Inventory Movement</b></h2>
                  <h4 class="text-center"><b>For <?php echo $f_word; ?> Warehouse</b></h4>
                  <h5 class="text-center"><b>From <?php echo $second; ?> To <?php echo $third; ?></b></h5>
                </div>
                <div class="col-md-2"></div>
              </div>
              <div class="table-responsive">
                <form method="post" action="excel/inventory_movement.php?f_word=<?php echo $f_word?>&second=<?php echo $second?>&third=<?php echo $third?>&four=<?php echo $four?>" >
                <table class="table table-bordered">
                  <thead style="margin:0px; padding:0px; text-align:center;">
                    <tr>
                      <th style="border: 1px solid #000; width:5px">S.N</th>
                      <th style="border: 1px solid #000; width:100px">Date</th>
                      <th style="border: 1px solid #000; width:100px">Tx.No</th>
                      <th style="border: 1px solid #000; width:100px">Tx. Type</th>
                      <th style="border: 1px solid #000; width:100px">Batch</th>
                      <th style="border: 1px solid #000; width:100px">Exp. Date</th>
                      <th style="border: 1px solid #000; width:100px">Currency Exchange Rate</th>
                      <td style="border: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="4"><b>Received</b>
                        <table style="width:100%;">
                          <tr>
                            <th style="border: 1px solid #000;">From</th>
                            <th style="border: 1px solid #000;">Qty</th>
                            <th style="border: 1px solid #000;">Rate</th>
                            <th style="border: 1px solid #000;">Value</th>
                          </tr>
                        </table>
                      </td>
                      <td style="border: 1px solid #000; margin:0px; padding:0px; text-align:center;" valign="top" colspan="4"><b>Issued/Transfer</b>
                        <table style="width:100%;">
                          <tr>
                            <th style="border: 1px solid #000;">From</th>
                            <th style="border: 1px solid #000;">Qty</th>
                            <th style="border: 1px solid #000;">Rate</th>
                            <th style="border: 1px solid #000;">Value</th>
                          </tr>
                        </table>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    $sql = '';
                    if($four==true){
                      $sql = mysql_query("SELECT cm_code,im_unit, COUNT(*) AS product FROM `im_transaction` WHERE cm_code='$four' and im_storeid='$f_word' and im_date BETWEEN '$second' and '$third'");
                    }else{
                      $sql = mysql_query("SELECT DISTINCT(`cm_code`) AS cm_code,im_unit, COUNT(`cm_code`) AS Code FROM `im_transaction` WHERE im_storeid='$f_word' and im_date BETWEEN '$second' and '$third' GROUP BY cm_code");
                    }
                    
                    while($row = mysql_fetch_array($sql)){
                      $cm_code = $row['cm_code'];
                      $p_sql = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
                      $p_row = mysql_fetch_array($p_sql);
                      $cm_group = $p_row['cm_group'];
                      $sum = mysql_query("SELECT ifnull(sum(im_quantity*im_sign),0) as opqty,im_unit from im_transaction where im_storeid='$f_word' and cm_code='$cm_code' and im_date<'$second'group by cm_code");
                      $sum_row = mysql_fetch_array($sum);
                      print'
                      <tr>
                        <td>Group:</td>
                        <td><b>'.$cm_group.'</b></td>
                        <td colspan="2"><b>'.$row['cm_code'].'</b></td>
                        <td colspan="4"><b>'.$p_row['cm_name'].'</b></td>
                        <td colspan="7"><b>Opening Quantity '.$sum_row['opqty'].'&nbsp;'.$sum_row['im_unit'].'</b></td>
                      </tr>
                      ';
                      $i = 1;
                    $no = $i;
                      $total = mysql_query("SELECT * FROM `im_transaction` WHERE cm_code='$cm_code' AND im_storeid='$f_word' AND im_date BETWEEN '$second' AND '$third'");
                      while($total_row = mysql_fetch_array($total)){
                        $im_sign = $total_row['im_sign'];
                        $im_number = $total_row['im_number'];
                        $taxtype = '';
                        if(substr($im_number, 0,4)=='PO--'){
                          $taxtype = 'GRN';
                        }elseif(substr($im_number, 0,4)=='DO--'){
                          $taxtype = 'Sell';
                        }
                        elseif(substr($im_number, 0,4)=='IT--'){
                          $taxtype = 'Issue Transfer';
                        }
                        elseif(substr($im_number, 0,4)=='RE--'){
                          $taxtype = 'Receive Transfer';
                        }
                        elseif(substr($im_number, 0,4)=='SR--'){
                          $taxtype = 'Sales Return';
                        }
                        elseif(substr($im_number, 0,4)=='BO--'){
                          $taxtype = 'Bonus Sell';
                        }
                        elseif(substr($im_number, 0,4)=='BR--'){
                          $taxtype = 'Bonus Return';
                        }
                        elseif(substr($im_number, 0,4)=='AJIS'){
                          $taxtype = '(-) Adjustment';
                        }
                        elseif(substr($im_number, 0,4)=='AJRE'){
                          $taxtype = '(+) Adjustment';
                        }
                        $im_note='';
                        $im_qty = '';
                        $im_rate = '';
                        $im_basevalue = '';
                        $im_note2='';
                        $im_qty2 = '';
                        $im_rate2 = '';
                        $im_basevalue2 = '';
                        if($im_sign==1){
                          $im_note = $total_row['im_note'];
                          $im_qty = $total_row['im_quantity'];
                          $im_rate = $total_row['im_rate'];
                          $im_basevalue = number_format($total_row['im_basevalue'],2);
                        }else{
                          $im_note2 = $total_row['im_note'];
                          $im_qty2 = $total_row['im_quantity'];
                          $im_rate2 = $total_row['im_rate'];
                          $im_basevalue2 = number_format($total_row['im_basevalue'],2);
                        }
                        if($im_qty==false){
                          $im_qty = '0.00';
                        }elseif($im_basevalue==false){
                          $im_basevalue = '0.00';
                        }elseif($im_qty2==false){
                          $im_qty2 = '0.00';
                        }elseif($im_basevalue2==false){
                          $im_basevalue2 = '0.00';
                        }elseif($im_rate==false){
                          $im_rate = '0.00';
                        }elseif($im_rate2==false){
                          $im_rate2 = '0.00';
                        }
                        print'
                      <tr>
                        <td>'.$no++.'</td>
                        <td>'.$total_row['im_date'].'</td>
                        <td>'.$total_row['im_number'].'</td>
                        <td class="text-center">'.$taxtype.'</td>
                        <td>'.$total_row['im_BatchNumber'].'</td>
                        <td>'.$total_row['im_ExpireDate'].'</td>
                        <td>'.$total_row['im_currency'].'&nbsp;'.number_format($total_row['im_ExchangeRate'],2).'</td>
                        <td>'.$im_note.'</td>
                        <td>'.$im_qty.'</td>
                        <td>'.$total_row['im_rate'].'</td>
                        <td>'.$im_basevalue.'</td>
                        <td>'.$im_note2.'</td>
                        <td>'.$im_qty2.'</td>
                        <td>'.$im_rate2.'</td>
                        <td>'.$im_basevalue2.'</td>
                      </tr>
                      ';
                      }
                      $c_sql = mysql_query("SELECT SUM(im_quantity) AS qunt FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign=1");
                      $c_row = mysql_fetch_array($c_sql);
                      $c_sql2 = mysql_query("SELECT SUM(im_quantity) AS qunt FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='-1'");
                      $c_row2 = mysql_fetch_array($c_sql2);
                      $c_sql3 = mysql_query("SELECT SUM(im_basevalue) AS value FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='1'");
                      $c_row3 = mysql_fetch_array($c_sql3);
                      $c_sql4 = mysql_query("SELECT SUM(im_basevalue) AS value FROM im_transaction WHERE im_storeid='$f_word' AND im_date between '$second' AND '$third' AND cm_code='$cm_code' AND im_sign='-1'");
                      $c_row4 = mysql_fetch_array($c_sql4);
                      $qun = $c_row['qunt'];
                      $qunt = number_format($c_row['qunt'],2);
                      $qunt2 = number_format($c_row2['qunt'],2);
                      $qun2 = $c_row2['qunt'];
                      $value = number_format($c_row3['value'],2);
                      $value2 = number_format($c_row4['value'],2);
                    $close = $sum_row['opqty'] + $qun;
                    $t_close = $close-$qun2;
                    if($qunt==false){
                      $qunt = '0.00';
                    }elseif($qun2==false){
                      $qun2 = '0.00';
                    }
                    elseif($value==false){
                      $value = '0.00';
                    }elseif($value2==false){
                      $value2 = '0.00';
                    }
                      print'
                      <tr>
                        <td colspan="3"></td>
                        <td colspan="4" class="text-right"><b>Closing Quantity: '.$t_close.'&nbsp;'.$row['im_unit'].'</b></td>
                        <td></td>
                        <td><b>'.$qunt.'</b></td>
                        <td></td>
                        <td><b>'.$value.'</b></td>
                        <td></td>
                        <td><b>'.$qunt2.'</b></td>
                        <td></td>
                        <td><b>'.$value2.'</b></td>
                      </tr>
                      ';
                    }
                    ?>
                  </tbody>
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
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
