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
                $pPoNumber = $_GET['pPoNumber'];
                $sql = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE `pp_purordnum`='$pPoNumber'") or die(mysql_error());
                $row = mysql_fetch_array($sql);
                $cm_supplierid = $row['cm_supplierid'];
                $sql2 = mysql_query("SELECT * FROM `cm_suppliermaster` WHERE cm_supplierid='$cm_supplierid'");
                $row2 = mysql_fetch_array($sql2);
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
                <div class="col-md-12">
                  <h2 class="text-center" style="border-bottom:1px solid #CCC"><b>PURCHASE ORDER</b></h2>
                </div>
  						</div>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-borderless2">
                      <tr>
                        <th>Supplier</th>
                        <td><?php echo $row2['cm_supplierid']?></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>Order Number</th>
                        <td><?php echo $row['pp_purordnum']?></td>
                      </tr>
                      <tr>
                        <th>Name</th>
                        <td><?php echo $row2['cm_orgname']?></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>Date</th>
                        <td><?php echo $row['pp_date']?></td>
                      </tr>
                      <tr>
                        <th>Cell Number</th>
                        <td><?php echo $row2['cm_cellphone']?></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>Delivery Date</th>
                        <td><?php echo $row['pp_deliverydate']?></td>
                      </tr>
                       <tr>
                        <th>Currency</th>
                        <td><?php echo $row['pp_currency']?></td>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <th>Deliver To</th>
                        <td><?php echo $row['pp_store']?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <h2 style="border-top:1px solid #CCC">&nbsp;</h2>
                 <form method="post" action="excel/purchses_order.php?pPoNumber=<?php echo $pPoNumber?>" >
  							
                <table class="table table-striped table-bordered table-highlight" data-provide="datatable" data-info="false"data-search="false"data-display-rows="15"data-length-change="false"data-paginate="true">
                  <thead>
                    <tr>
                      <th data-filterable="true">Product Name</th>
                      <th data-filterable="true">Code</th>
                      <th>Unit</th>
                      <th>Unit QTY</th>
                      <th>Ord QTy</th>               
                      <th>Rate</th>
                      <th>TAX</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $query_total = mysql_query("SELECT SUM(`pp_rowamt`) AS total FROM `pp_purchaseorddt` WHERE pp_purordnum='$pPoNumber'");
                  $total_row = mysql_fetch_array($query_total);
                  $total = $total_row['total'];
                  $dis_qu = mysql_query("SELECT * FROM `pp_purchaseordhd` WHERE `pp_purordnum`='$pPoNumber'");
                  $dis_row = mysql_fetch_array($dis_qu);
                  $dis_create = $dis_row['pp_discrate'];
                  $dis_amount = $dis_row['pp_discamt'];
                  $tdis_amount = ($total*$dis_create)/100;
                  $net_amount = $total-$tdis_amount;
                  $query = mysql_query("SELECT * FROM `pp_purchaseorddt` WHERE pp_purordnum='$pPoNumber'");
                while($r = mysql_fetch_array($query)){
                  $cm_code = $r['cm_code'];
                  $query2 = mysql_query("SELECT * FROM `cm_productmaster` WHERE cm_code='$cm_code'");
                  $r2 = mysql_fetch_array($query2);
                    print'
                    <tr>
                      <td>'.$r2['cm_name'].'</td>
                      <td>'.$r2['cm_code'].'</td>
                      <td>'.$r['pp_unit'].'</td>
                      <td>'.$r['pp_unitqty'].'</td>
                      <td>'.$r['pp_quantity'].'</td>
                      <td>'.number_format($r['pp_purchasrate'],2).'</td>
                      <td>'.number_format($r['pp_taxamt'],2).'</td>
                      <td>'.number_format($r['pp_rowamt'],2).'</td>
                    </tr>
                    ';
                  }
                  echo '</tbody>';
                  print'
                  <tfoot>
                  <tr>
                    <td><td>
                    <td><td>
                    <td><td>
                    <th>Total Amount :</th>
                    <th>'.number_format($total_row['total'],2).'</th>
                  </tr>
                  <tr>
                    <td><td>
                    <td><td>
                    <td><td>
                    <th>Discount Rate(%):</th>
                    <th>'.number_format($dis_row['pp_discrate'],2).'%</th>
                  </tr>
                  <tr>
                    <td><td>
                    <td><td>
                    <td><td>
                    <th>Discount :</th>
                    <th>'.number_format($tdis_amount,2).'</th>
                  </tr>
                  <tr>
                    <td><td>
                    <td><td>
                    <td><td>
                    <th>Net Amount :</th>
                    <th>'.number_format($net_amount,2).'</th>
                  </tr></tfoot>
                  ';
                  ?>
                    
                  
                </table>
                <div class="text-right"><button name="pdf" class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true" style="color:red;"></i>&nbsp;PDF</button>&nbsp;<button name="excel" class="btn btn-warning"><i class="fa fa-file-excel-o" aria-hidden="true" style="color:green;"></i>&nbsp;Excel</button></div>
             </form>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

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