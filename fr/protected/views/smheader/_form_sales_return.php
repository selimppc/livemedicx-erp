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
		    
		    var total=Math.round((document.getElementById("sm_totalamt").value)*100)/100;
		    id=id+1;
		    total = total+ Math.round(($.trim(tableData[8]))*100)/100;

		    var tax1 = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
			taxamount = Math.round((tax1 + $.trim(tableData[5]) * ($.trim(tableData[6]) * $.trim(tableData[7])/100))*100)/100;

			var preValue = Math.round(($.trim(tableData[8]))*100)/100;
			var preVat = Math.round(($.trim(tableData[7]))*100)/100;
			var preQty = Math.round(($.trim(tableData[6]))*100)/100;
			var preRate = Math.round(($.trim(tableData[5]))*100)/100;

            var td_productCode = $.trim(tableData[1]);
            var index = $.inArray(td_productCode, addedProductCodes);

            if (index >= 0) {
                alert("You already added this Product");
                exit;
            }

		   $("#test").append(
		    	"<tr><td><input value='"+$.trim(tableData[0])+"' style='width: 180px;' readonly > </td><td><input name='cm_code[]' value='"+$.trim(tableData[1])+"' style='width: 80px;' readonly ></td><td><input name='sm_batchnumber[]' value='"+$.trim(tableData[2])+"' style='width: 80px; text-align: center;'></td><td><input name='sm_expdate[]' value='"+$.trim(tableData[3])+"' style='width: 100px;'></td><td><input name='sm_unit[]' value='"+$.trim(tableData[4])+"' style='width: 110px;' readonly ></td><td><input name='sm_sellrate[]'  value='"+$.trim(tableData[5])+"' id='rate_"+id+"' style='width: 80px;text-align: right;' readonly ></td><td><input name='sm_quantity[]' value='"+$.trim(tableData[6])+"' onchange='price_multiply(this.id)' id='"+id+"' style='width: 60px;text-align: center;'> <input type='hidden' id='check_"+id+"' value='"+$.trim(tableData[6])+"'  > </td><td><input name='sm_tax_rate[]' id='tax_"+id+"'  value='"+$.trim(tableData[7])+"' style='width: 60px;text-align: center;' readonly ></td><td><input name='sm_lineamt[]'  id='price_"+id+"' value='"+$.trim(tableData[8])+"' style='width: 100px; text-align: right;' readonly ></td><td><input type='hidden' id='check_id' name='sm_rate[]' value='"+$.trim(tableData[9])+"' style='width: 100px; text-align: right;' readonly ></td></td><td> <span onclick='deleteRow(\""+ preValue + "\", \"" + preVat + "\", \"" + preQty + "\", \"" + preRate + "\", \"" + id + "\", this)' style='background:orange; color:white; border-radius: 3px; cursor: pointer; padding: 1px 3px; margin-left: 5px;'> x </span> </td></tr>");
		    	

		    document.getElementById("sm_totalamt").value = Math.round((total)*100)/100;
			document.getElementById("sm_total_tax_amt").value = Math.round((taxamount)*100)/100;

			var sm_disc_rate = Math.round((document.getElementById("sm_disc_rate").value)*100)/100;
			var sm_disc_amount = Math.round((total * sm_disc_rate/ 100)*100)/100;
			document.getElementById("sm_disc_amt").value = Math.round((sm_disc_amount)*100)/100;
			
			document.getElementById("sm_netamt").value = Math.round(((total + taxamount) - sm_disc_amount )*100)/100;

            addedProductCodes.push(td_productCode);
		});
	});

	function price_multiply(id){

		var t_total = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
		var c_price = Math.round((document.getElementById("price_"+id).value)*100)/100;
		
		var c_total = Math.round((t_total - c_price)*100)/100;

		var availqty = document.getElementById("check_"+id).value;
		var getqty = document.getElementById(id).value;
		
		if( parseInt(getqty) > parseInt(availqty) ){
				alert("You Can't return this Qty: " + getqty );
				document.getElementById(id).value = availqty;
				exit;
		}else{
				var getRate =  Math.round((document.getElementById("rate_"+id).value)*100)/100;
				var new_value = Math.round((getRate * getqty)*100)/100;
				document.getElementById("price_"+id).value = new_value;
				
				document.getElementById("sm_totalamt").value = Math.round((c_total + new_value)*100)/100;

				var tax1 = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
				var tax = Math.round((document.getElementById("tax_"+id).value)*100)/100;
				var preTax = Math.round(((getRate * availqty * tax) / 100)*100)/100;
				var mtax = Math.round((tax1 - preTax)*100)/100;
				var taxamount = Math.round((mtax + (new_value * tax/100) )*100)/100;

				document.getElementById("sm_total_tax_amt").value = taxamount;

				var sm_disc_amt = Math.round((document.getElementById("sm_disc_amt").value)*100)/100;
				var sm_disc_rate = Math.round((document.getElementById("sm_disc_rate").value)*100)/100;
				var preDiscAmt =  Math.round((getRate * availqty * sm_disc_rate/100)*100)/100;
				var postDiscAmt = Math.round((sm_disc_amt - preDiscAmt)*100)/100;

				var sm_disc_amount = Math.round((postDiscAmt + (new_value * sm_disc_rate/ 100))*100)/100;
				
				document.getElementById("sm_disc_amt").value = Math.round((sm_disc_amount)*100)/100
				
				document.getElementById("sm_netamt").value = Math.round(((c_total + new_value + taxamount) - sm_disc_amount )*100)/100;
				
			}
	}

	function deleteRow(preValue, preVat, preQty, preRate, id, row)
	{
		var preTotal = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
        var lastTotal = Math.round((document.getElementById("price_"+id).value)*100)/100;

        total = Math.round((preTotal - lastTotal)*100)/100;
		document.getElementById("sm_totalamt").value = total;



		var preTaxAmt = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
		var postTaxAmt = Math.round((lastTotal * preVat / 100)*100)/100;
		var taxAmt = Math.round((preTaxAmt - postTaxAmt)*100)/100;
		document.getElementById("sm_total_tax_amt").value = taxAmt;

		var preDiscAmt = Math.round((document.getElementById("sm_disc_amt").value)*100)/100;
		var discRate = document.getElementById("sm_disc_rate").value;
		var postDiscAmt = Math.round((lastTotal * discRate / 100)*100)/100;
		var discAmt = Math.round((preDiscAmt - postDiscAmt)*100)/100;
		document.getElementById("sm_disc_amt").value = Math.round((discAmt)*100)/100;

		document.getElementById("sm_netamt").value = (total + taxAmt) - discAmt;

        $(row).closest('tr').remove();
	}


</script>
<div style="width: 100%; float: left;">

<div style="width: 50%; float: left;">
<table>
	<tr>
		<td colspan="8" style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> New Sales Return </td>
	</tr>
	
	<tr>
		<td colspan="2">Sales Return No </td>
		<td colspan="2"> <?php echo $form->textField($model,'sm_number',array('id'=>'sm_number', 'readonly'=>'readonly', 'style'=>'width:100px')) ?> </td>
		<td colspan="2">Date </td>
		<td colspan="2"><?php echo $form->textField($model,'sm_date', array('id'=>'sm_date', 'readonly'=>'readonly', 'style'=>'width:100px')); ?> </td>
		
	</tr>
	
	<tr>
		<td colspan="2">According to Invoice No </td>
		<td colspan="2"> <input name="sm_ref_code" value="<?php echo $sm_number; ?>" id="sm_number" readonly="readonly" style="width:100px" /> </td>
		<td colspan="2">Invoice Date </td>
		<td colspan="2" style="background: #ffffff;"> <?php echo $sm_date; ?> </td>
	</tr>

	<tr>
		<td> Customer code  </td>
		<td> <?php echo $form->textField($model,'cm_cuscode',array('id'=>'sm_number', 'readonly'=>'readonly', 'style'=>'width:100px')); ?> </td>
		<td >Customer Name </td>
        <td colspan="5" style="background: white;"><?php echo $customerName; ?></td>
	</tr>
	
	<tr>
		<td>Total </td>
		<td style="background: white;"><?php echo $smheader['sm_totalamt'] ?>  </td>
		<td>VAT </td>
		<td style="background: white;"><?php echo $smheader['sm_total_tax_amt'] ?> </td>
		<td>Discount </td>
		<td style="background: white;"><?php echo $smheader['sm_disc_amt'] ?>  
			<input type="hidden" value="<?php echo $smheader['sm_disc_rate'] ?>" id="sm_disc_rate">
		</td>
		<td>Net </td>
		<td style="background: white;"><?php echo $smheader['sm_netamt'] ?> </td>
	</tr>

    <tr>
        <td colspan="1">Currency </td>
        <td colspan="2" style="background: white;"><?php echo $smheader['sm_currency']; ?> </td>
        <td colspan="2">Exchange Rate </td>
        <td colspan="3" style="background: white;"><?php echo $smheader['sm_exchrate']; ?> </td>
    </tr>

	<tr>
		<td colspan="1">Status </td>
		<td colspan="2" style="background: white;"><?php echo $smheader['sm_stataus']; ?> </td>
		<td colspan="2">Branch </td>
		<td colspan="3" style="background: white;"><?php echo $smheader['sm_storeid']; ?> </td>

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
            <td>Batch No</td>
            <td>Expiry Date</td>
			<td>Unit </td>
			<td>Sell Rate </td>
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
            <td><?php echo $values['sm_batchnumber']; ?> </td>
            <td><?php echo $values['sm_expdate']; ?> </td>
			<td><?php echo $values['sm_unit']; ?> </td>
			<td><?php echo $values['sm_sellrate']; ?> </td>
			<td width="60" style="text-align: center;"><?php echo $values['sm_quantity']; ?> </td>
			<td><?php echo $values['sm_tax_rate']; ?> </td>
			<td width="100" style="text-align: right;"><?php echo $values['sm_line_amt']; ?> </td>
            <td width="100" style="display: none;"><?php echo $values['sm_rate']; ?> </td>
		</tr>
		<?php } endforeach; ?>
	</tbody>
	
</table>

</div>
</div>

<table style="width: 97%; float: left; margin-top: 20px; ">
	<tr> 
		<td style="background: #4085BB; color: white; text-align: center; font-weight: bold;">Return Item (Please pick item from Item List)  </td>
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
			<th>Sell Rate</th>
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




	<br>


	<div class="row">
	<?php //echo $form->labelEx($model,'sm_doc_type'); ?>
	<?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Return', 'id'=>'sm_doc_type')); ?>
	<?php //echo $form->error($model,'sm_doc_type'); ?>
	</div>



	<table style="margin-left: 60%; margin-top: 20px;" CELLSPACING="0">
		<tr>
			<td>

				<div class="row">
				<?php echo $form->labelEx($model,'sm_totalamt'); ?>
				<?php echo $form->textField($model,'sm_totalamt',array('value'=>'0', 'id'=>'sm_totalamt','class'=>'sm_totalamt', 'readonly'=>'readonly', 'style'=>'width: 150px;')); ?>
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
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
