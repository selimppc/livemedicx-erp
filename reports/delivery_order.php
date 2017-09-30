<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Delivery Note Report</title>

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
                $sql = mysql_query("SELECT * FROM `sm_header`,`cm_customermst`,`cm_branchmaster` WHERE (sm_header.cm_cuscode=cm_customermst.cm_cuscode) AND (sm_header.sm_storeid=cm_branchmaster.cm_branch) AND  sm_header.sm_number='$psmnumber'") or die(mysql_error());
                $row = mysql_fetch_array($sql);
                $cm_cuscode = $row['cm_cuscode'];
				$cm_gid = $row['gerant_id'];
				//print_r($cm_gid);
                $sm_storeid = $row['sm_storeid'];
                // $sql2 = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$cm_supplierid'");
                // $row2 = mysql_fetch_array($sql2);
              ?>
              
  						<div class="row">
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
                <div class="col-md-12">
                  <h2 class="text-center"><b><u>Delivery Note</u></b></h2>
                </div>
  						</div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-9">
                      <h4><b>To,</b></h4>
                      <h4><b>Customer ID:<?php echo $cm_cuscode.'<br>';?><?php echo 'Name:'.$row['cm_name'].'<br>'?><?php echo 'Gerant ID:'.$row['gerant_id'].'<br>'?></b></h4>
                      <h4><?php echo $row['cm_address']?></h4>
                    </div>
                    <div class="col-md-3">
                      <h4><b>Invoice Number <?php echo $psmnumber?></b></h4>
                      <h4><b>From,</b></h4>
                      <h4><b><?php echo $sm_storeid?> <?php echo $row['cm_description']?></b></h4>
                      <h4><?php echo $row['sm_date']?></h4>
                    </div>
                  </div>
                </div>
              </div>
              <h2 style="border-top:1px dotted #CCC">&nbsp;</h2>
  						<div class="table-responsive">
                <form method="post" action="excel/delivery_order.php?psmnumber=<?php echo $psmnumber?>" >
                <table  class="table table-borderless">
                  <thead>
                    <tr>
                      <th style="border-bottom:2px solid #000">Sl.</th>
                      <th style="border-bottom:2px solid #000">Product Name</th>
                      <th style="border-bottom:2px solid #000">Code</th>
                      <th style="border-bottom:2px solid #000">Batch</th>
                      <th style="border-bottom:2px solid #000">Expiry Date</th>
                      <th style="border-bottom:2px solid #000">Quantity</th>               
                      <th style="border-bottom:2px solid #000">Unit</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $query = mysql_query("SELECT * FROM `sm_batchsale`,`cm_productmaster` WHERE (sm_batchsale.cm_code=cm_productmaster.cm_code) AND sm_batchsale.sm_number='$psmnumber'");
                  $i = 1;
                  $no = $i;
                  while($r = mysql_fetch_array($query)){
                    print'
                    <tr>
                      <td>'.$no++.'</td>
                      <td>'.$r['cm_name'].'</td>
                      <td>'.$r['sm_number'].'</td>
                      <td>'.$r['cm_code'].'</td>
                      <td>'.$r['sm_expdate'].'</td>
                      <td>'.$r['sm_quantity'].'</td>
                      <td>'.$r['sm_unit'].'</td>
                    </tr>
                    ';
                  }
                  $sum = mysql_query("SELECT SUM(sm_quantity) AS total FROM sm_batchsale WHERE sm_number='$psmnumber'");
                  $sr = mysql_fetch_array($sum);
                  print'
                  <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <th style="border-top:2px solid #000">Total Qty</th>
                      <th style="border-top:2px solid #000">'.$sr['total'].'</th>
                      <td></td>
                    </tr>
                  ';
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>