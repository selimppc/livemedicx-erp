<?php
/* @var $this SmheaderController */
/* @var $model Smheader */
/* @var $form CActiveForm */
?>
<style type="text/css">
table .money-receipt-sales, td
{
	border: 1px solid #4E8EC2;
}
</style>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sm-header-form-sales-return',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_cuscode'),
)); ?>

<script type="text/javascript">
	var id=0;
	var addedProductCodes = [];
	
	$(document).ready(function(){
		$(".items tr").click(function() {
		    var tableData = $(this).children("td").map(function() {
		        return $(this).text();
		    }).get();
		    
		    var total=document.getElementById("sm_totalamt").value;
		    id=id+1;
		    total = parseInt(total)+parseInt($.trim(tableData[5]));

		    var tax1 = document.getElementById("sm_total_tax_amt").value;
			taxamount = parseInt(tax1) + parseInt($.trim(tableData[2])) * (parseInt($.trim(tableData[3])) * parseInt($.trim(tableData[4]))/100);
		    
		    var td_productCode = $.trim(tableData[0]);
		    var index = $.inArray(td_productCode, addedProductCodes);
		    if (index >= 0) {
				alert("You already added this Product");
			} else {
		    	$("#test").append(
		    		"<tr><td><input value='"+$.trim(tableData[0])+"' style='width: 180px;' readonly > </td><td><input name='cm_code[]' value='"+$.trim(tableData[0])+"' style='width: 80px;' readonly ></td><td><input name='sm_batchnumber[]' value=''></td><td><input name='sm_expdate[]' value=''></td><td><input name='sm_unit[]' value='"+$.trim(tableData[1])+"' style='width: 110px;' readonly ></td><td><input name='sm_rate[]'  value='"+$.trim(tableData[3])+"' id='rate_"+id+"' style='width: 80px;text-align: right;' readonly ></td><td><input name='sm_quantity[]' value='"+$.trim(tableData[2])+"' onchange='price_multiply(this.id)' id='"+id+"' style='width: 60px;text-align: center;'> <input type='hidden' id='check_"+id+"' value='"+$.trim(tableData[2])+"'  > </td><td><input name='sm_tax_rate[]' id='tax_"+id+"'  value='"+$.trim(tableData[4])+"' style='width: 60px;text-align: center;' readonly ></td><td><input name='sm_lineamt[]'  id='price_"+id+"' value='"+$.trim(tableData[5])+"' style='width: 100px; text-align: right;' readonly ></td></tr>");
		    	
			    	addedProductCodes.push(td_productCode);
			}
			
		    document.getElementById("sm_totalamt").value = total;
			document.getElementById("sm_total_tax_amt").value = taxamount;

			var sm_disc_rate = document.getElementById("sm_disc_rate").value;
			var sm_disc_amount = total * sm_disc_rate/ 100;
			document.getElementById("sm_disc_amt").value = sm_disc_amount;
			
			document.getElementById("sm_netamt").value = ( total + taxamount) - sm_disc_amount ;
			
		});
	});

	function price_multiply(id){

		var t_total = document.getElementById("sm_totalamt").value;
		var c_price = document.getElementById("price_"+id).value;
		
		var c_total = parseInt(t_total) - parseInt(c_price);

		var availqty = document.getElementById("check_"+id).value;
		var getqty = document.getElementById(id).value;
		
		if( parseInt(getqty) > parseInt(availqty) ){
				alert("You Can't return this Qty: " + getqty );
				document.getElementById(id).value = availqty;
				exit;
		}else{
				var getRate =  document.getElementById("rate_"+id).value;
				var new_value = parseInt(getRate) * parseInt(getqty);
				document.getElementById("price_"+id).value = new_value;
				
				document.getElementById("sm_totalamt").value = c_total + parseInt(new_value);

				var tax1 = document.getElementById("sm_total_tax_amt").value;
				var tax = document.getElementById("tax_"+id).value;
				var preTax = parseInt(getRate)* parseInt(availqty) * parseInt(tax) / 100;
				var mtax = parseInt(tax1) - parseInt(preTax);
				var taxamount = parseInt(mtax)+(parseInt(new_value) * parseInt(tax)/100) ;

				document.getElementById("sm_total_tax_amt").value = taxamount;

				var sm_disc_amt = document.getElementById("sm_disc_amt").value;
				var sm_disc_rate = document.getElementById("sm_disc_rate").value;
				var preDiscAmt =  parseInt(getRate)* parseInt(availqty) * parseInt(sm_disc_rate)/100;
				var postDiscAmt = parseInt(sm_disc_amt) - parseInt(preDiscAmt);

				var sm_disc_amount = parseInt(postDiscAmt) + (new_value * sm_disc_rate/ 100);
				
				document.getElementById("sm_disc_amt").value = sm_disc_amount;
				
				document.getElementById("sm_netamt").value = ( c_total + parseInt(new_value) + parseInt(taxamount) ) - parseInt(sm_disc_amount) ;	
				
			}
	}

</script>
<div style="width: 100%; float: left;">

<div style="width: 50%; float: left;">
<table>
	<tr>
		<td colspan="8" style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> New Sales Return </td>
	</tr>
	
	<tr>
		<td colspan="2">Return No </td>
		<td colspan="2"> <?php echo $form->textField($model,'sm_number',array('id'=>'sm_number', 'readonly'=>'readonly', 'style'=>'width:100px')) ?> </td>
		<td colspan="2">Date </td>
		<td colspan="2"><?php echo $form->textField($model,'sm_date', array('id'=>'sm_date', 'readonly'=>'readonly', 'style'=>'width:100px')); ?> </td>
		
	</tr>
	
	<tr>
		<td colspan="2">Invoice No </td>
		<td colspan="2"> <input value="<?php echo $sm_number; ?>" id="sm_number" readonly="readonly" style="width:100px" /> </td>
		<td colspan="2">Inv. Date </td>
		<td colspan="2">Show Inv. Date </td>
	</tr>
	
	<tr>
		<td>Customer </td>
		<td>Customer code </td>
		<td colspan="6">Customer Name </td>
	</tr>
	
	<tr>
		<td> Sales Person </td>
		<td> <?php echo $form->textField($model,'cm_cuscode',array('id'=>'sm_number', 'readonly'=>'readonly', 'style'=>'width:100px')); ?> </td>
		<td colspan="6" style="background: white;">Sales Person name </td>
	</tr>
	
	<tr>
		<td>Total </td>
		<td style="background: white;"><?php echo $smheader['sm_totalamt'] ?>  </td>
		<td>VAT </td>
		<td style="background: white;"><?php echo $smheader['sm_total_tax_amt'] ?> </td>
		<td>Discount </td>
		<td style="background: white;"><?php echo $smheader['sm_disc_amt'] ?>  </td>
		<td>Net </td>
		<td style="background: white;"><?php echo $smheader['sm_netamt'] ?> </td>
	</tr>
	
	<tr>
		<td colspan="1">Status </td>
		<td colspan="2" style="background: white;">Open </td>
		<td colspan="2">Branch </td>
		<td colspan="3" style="background: white;">Dhaka </td>

	</tr>

</table>
</div>

<div style="width: 45%; float: left;">

<table style="width: 100%; float: left;">
	<tr>
		<td style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> Item list of invoiced by "<?php echo $sm_number; ?>" </td> 
	</tr>
</table>
<table>
	<thead>
		<tr>
			<td width="130">Name </td>
			<td>Code </td>
			<td>Unit </td>
			<td>Rate </td>
			<td>Qty </td>
			<td>VAT </td>
			<td>Total  </td>
		</tr>
	</thead>
	
	<tbody class="items">
		<?php foreach($smdetail as $values): { ?>
		<tr style="background: white;">
			<td width="160"><?php echo $values['cm_name']; ?> </td>
			<td><?php echo $values['cm_code']; ?> </td>
			<td><?php echo $values['sm_unit']; ?> </td>
			<td><?php echo $values['sm_rate']; ?> </td>
			<td width="60" style="text-align: center;"><?php echo $values['sm_quantity']; ?> </td>
			<td><?php echo $values['sm_tax_rate']; ?> </td>
			<td width="100" style="text-align: right;"><?php echo $values['sm_lineamt']; ?> </td>
		</tr>
		<?php } endforeach; ?>
	</tbody>
	
</table>

</div>
</div>

<table style="width: 97%; float: left; margin-top: 20px; ">
	<tr> 
		<td style="background: #4085BB; color: white; text-align: center; font-weight: bold;">Return Item (Please pick item from list)  </td>
	</tr>
</table>
<table style="width: 97%; float: left;">
	<thead>
		<tr>
			<th width="80">Item Name</th>
			<th>Code</th>
			<th>Batch No</th>
			<th>Exp. Date</th>
			<th>UOM</th>
			<th>Rate</th>
			<th>Rtn. Qty.</th>
			<th>VAT (%)</th>
			<th>Line Total</th>
		</tr>
	</thead>
	
	<tbody id="test">
		<tr>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
	</tbody>
	
</table>



	<div class="row">
	<?php //echo $form->labelEx($model,'sm_doc_type'); ?>
	<?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Return', 'id'=>'sm_doc_type')); ?>
	<?php //echo $form->error($model,'sm_doc_type'); ?>
	</div>

	<br>


	<div class="row">
	<?php //echo $form->labelEx($model,'sm_doc_type'); ?>
	<?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Return', 'id'=>'sm_doc_type')); ?>
	<?php //echo $form->error($model,'sm_doc_type'); ?>
	</div>



	<table style="margin-left: 65%; margin-top: 20px;" CELLSPACING="0">
		<tr>
			<td>

				<div class="row">
				<?php echo $form->labelEx($model,'sm_totalamt'); ?>
				<?php echo $form->textField($model,'sm_totalamt',array('value'=>'0', 'id'=>'sm_totalamt','class'=>'sm_totalamt', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_totalamt'); ?>
				</div>

				<div class="row">
				<?php echo $form->labelEx($model,'sm_total_tax_amt'); ?>
				<?php echo $form->textField($model,'sm_total_tax_amt',array('value'=>'0', 'id'=>'sm_total_tax_amt','class'=>'sm_total_tax_amt', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_total_tax_amt'); ?>
				</div>

				<div class="row">
				<?php echo $form->labelEx($model,'sm_disc_amt'); ?>
				<?php echo $form->textField($model,'sm_disc_amt',array('value'=>'0','id'=>'sm_disc_amt','class'=>'sm_disc_amt', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_disc_amt'); ?>
				</div>

				<div class="row">
				<?php echo $form->labelEx($model,'sm_netamt'); ?>
				<?php echo $form->textField($model,'sm_netamt',array('value'=>'0', 'id'=>'sm_netamt','class'=>'sm_netamt', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_netamt'); ?>
				</div>
			</td>
		</tr>
	</table>

	<div class="row">
	<?php //echo $form->labelEx($model,'sm_storeid'); ?>
	<?php echo $form->hiddenField($model,'sm_storeid',array('size'=>20,'maxlength'=>20)); ?>
	<?php //echo $form->error($model,'sm_storeid'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'sm_refe_code'); ?>
	<?php echo $form->hiddenField($model,'sm_refe_code',array('size'=>20,'maxlength'=>20)); ?>
	<?php //echo $form->error($model,'sm_refe_code'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'sm_sign'); ?>
	<?php echo $form->hiddenField($model,'sm_sign', array('value'=>'-1', 'readonly'=>'readonly')); ?>
	<?php //echo $form->error($model,'sm_sign'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'sm_stataus'); ?>
	<?php echo $form->hiddenField($model,'sm_stataus',array('value'=>'Open','readonly'=>'readonly')); ?>
	<?php //echo $form->error($model,'sm_stataus'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'inserttime'); ?>
	<?php echo $form->hiddenField($model,'inserttime'); ?>
	<?php //echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'updatetime'); ?>
	<?php echo $form->hiddenField($model,'updatetime'); ?>
	<?php //echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'insertuser'); ?>
	<?php echo $form->hiddenField($model,'insertuser',array('size'=>20,'maxlength'=>20)); ?>
	<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
	<?php // echo $form->labelEx($model,'updateuser'); ?>
	<?php echo $form->hiddenField($model,'updateuser',array('size'=>20,'maxlength'=>20)); ?>
	<?php // echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<div class="row status-container">
			<div class="span4 action-bar">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
