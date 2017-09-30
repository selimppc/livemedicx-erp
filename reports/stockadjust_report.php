<?php include('connection/dB.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Stock Adjustment Report</title>

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
                $ptrnnumber = $_GET['ptrnnumber'];
                $sql = mysql_query("SELECT * FROM `im_adjusthd` WHERE `transaction_number`='$ptrnnumber'") or die(mysql_error());
                $ro = mysql_fetch_array($sql);
                $adjustment_type = $ro['adjustment_type'];
                $type = '';
                if($adjustment_type<0){
                  $type = 'Negative Adjustment';
                }else{
                  $type = 'Posative Adjustment';
                }
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
                  <h2><b><u>Stock Adjustment Report</u></b></h2>
                </div>
  						</div>
              <div class="row">
                <div class="col-md-12">
                      <h5 class="col-md-12"><b><?php echo $ptrnnumber?></b></h5>
                      <h5 class="col-md-12"><b><?php echo $ro['DATE']?></b></h5>
                      <h5 class="col-md-3"><b><?php echo $type?></b></h5>
                      <h5 class="col-md-3"><b>Currency:</b></h5>
                      <h5 class="col-md-3"><b><?php echo $ro['currency']?></b></h5>
                      <h5 class="col-md-3"><b><?php echo $ro['exchange_rate']?></b></h5>

                </div>
              </div>
  						<div class="table-responsive">
                <form method="post" action="excel/stockadjest.php?ptrnnumber=<?php echo $ptrnnumber?>" >
  							
                <table  class="table table-borderless">
                  <thead>
                    <tr>
                      <th style="border:1px solid #000">Product Code</th>
                      <th style="border:1px solid #000">Product Name</th>
                      <th style="border:1px solid #000">Batch Number</th>
                      <th style="border:1px solid #000">Expiry Date</th>
                      <th style="border:1px solid #000">Quantity</th>
                      <th style="border:1px solid #000">Unit</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sq = mysql_query("SELECT * FROM `im_adjustdt`,`cm_productmaster` WHERE (im_adjustdt.product_code=cm_productmaster.cm_code) AND  im_adjustdt.transaction_number='$ptrnnumber'");
                  while($row= mysql_fetch_array($sq)){

                    print'
                    <tr>
                      <td>'.$row['product_code'].'</td>
                      <td>'.$row['cm_name'].'</td>
                      <td>'.$row['batch_number'].'</td>
                      <td>'.$row['expirry_date'].'</td>
                      <td>'.$row['quantity'].'</td>
                      <td>'.$row['unit'].'</td>
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
//mysql_query("DELETE FROM `balance`");
//mysql_query("DELETE FROM `tab_ldc`");
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>