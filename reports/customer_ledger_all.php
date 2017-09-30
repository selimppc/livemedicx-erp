<?php include('connection/dB.php');
  error_reporting(0);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Date Wise Customer Ledger</title>

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
           $tc='';
  $rble='';
  $diff='';
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
                $query2 = mysql_query("SELECT * FROM `temp` WHERE flag = 2");
                $row2 = mysql_fetch_array($query2);
                $second_value =  $row2['sentence'];
                $arr2 = explode('&',trim($second_value));
                $word_two =  $arr2[0];
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
               $smamnt='';
        
        
        $cm=mysql_query("SELECT COUNT(*) FROM cm_customermst");
        $cma=mysql_fetch_array($cm);
        $call=$cma[0];
       
              
                
              ?>
              
              <div class="row">
                <div class="col-md-12">
                  <h2 class="text-left">
                    <b>Date Wise Customer Ledger</b><br>
                      <!--<h3 style="border-bottom:1px solid #CCC">Form <?php echo $from_date?> To <?php echo $to_date?></h3>
            <h4> This view will be modify</h4>-->
                    
                  </h2>
                </div>
         <div class="col-md-6">
                  <h4 class="text-left">From Date: <?php echo $from_date?> To <?php echo $to_date?></h4>
           <h4 class="text-left">
           Customers: &nbsp;<?php echo $call; ?>
           </h4>
                </div>
              </div>
              <div class="row">
                <form method="post" action="excel/customer_ledger.php?word_one=<?php echo $word_one?>&from_date=<?php echo $from_date?>&to_date=<?php echo $to_date?>" >
                         
                

                    
                <table class="table table-bordered table-highlight" data-info="false" data-search="false" data-display-rows="15"data-length-change="false"data-paginate="true">
                <?php
               
    
     /*$sql=mysql_query("SELECT cm_customermst.cm_cuscode,sm_header.sm_doc_type,sm_header.sm_payterms,sm_header.sm_totalamt,sm_header.sm_netamt,sm_invalc.sm_amount, sm_invalc.sm_invnumber FROM ((sm_header INNER JOIN cm_customermst ON sm_header.cm_cuscode=cm_customermst.cm_cuscode) INNER JOIN sm_invalc ON sm_header.sm_number=sm_invalc.sm_number) WHERE sm_header.sm_date <='$to_date'");*/
    $sql=mysql_query("SELECT * FROM sm_header WHERE sm_stataus !='Open' AND sm_stataus !='Cancel' AND sm_date BETWEEN '$from_date' AND '$to_date'");

      
     

                ?>
                    <thead>
                <tr style="background-color: #82b1ff">
                <th colspan="5"></th>
                <th> Total Receivable</th>
                <th>Total Received</th>
                <th>Net Balance</th>
                <th>Outstanding Balance</th>
                </tr>
                <tbody>
                  <td colspan="5"></td>
                  <?php
                   $sqltamt=mysql_query("SELECT SUM(sm_totalamt)as Total FROM sm_header WHERE sm_sign='-1'");
         $r=mysql_fetch_array($sqltamt);
         $total=$r['Total'];
         $sqln=mysql_query("SELECT SUM(sm_netamt)as Totalnet FROM sm_header WHERE sm_sign='-1'");
         $rn=mysql_fetch_array($sqln);
         $sqlal=mysql_query("SELECT SUM(sm_totalamt)as Totalall FROM sm_header WHERE sm_sign='-1'");
          $ra=mysql_fetch_array($sqlal);
          $sqlnet=mysql_query("SELECT SUM(sm_netamt)as Totalamt FROM sm_header WHERE sm_sign='-1'");
         $ran=mysql_fetch_array($sqlnet);
         $sqlamt=mysql_query("SELECT SUM(sm_netamt)as Totalamt FROM sm_header INNER JOIN sm_invalc WHERE sm_header.sm_number=sm_invalc.sm_invnumber");
         $sqlamt1=mysql_fetch_array($sqlamt);
                  ?>
                  <td> <?php echo '<b>'.$rn['Totalnet'].'&nbsp'.'</b>'?></td>
                  <td><?php echo  '<b>'.$sqlamt1['Totalamt'].'&nbsp'.'</b>'?> </td>
                  <td><?php echo  '<b>'.$r['Total'].'&nbsp'.'</b>'?></td>
                  <td><?php echo  '<b>'.$r['Total'].'&nbsp'.'</b>'?></td>
                </tbody>
                <tbody>
                  <td colspan="8"></td>
                   <td colspan="9"></td>
                </tbody>
                
                </thead>
                
                <thead>
                    <tr>
                          <th>Customer ID</th>
                      <th >Document Number</th>
                    <th>Description</th>
                      <th>Cash or Credit</th>
                      <th>Curr. Exch. Rate</th>
                      <th>Receivable</th>
                      <th>Received</th>
                    <th>Net Balance</th>
                    <th>Allocated Invoice</th>
                    </tr>
                  </thead>
                <tbody>
                
                </tbody>
                <?php
   
      
     //$sqlres=$conn->query($sql);
    
     
//$sql = mysql_query("SELECT * FROM `cm_customermst`,sm_header WHERE cm_customermst.cm_cuscode='$word_one' AND cm_customermst.c_status='Open' AND sm_header.cm_cuscode='$word_one'");
       /* $sql=mysql_query("SELECT cm_customermst.cm_cuscode,sm_header.sm_doc_type,sm_header.sm_payterms,sm_header.sm_totalamt,sm_header.sm_netamt,sm_invalc.sm_amount, sm_invalc.sm_invnumber FROM ((sm_header INNER JOIN cm_customermst ON sm_header.cm_cuscode=cm_customermst.cm_cuscode) INNER JOIN sm_invalc ON sm_header.sm_number=sm_invalc.sm_number) WHERE sm_header.sm_date <='$to_date'");*/
       $sql=mysql_query("SELECT * FROM sm_header WHERE sm_stataus !='Open' AND sm_stataus !='Cancel' AND sm_date BETWEEN '$from_date' AND '$to_date'");
       $sql1=mysql_query("SELECT sm_header.cm_cuscode,sm_header.sm_payterms,sm_header.sm_doc_type,sm_invalc.sm_number,sm_invalc.sm_invnumber,sm_header.sm_number,sm_invalc.sm_amount FROM sm_invalc INNER JOIN sm_header ON sm_invalc.sm_invnumber=sm_header.sm_refe_code ");
       
      
     while($res=mysql_fetch_assoc($sql))
     {
      //print_r($res['sm_amount']);
      $row=mysql_fetch_assoc($sql1);

      
      
                   $sm_number = substr($res['sm_number'],0,4);
                  if($sm_number=='IN--'){
                    $sm_number = 'Invoiced';
                  }elseif($sm_number=='MR--'){
                    $sm_number = 'Money Receipt';
                  }
                  else{
                      $sm_number='Direct Sale';
                  }
                
      

  
 
     if($sm_totalamt==null)
     {
      $sm_totalamt='0.00';
     }
    
         echo'
         <tbody>
       
           <tr>
            <th>'.$res['cm_cuscode'].'</th>
            <td>'.$sm_number.'</td>
          <td>'.$res['sm_doc_type'].'</td>
          <td>'.$res['sm_payterms'].'</td>
          <td>'. 'CDF'.'&nbsp;'.'1.00000'.'</td>
          <td>'.$res['sm_totalamt'].'</td>
          <td>'.$row['sm_amount'].'</td>
          <td>'.$res['sm_netamt'].'</td>
          <td>'.$row['sm_invnumber'].'</td>
         
         
         </tr>
        </tbody>
       ';

    
         
       
       
      
       //$test=$res['cm_cuscode'];
       
       //
       //$ro=mysql_fetch_array($sql);
       
     }
          
     
     ?>   

     <!--<thead>
                <tr >
                <th colspan="5"></th>
                <th> Total Receivable</th>
                <th>Total Received</th>
                <th>Net Balance</th>
                <th>Outstanding Balance</th>
                </tr>
                <tbody>
                  <td colspan="5"></td>
                  <td> <?php echo ''.'&nbsp'.$rble?></td>
                  <td><?php echo  ''.'&nbsp'.$tc?> </td>
                  <td><?php echo  ''.'&nbsp'.$diff?></td>
                  <td><?php echo  ''.'&nbsp'.$diff?></td>
                </tbody>
                
                </thead>-->
                  <tbody>
                    <?php
                  
                    ?>
                  </tbody>
                
                
                </table>
              <!-- testing-->
                <?php
                
                
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