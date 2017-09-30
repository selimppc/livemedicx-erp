<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Purchase Order wise GRN</title>

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
                $pPoNumber = $_GET['pPoNumber'];
                $sql = mysql_query("SELECT * FROM `pp_purchaseordhd`,`cm_suppliermaster`,`cm_branchmaster` WHERE(pp_purchaseordhd.cm_supplierid=cm_suppliermaster.cm_supplierid) AND (pp_purchaseordhd.pp_store=cm_branchmaster.cm_branch) AND pp_purchaseordhd.pp_purordnum='$pPoNumber'") or die(mysql_error());
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
                  <h2 style="border-bottom:2px solid #000"><b>Purchase Order wise GRN</b></h2>
                </div>
  						</div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8">
                      <h5><b><?php echo $pPoNumber?></b></h5>
                      <h5><b>Supplier Name: <?php echo $ro['cm_orgname']?></b></h5>
                      <h5><b>PO For <?php echo $ro['pp_store']?>&nbsp; <?php echo $ro['cm_description']?></b></h5>
                    </div>
                    <div class="col-md-4">
                      <h5><b>Order Date &nbsp; <?php echo $ro['pp_date']?></b></h5>
                      <h5><b>Currency &nbsp; <?php echo $ro['pp_currency']?>&nbsp; <?php echo $ro['pp_exchrate']?></b></h5>
                      <h5><b>Order Status &nbsp; <?php echo $ro['pp_status']?></b></h5>
                    </div>
                  </div>
                </div>
              </div>
  						<div class="table-responsive">
               <form method="post" action="excel/grnp_report.php?pPoNumber=<?php echo $pPoNumber?>" >
  							
                <table  class="table table-borderless">
                  <thead>
                    <tr>
                      <th colspan="3" style="border:1px solid #000"><h4 class="text-center"><b>Purchase Order Detail</b></h4></th>
                    </tr>
                    <tr>
                      <th style="border:1px solid #000">Code</th>
                      <th style="border:1px solid #000">Product Name</th>
                      <th style="border:1px solid #000">Ordered Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sq = mysql_query("SELECT * FROM `pp_purchaseorddt`,`cm_productmaster` WHERE (pp_purchaseorddt.cm_code=cm_productmaster.cm_code) AND pp_purchaseorddt.pp_purordnum='$pPoNumber'");
                  while($row= mysql_fetch_array($sq)){

                    print'
                    <tr>
                      <td>'.$row['cm_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td>'.$row['pp_quantity'].'</td>
                    </tr>
                    ';
                  }
                  
                  ?>
                    
                  </tbody>
                </table>
                <table  class="table table-borderless">
                  <thead>
                    <tr>
                      <th colspan="7" style="border:1px solid #000"><h4 class="text-center"><b>GRN Detail</b></h4></th>
                    </tr>
                    <tr>
                      <th style="border:1px solid #000">SL. No</th>
                      <th style="border:1px solid #000">GRN Number</th>
                      <th style="border:1px solid #000">GRN Date</th>
                      <th style="border:1px solid #000">Status</th>
                      <th style="border:1px solid #000">Code</th>
                      <th style="border:1px solid #000">Product Name</th>
                      <th style="border:1px solid #000">GRN Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sq = mysql_query("SELECT * FROM `im_grnheader`,`im_grndetail`,`cm_productmaster` WHERE (im_grnheader.im_grnnumber=im_grndetail.im_grnnumber) AND(im_grndetail.cm_code=cm_productmaster.cm_code) AND im_grnheader.im_purordnum='$pPoNumber'");
                  $i = 1;
                  $no = $i;
                  while($row= mysql_fetch_array($sq)){

                    print'
                    <tr>
                      <td>'.$no++.'</td>
                      <td>'.$row['im_grnnumber'].'</td>
                      <td>'.$row['im_date'].'</td>
                      <td>'.$row['im_status'].'</td>
                      <td>'.$row['cm_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td>'.$row['im_RcvQuantity'].'</td>
                    </tr>
                    ';
                  }
                  
                  ?>
                    
                  </tbody>
                </table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></form>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

<?php
//mysql_query("DELETE FROM `balance`");
//mysql_query("DELETE FROM `tab_ldc`");
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>