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
                $sql = mysql_query("SELECT * FROM `sm_detail` WHERE `sm_number`='$psmnumber'") or die(mysql_error());
                $sq = mysql_query("SELECT SUM(`sm_lineamt`) AS Total FROM `sm_detail` WHERE `sm_number`='$psmnumber'");
                $s = mysql_fetch_array($sq);
                $query = mysql_query("SELECT * FROM `sm_header` WHERE sm_number='$psmnumber'") or die(mysql_error());
                $r = mysql_fetch_array($query);
                $cm_cuscode = $r['cm_cuscode'];
                $discount = $r['sm_disc_amt'];
                if($discount==null){
                  $discount = '0.00';
                }
                $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_cuscode'") or die(mysql_error());
                $rr = mysql_fetch_array($query2);
                $cq = mysql_query("SELECT * FROM `cm_customermst` WHERE cm_cuscode='$cm_cuscode'");
                $cr = mysql_fetch_array($cq);
				$grid=$cr['gerant_id'];
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
                <div class="col-md-4">
                  <table class="table table-borderless2 table-responsive" style="border:none">
                    <tr>
                      <th>Cust Code:</th>
                      <th><?php echo $r['cm_cuscode']?></th>
                    </tr>
                    <tr>
                      <th>Cust Name:</th>
                      <td><?php echo $cr['cm_name']?></td>
                    </tr>
                    <tr>
                      <th>Address:</th>
                      <td><?php echo $cr['cm_address']?></td>
                    </tr>
                    <tr>
                      <th>Contact:</th>
                      <td><?php echo $cr['cm_cellnumber']?></td>
                    </tr>
					 <tr>
                      <th>Gerant ID:</th>
                      <td><?php echo $cr['gerant_id']?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-4 text-center"><h2><b>Sale Invoice</b></h2></div>
                <div class="col-md-4">
				<?php
				 $gid=$cr['gerant_id'];
				 ?>
                  <table class="table table-borderless2 table-responsive" style="border:none">
                    <tr>
                      <th>Invoice No:</th>
                      <td></td>
                      <td><?php echo $psmnumber;?></td>
                    </tr>
                    <tr>
                      <th>Date:</th>
                      <td></td>
                      <td><?php echo $r['sm_date']?></td>
                    </tr>
                    <tr>
                      <th>From:</th>
                      <td></td>
                      <td><?php echo $r['sm_storeid']?></td>
                    </tr>
                    <tr>
                      <th>Currency:</th>
                      <td></td>
                      <td><?php echo $r['sm_currency']?> <?php echo $r['sm_exchrate']?></td>
                    </tr>
                  </table>
                </div>
  						</div>
  						<div class="table-responsive">
                <form method="post" action="excel/sales_report_invoice.php?psmnumber=<?php echo $psmnumber?>">
  							
                <table  class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Product Code</th>
                      <th>Order Quantity</th>
                      <th>Unit</th>
                      <th>Rate</th>                      
                      <th>VAT %</th>
                      <th>Total Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  while($row= mysql_fetch_array($sql)){
                    $cm_code = $row['cm_code'];
                    $query = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'") or die(mysql_error());
                    $rr = mysql_fetch_array($query);
                    print'
                    <tr>
                      <td>'.$rr['cm_name'].'</td>
                      <td>'.$row['cm_code'].'</td>
                      <td>'.$row['sm_quantity'].'</td>
                      <td>'.$rr['cm_purunit'].'</td>
                      <td>'.$row['sm_rate'].'</td>
                      <td>'.$row['sm_tax_rate'].'</td>
                      <td>'.$row['sm_lineamt'].'</td>
                    </tr>
                    ';
                  }
                  print'
                    <tr>
                    <td colspan="6" class="text-right">Total Tax</td>
                    <td><b>'.$r['sm_total_tax_amt'].'</b></td>
                  </tr>
                  <tr>
                    <td colspan="6" class="text-right">Total Discount</td>
                    <td><b>'.$r['sm_disc_amt'].'</b></td>
                  </tr>
                  <tr>
                    <td colspan="6" class="text-right">Total Pay</td>
                    <td><b>'.$r['sm_netamt'].'</b></td>
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>