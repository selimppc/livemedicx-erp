<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Invoice Entry Report</title>

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
                $psmnumber = $_GET['psmnumber'];
                $sql = mysql_query("SELECT * FROM `sm_header` WHERE `sm_number`='$psmnumber'") or die(mysql_error());
                $sq = mysql_query("SELECT SUM(`sm_totalamt`) AS Total FROM `sm_header` WHERE `sm_number`='$psmnumber'");
                $sq2 = mysql_query("SELECT SUM(`sm_total_tax_amt`) AS Totaltax FROM `sm_header` WHERE `sm_number`='$psmnumber'");
                $ss = mysql_fetch_array($sql);
                $s = mysql_fetch_array($sq);
                $s2 = mysql_fetch_array($sq2);
                // $query = mysql_query("SELECT * FROM `sm_header` WHERE sm_number='$psmnumber'") or die(mysql_error());
                // $r = mysql_fetch_array($query);
                $cm_cuscode = $ss['cm_cuscode'];
                $discount = $ss['sm_disc_amt'];
                if($discount==null){
                  $discount = '0.00';
                }
                $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_cuscode'") or die(mysql_error());
                $rr = mysql_fetch_array($query2);
                $cq = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$cm_cuscode'");
                $cr = mysql_fetch_array($cq);
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
                <div class="col-md-12 text-center">
                  <?php
                  $equery = mysql_query("SELECT * FROM `companyprofile`");
                   while($ro = mysql_fetch_array($equery)){
                     print'
                     <img class="logo" src="../images/companyprofile/'.$ro['photo'].'">
                     ';
                   }
                  ?>
                </div>
                <form action="excel/sales_report_invoice2.php?psmnumber=<?php echo $psmnumber?>" method="post">
                <div class="col-md-4">
                  <table class="table table-borderless2 table-responsive" style="border:none">
                    <tr>
                      <th><?php echo $cm_cuscode?></th>
                    </tr>
                    <tr>
                      <td><?php echo $cr['cm_name']?></td>
                    </tr>
                    <tr>
                      <td><?php echo $cr['cm_address']?></td>
                    </tr>
                    <tr>
                      <td><?php echo $cr['cm_cellnumber']?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-4 text-center"><h2><b>Sales Invoice</b></h2></div>
                <div class="col-md-4">
                  <table class="table table-borderless2 table-responsive" style="border:none">
                    <tr>
                      <th>Invoice No</th>
                      <td></td>
                      <td><?php echo $psmnumber;?></td>
                    </tr>
                    <tr>
                      <th>Date</th>
                      <td></td>
                      <td><?php echo $ss['sm_date']?></td>
                    </tr>
                    <tr>
                      <th>From</th>
                      <td></td>
                      <td><?php echo $ss['sm_storeid']?></td>
                    </tr>
                    <tr>
                      <th>Currency</th>
                      <td></td>
                      <td><?php echo $ss['sm_currency']?></td>
                    </tr>
					 <tr>
                      <th>Gerant ID:</th>
                      <td><?php echo $cr['gerant_id']?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <h3 class="text-center" style="border-top:1px solid #000;border-bottom:1px solid #000; padding:5px;"><b>Product Description</b></h3><h5>Direct sales for the Invoice <?php echo $psmnumber?> that were registered as <?php echo $ss['sm_storeid']?> invoices instead of <?php echo $ss['sm_currency']?>. Amout</h5>
              
                <!--<form method="post" action="excel.php" >-->
                <div class="col-md-12">
                  <div class="row">
                    <div style="height:200px;border-bottom:3px solid #000; width:300px; float:right"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div style="border-top:3px solid #000; width:300px; float:right; margin-top:2px"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div style="width:300px; float:right; margin-top:2px">
                      <h4><b>Amout (Excl. VAT):<?php echo $s['Total']?></b></h4><br>
                      <h4><b>VAT: <?php echo number_format($s2['Totaltax'],2)?></b></h4><br>
                      <h4><b>Amount (Incl. VAT):<?php echo number_format($s['Total']+$s2['Totaltax'],2) ?></b></h4>
                    </div>
                  </div>
                </div>

                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
            </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>