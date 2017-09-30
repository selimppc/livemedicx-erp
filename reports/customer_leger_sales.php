<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Date Wise Customer Ledger</title>

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
                $row = mysql_fetch_array($query);
                $first_value =  $row['sentence'];
                $arr = explode('&',trim($first_value));
                $word_one =  $arr[0];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                //echo $word_one.'<br>';
                //echo $from_date.'<br>';
                //echo $to_date.'<br>';
                
              ?>
              
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-left">
                    <b>Date Wise Customer Ledger</b><br>
                      <h3 style="border-bottom:1px solid #CCC">Form <?php echo $from_date?> To <?php echo $to_date?></h3>
                    
                  </h2>
                </div>
              </div>
              <div class="row">
                <form method="post" action="excel/customer_ledger.php?word_one=<?php echo $word_one?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" >
                <?php

                $sql = '';
                if($word_one==true){
                  $sql = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$word_one'");
                }else{
                  $sql = mysql_query("SELECT * FROM `cm_customermst`");
                }
                while($row = mysql_fetch_array($sql)){
                  $cm_cuscode = $row['cm_cuscode'];
                  $cm_name = $row['cm_name'];
                  $query = mysql_query("SELECT SUM(a.sm_netamt*a.sm_sign) AS openingbl FROM sm_header a WHERE a.sm_stataus<>'Cancel' AND a.cm_cuscode='$cm_cuscode' AND a.sm_date<'$from_date' GROUP BY a.cm_cuscode");
                  $query_row = mysql_fetch_array($query);
                  $openingbl = $query_row['openingbl'];
                  print'
                  <div class="col-md-12">
                <h4><b>'.$row['cm_cuscode'].'</b></h4>
                <h4><b>'.$row['cm_name'].'</b></h4>
                <div class="table-responsive">
                 
                    <table  class="table table-bordered">
                      <thead style="border: 1px solid #000;">
                        <tr>
                          <th style="border: 1px solid #000;">Document Number</th>
                          <th style="border: 1px solid #000;">Description</th>
                          <th style="border: 1px solid #000;">Date</th>
                          <th style="border: 1px solid #000;">Currency & Exch. Rate</th>
                          <th style="border: 1px solid #000;">Receivable</th>
                          <th style="border: 1px solid #000;">Received</th>
                          <th style="border: 1px solid #000;">Net Balance</th>
                        </tr>
                      </thead>
                      <tbody>';
                        
                          print'
                          <tr>
                        <td colspan="4" class="text-right"><b>Opening Balance:</b></td>
                        <td>'.$openingbl.' </td>
                        <td colspan="2"></td>
                      </tr>
                          ';
                          $con = mysql_query("SELECT * FROM sm_header WHERE cm_cuscode='$cm_cuscode' AND sm_date BETWEEN '$from_date' AND '$to_date' AND sm_stataus<>'Cancel'");
                          $r = mysql_fetch_array($con);
                          $sm_number = substr($r['sm_number'],0,4);
                          if($sm_number=='IN--'){
                            $sm_number = 'Invoiced';
                          }elseif($sm_number=='MR--'){
                            $sm_number = 'Money Receipt';
                          }
                          $sm_sign = $r['sm_sign'];
                          $receive = '';
                          if($sm_sign=='-1'){
                            $receive = $r['sm_totalamt'];
                          }else{
                            $receive = '0.00';
                          }
                          $sm = $r['sm_number'];
                          $sm_netamt1 = $r['sm_netamt'];
                          if($sm==false && $receive=='0.00'){

                          }else{
                            //mysql_query("INSERT INTO `customer_total` VALUES ('','$sm_netamt1')") or die(mysql_error());
                          print'<tr>
                                  <td>'.$r['sm_number'].'</td>
                                  <td>'.$sm_number.'</td>
                                  <td>'.$r['sm_date'].'</td>
                                  <td>'.$r['sm_currency'].'&nbsp; '.$r['sm_exchrate'].'</td>
                                  <td>'.$r['sm_totalamt'].'</td>
                                  <td>'.$receive.'</td>
                                  <td>'.$sm_netamt1.'</td>
                                </tr>';
                          }
                   while($rr = mysql_fetch_array($con)){
                    $sm_number = substr($rr['sm_number'],0,4);
                    
                    $sm_netamt = $rr['sm_netamt'];
                    $total = $sm_netamt1 + $sm_netamt;
                    mysql_query("INSERT INTO `customer_total` VALUES ('','$sm_netamt1')") or die(mysql_error());
                    $tsql = mysql_query("SELECT * FROM customer_total");
                    $trow = mysql_fetch_array($tsql);
                    $tnet = $trow['net_total'];                
                    
                    $total_net = '';

                    if($sm_number=='IN--'){
                      $sm_number = 'Invoiced';
                      $total_net = $tnet + $sm_netamt;
                    }elseif($sm_number=='MR--'){
                      $sm_number = 'Money Receipt';
                      $total_net = $tnet - $sm_netamt;
                    }
                    $sm_sign = $rr['sm_sign'];
                    $receive = '';
                    if($sm_sign=='-1'){
                      $receive = $rr['sm_totalamt'];
                    }else{
                      $receive = '0.00';
                    }
                  print'<tr>
                        <td>'.$rr['sm_number'].'</td>
                        <td>'.$sm_number.'</td>
                        <td>'.$rr['sm_date'].'</td>
                        <td>'.$rr['sm_currency'].'&nbsp; '.$rr['sm_exchrate'].'</td>
                        <td>'.$rr['sm_totalamt'].'</td>
                        <td>'.$receive.'</td>
                        <td>'.$total_net.'</td>
                      </tr>';
                      mysql_query("UPDATE `customer_total` SET net_total='$total_net'") or die(mysql_error());
                    }
                    $csql = mysql_query("SELECT * FROM customer_total");
                    $crow = mysql_fetch_array($csql);
                    $ctotal = $crow['net_total']; 
                    $cnet = ''; 
                    if($ctotal==false){
                      $cnet = $sm_netamt1;
                    }elseif($sm_netamt1==false){
                      $cnet = $openingbl;
                    }elseif($ctotal==true){
                      $cnet = $ctotal;
                    }
                print'<tr>
                        <td colspan="4" class="text-right"><b>Closing Balance:</b></td>
                        <td colspan="3">'.$cnet.'</td>
                      </tr>
                      </tbody>
                    </table>
                 
                </div>
              </div><!--col-md-12-->
                  ';
                }
                ?>
              <div class="col-md-12">
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
              </form>
              </div>
              </div><!--row-->
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
mysql_query("DELETE  FROM `temp`") or die(mysql_error());
mysql_query("DELETE  FROM `customer_total`") or die(mysql_error());
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>