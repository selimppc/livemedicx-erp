<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Accounts Payable Voucher</title>

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
                $sql = mysql_query("SELECT * FROM `am_vouhcerheader` WHERE `am_vouchernumber`='$pVoucherNo'") or die(mysql_error());
                $ro = mysql_fetch_array($sql);
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
                  <h2 style="border-bottom:1px solid #CCC"><b>Accounts Payable Voucher</b></h2>
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
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
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
                <form method="post" action="excel/ap_invoice.php?pVoucherNo=<?php echo $pVoucherNo?>">
                
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
                  $query = mysql_query("SELECT * FROM `am_voucherdetail`,`am_chartofaccounts` WHERE (am_voucherdetail.am_accountcode=am_chartofaccounts.am_accountcode) AND am_voucherdetail.am_vouchernumber='$pVoucherNo'") or die(mysql_error());
                  while($row = mysql_fetch_array($query)){
                    $amount = $row['am_primeamt'];
                    $debit = '';
                    $credit = '';
                    if($amount > 0){
                      $debit = $amount;
                    }else{
                      $credit = $amount;
                    }
                    if($debit==false){
                      $debit = '0.00';
                    }
                    if($credit==false){
                      $credit = '0.00';
                    }
                    $exchan = $row['am_exchagerate'];
                    $ldebit = $debit * $exchan;
                    $lcredit = $credit * $exchan;
                    if($ldebit==0){
                      $ldebit = '0.00';
                    }
                    if($lcredit==0){
                      $lcredit = '0.00';
                    }
                    mysql_query("INSERT INTO tab_ldc VALUES('','$debit','$credit','$ldebit','$lcredit')") or die(mysql_error());
                    echo '
                    <tr>
                      <td>'.$row['am_accountcode'].'</td>
                      <td>'.$row['am_description'].'</td>
                      <td>'.$row['am_currency'].'</td>
                      <td>'.$row['am_exchagerate'].'</td>
                      <td>'.$debit.'</td>
                      <td>'.str_replace('-', '', $credit).'</td>
                      <td>'.$ldebit.'</td>
                      <td>'.str_replace('-', '', $lcredit).'</td>
                    </tr>
                    ';
                  }
                  $dabet_c = mysql_query("SELECT sum(dabet) AS Dabet FROM tab_ldc") or die(mysql_error());
                  $dabet_r = mysql_fetch_array($dabet_c);
                  $credit_c = mysql_query("SELECT sum(credit) AS Credit FROM tab_ldc") or die(mysql_error());
                  $credit_r = mysql_fetch_array($credit_c);
                  $dabet_l = mysql_query("SELECT sum(l_dabet) AS Dabetl FROM tab_ldc") or die(mysql_error());
                  $dabet_r_l = mysql_fetch_array($dabet_l);
                  $credit_l = mysql_query("SELECT sum(l_credit) AS Creditl FROM tab_ldc") or die(mysql_error());
                  $credit_r_l = mysql_fetch_array($credit_l);
                  echo '
                  <tr>
                    <td colspan="4"></td>
                    <th>'.number_format($dabet_r['Dabet'],2).'</th>
                    <th>'.str_replace('-', '', number_format($credit_r['Credit'],2)).'</th>
                    <th>'.number_format($dabet_r_l['Dabetl'],2).'</th>
                    <th>'.str_replace('-', '', number_format($credit_r_l['Creditl'],2)).'</th>
                  </tr>
                  ';
                  echo '
                  <tr>
                    <th colspan="6" class="text-right">Total Local Report Summary</th>
                    <th>'.number_format($dabet_r_l['Dabetl'],2).'</th>
                    <th>'.str_replace('-', '', number_format($credit_r_l['Creditl'],2)).'</th>
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
//mysql_query("DELETE FROM `balance`");
mysql_query("DELETE FROM `tab_ldc`");
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>