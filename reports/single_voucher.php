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
                $pVoucherNo = $_GET['pVoucherNo'];
                //$sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE `am_vouchernumber`='$pVoucherNo'") or die(mysql_error());
				$sql=mysql_query("SELECT * FROM `sm_header` INNER JOIN am_vouhcerheader on sm_header.glvoucher=am_vouhcerheader.am_vouchernumber WHERE am_vouhcerheader.am_vouchernumber='$pVoucherNo'");
    $sql1 = mysql_query("SELECT * FROM `sm_header` INNER JOIN cm_customermst on sm_header.cm_cuscode=cm_customermst.cm_cuscode WHERE sm_header.glvoucher='$pVoucherNo'") or die(mysql_error());
                $ro = mysql_fetch_array($sql);
                $rol1 = mysql_fetch_array($sql1);
				$inv=$rol1['gerant_id'];
				//print_r($rol1['gerant_id']);

              ?>
              
              <div class="row">
                <!--<div class="col-md-4">
                  
                  <?php
                  // $equery = mysql_query("SELECT * FROM `companyprofile`");
                  // while($ro = mysql_fetch_array($equery)){
                  //   print'
                  //   <img class="logo" src="../images/companyprofile/'.$ro['photo'].'">
                  //   ';
                  // }
                  ?>
                </div>-->
                <div class="col-md-6">
                  <h2 style="border-bottom:1px solid #CCC"><b>Accounts Receivable Voucher</b></h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-borderless2">
                      <tr>
                        <th>Voucher Number</th>
                        <td><?php echo $ro['am_vouchernumber']?></td>
                        <th>Year</th>
                        <td><?php echo $ro['am_year']?></td>
                        <td>&nbsp;</td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <th>Date</th>
                        <td><?php echo $ro['am_date']?></td>
                        <th>Period</th>
                        <td><?php echo $ro['am_period']?></td>
                        <td>&nbsp;</td>
                        <th>Gerant_id:</th>
                
						<td><?php echo $inv?></td>
						
                      </tr>
                      <tr>
                        <th>Branch</th>
                        <td><?php echo $ro['am_branch']?></td>
                        <th>Note</th>
                        <td><?php echo $ro['am_note']?></td>
                        <td>&nbsp;</td>
                        <th>Status</th>
                        <td><?php echo $ro['am_status']?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <form method="post" action="excel/ar_voucher.php?pVoucherNo=<?php echo $pVoucherNo?>">
                
                <table  class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Accounts Description</th>
                      <th>Currency</th>
                      <th>Ex. Rate</th>
                      <th>Debit</th>                      
                      <th>Credit</th>
                      <th>Debit Local</th>
                      <th>Credit Local</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  error_reporting(0);
                  
                  $sq = mysql_query("SELECT * FROM `am_balance` WHERE c_vouchernumber='$pVoucherNo'");
                  while($row= mysql_fetch_array($sq)){
                    $id = $row['id'];
                    $c_subacc = $row['c_subacc'];
                    //echo $id;
                    //echo $c_subacc;
                    $c_accountcode = $row['c_accountcode'];
                    $acc_des_q = mysql_query("SELECT * FROM `am_chartofaccounts` WHERE am_accountcode='$c_accountcode'");
                    $acc_des_row = mysql_fetch_array($acc_des_q); 
                    $sq2 = mysql_query("SELECT * FROM `am_balance` WHERE c_vouchernumber='$pVoucherNo' AND c_subacc='$c_subacc'");
                    $row2= mysql_fetch_array($sq2);
                    $dabet = $row2['c_primeamt'];
                    if($dabet < 0){
                      $dabet = '';
                    }
                    $sq3 = mysql_query("SELECT * FROM `am_balance` WHERE id='$id'");
                    $row3= mysql_fetch_array($sq3);
                    $credit = $row3['c_primeamt'];
                    //echo $credit;
                    if($credit > 0){
                      $credit = '';
                    }else{
                      $credit = abs($credit);
                    }
                    $t_credit = number_format($credit,2);
                    mysql_query("INSERT INTO `temp` VALUES('','$dabet','$credit')") or die(mysql_error());
                    $ex_rate = $row['c_exchagerate'];
                    $l_dabet = $ex_rate*$dabet;
                    $l_credit = $ex_rate*$credit;
                    $t_l_dabet = $l_dabet;
                    $t_l_credit = number_format($l_credit,2);
                    mysql_query("INSERT INTO `tab_ldc2` VALUES('','$l_dabet','$l_credit')")or die(mysql_error());
                    if($t_l_dabet==0){
                      $t_l_dabet='';
                    }
                    if($t_l_credit==0){
                      $t_l_credit='';
                    }
                    print'
                    <tr>
                      <td>'.$row['c_accountcode'].'</td>
                      <td>'.$acc_des_row['am_description'].'</td>
                      <td>'.$row['c_currency'].'</td>
                      <td>'.$row['c_exchagerate'].'</td>
                      <td>'.$dabet.'</td>
                      <td>'.$t_credit.'</td>
                      <td>'.$t_l_dabet.'</td>
                      <td>'.$t_l_credit.'</td>
                    </tr>
                    ';
                  }
                  $tcredit2 = mysql_query("SELECT SUM(`sentence`) AS total_dabet FROM `temp`");
                  $tcredit_row2 = mysql_fetch_array($tcredit2);
                  $tcredit = mysql_query("SELECT SUM(`flag`) AS total_credit FROM `temp`");
                  $tcredit_row = mysql_fetch_array($tcredit);
                  $total_c = $tcredit_row['total_credit'];
                  $f_total_c = number_format($total_c,2);
                  $tdabet = mysql_query("SELECT SUM(`l_dabet`) AS dabet_total FROM `tab_ldc2`");
                  $tdabet_row = mysql_fetch_array($tdabet);
                  $tcredit_q = mysql_query("SELECT SUM(`l_credit`) AS credit_total FROM `tab_ldc2`");
                  $tcredit_row = mysql_fetch_array($tcredit_q);
                  print'
                  <tr>
                    <td colspan="4"></td>
                    <td><b>'.number_format($tcredit_row2['total_dabet'],2).'</b></td>
                    <td><b>'.$f_total_c.'</b></td>
                    <td><b>'.number_format($tdabet_row['dabet_total'],2).'</b></td>
                    <td><b>'.number_format($tcredit_row['credit_total'],2).'</b></td>
                  </tr>
                  <tr>
                    <td colspan="6" class="text-right">Total Local Report Summary</td>
                    <td><b>'.number_format($tdabet_row['dabet_total'],2).'</b></td>
                    <td><b>'.number_format($tcredit_row['credit_total'],2).'</b></td>
                  </tr>
                  ';
                  
                  ?>
                    
                  </tbody>
                </table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
             <!-- </form>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
mysql_query("DELETE FROM `temp`");
mysql_query("DELETE FROM `tab_ldc2`");
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>