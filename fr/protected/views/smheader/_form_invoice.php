<?php
/* @var $this SmheaderController */
/* @var $model Smheader */
/* @var $form CActiveForm */
?>
<style type="text/css" >
tbody #test tr td .close-button{
	background: none repeat scroll 0 0 #FF9900;
    border: medium none;
    border-radius: 5px;
    color: #FFFFFF;
    cursor: pointer;
    padding: 0px 5px;
}
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sm-header-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_cuscode'),
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php // echo $form->errorSummary($model); ?>


<script type="text/javascript">
	var id=0;
	var addedProductCodes = [];
	
	function getProductData(label,code,rate,unit,available,tax){

		var total_re = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
		var rate =  Math.round((rate)*100)/100;
		id=id+1;
		var total = Math.round((total_re + rate)*100)/100;
		
		var tax1 = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
		taxamount = Math.round((tax1 + (rate * tax / 100))*100)/100;

			var td_productCode = code;
			var index = $.inArray(td_productCode, addedProductCodes);
			if (index >= 0) {
					alert("You already added this Product");
				} else {
					//$('#test tr:last').after("<tr><td><input type='' value='"+ label +"' class='sales-product-input-name' readonly></td><td><input type='' name='cm_code[]' value='"+ td_productCode +"' class='sales-product-code'></td><td><input type='' name='sm_rate[]' value='"+ rate +"' class='sales-product-input-rate' readonly></td><td><input type='' name='sm_unit[]' value='"+ unit +"' class='sales-product-input-unit' readonly></td><td><input name='sm_quantity[]' onKeyup='price_multiply(this.id)' id='"+id+"' value='1' class='sales-product-input-quantity'></td><td><input type='' id='available_"+id+"' value='"+ available +"' class='sales-product-input-instock' readonly></td><td><input type='' name='sm_tax_rate[]' value='"+ tax +"' class='sales-product-input-tax' readonly></td><td><input type='' name='sm_lineamt[]' id='price_"+id+"' price='"+ rate +"' value='"+ rate +"' class='sales-product-input-line-amount' readonly ></td></tr>");
					
					$('#test tr:last').after("<tr><td><input type='' value='"+ label +"' class='sales-product-input-name' readonly></td><td><input type='' name='cm_code[]' value='"+ td_productCode +"' class='sales-product-code' readonly></td><td><input type='' id='rate_"+id+"' name='sm_rate[]' value='"+ rate +"' class='sales-product-input-rate' readonly></td><td><input type='' name='sm_unit[]' value='"+ unit +"' class='sales-product-input-unit' readonly></td><td><input name='sm_quantity[]' onChange='price_multiply(this.id)' id='"+id+"' value='1' class='sales-product-input-quantity'></td><td><input type='' id='available_"+id+"' value='"+ available +"' class='sales-product-input-instock' readonly></td><td><input type='' name='sm_tax_rate[]' id='tax_"+id+"' value='"+ tax +"' class='sales-product-input-tax' readonly></td><td><input type='' name='sm_lineamt[]' id='price_"+id+"' price='"+ rate +"' value='"+ rate +"' class='sales-product-input-line-amount' readonly ></td><td><span onclick='deleteRow(\"" + rate + "\", \"" + unit + "\", \"" + tax + "\", this)' style='background:orange; color:white; border-radius: 3px; cursor: pointer; padding: 1px 3px; margin-left: 5px;' id='delete_button'> x </span></td></tr>");
				
					addedProductCodes.push(td_productCode);

				}
			document.getElementById("sm_totalamt").value = total;
			document.getElementById("sm_total_tax_amt").value = taxamount;
			document.getElementById("sm_netamt").value = Math.round(( total + taxamount)*100)/100;
			
			applyColor();
	}
	function discoutnRate(){
		var total = Math.round((document.getElementById("sm_netamt").value)*100)/100;
		var disc = Math.round((document.getElementById("sm_disc_rate").value)*100)/100;
		var discountamount = Math.round((total * disc / 100)*100)/100; 
		
		document.getElementById("sm_disc_amt").value = discountamount;
		
		var totalamt = Math.round((document.getElementById("sm_netamt").value)*100)/100;
		var netamt = Math.round((totalamt - discountamount)*100)/100;
		document.getElementById("sm_netamt").value = netamt;
		
	}
	function discoutnAmount(){
		var discamt11 = Math.round((document.getElementById("sm_disc_amt").value)*100)/100;
		var totalamt = Math.round((document.getElementById("sm_netamt").value)*100)/100;
		var netamt11 = Math.round(( totalamt - discamt11)*100)/100;

		document.getElementById("sm_netamt").value = netamt11;
	}

	$(document).ready(function(){
		$('#sm_disc_rate').change(function(){
			var dueamt = document.getElementById("sm_disc_rate").value;
			if(dueamt > 0 ){
				$("#sm_disc_amt").prop('readonly', true);
			}else{
				$("#sm_disc_rate").prop('readonly', true);
			}
			});
	});
	
	function applyColor(){	

		$('#test [id^="available_"]').each(function(){

			   var closestTd = $(this).closest('td');
			   var valueCache = parseInt($(this).val());
			   
			   if(valueCache > 20) {
			      closestTd .addClass('positive');
			   }
			   else if(valueCache <= 20) {
			      closestTd.addClass('negative');
			   }else {
				      //Apply any color as per your wish for value = 0;
				}
		});
	}


	function price_multiply(id){

		var t_total = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
		var c_price = Math.round((document.getElementById("price_"+id).value)*100)/100;
		var c_total = Math.round((t_total - c_price)*100)/100;
		
		var availqty = document.getElementById("available_"+id).value;
		var getqty = document.getElementById(id).value;
		
		if( parseInt(getqty) > parseInt(availqty) ){
				alert("Product is not available");
				exit;
		}else{
				var getprice = Math.round((document.getElementById("price_"+id).getAttribute("price"))*100)/100;
				//var getqty = document.getElementById(id).value;
				var new_value = Math.round((parseInt(getprice) * parseInt(getqty))*100)/100;
				document.getElementById("price_"+id).value = new_value;
				
				document.getElementById("sm_totalamt").value = Math.round((c_total + parseInt(new_value))*100)/100;

				var tax1 = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
				var tax = Math.round((document.getElementById("tax_"+id).value)*100)/100;
				var rate = Math.round((document.getElementById("rate_"+id).value)*100)/100;
				var mtax = Math.round((parseInt(tax1) - (parseInt(rate) * parseInt(tax)/100))*100)/100;
				
				var taxamount = Math.round((parseInt(mtax)+(parseInt(new_value) * parseInt(tax)/100))*100)/100 ;
				
				document.getElementById("sm_total_tax_amt").value = taxamount;
				document.getElementById("sm_netamt").value = c_total + new_value + taxamount;	

				// To disable:    
				document.getElementById('delete_button').style.pointerEvents = 'none';
				
				
			}
	}

	function deleteRow(rate, unit, tax, row)
	{
		$(row).closest('tr').remove();
		
		var total= Math.round((document.getElementById("sm_totalamt").value)*100)/100;
		total = Math.round((total - rate)*100)/100;

		var tax1 = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
		taxamount = Math.round((tax1 - (rate * tax/100))*100)/100;
		
		document.getElementById("sm_totalamt").value = total;
		document.getElementById("sm_total_tax_amt").value = taxamount;
		document.getElementById("sm_netamt").value = total - taxamount;
	}
	
</script>

<table>
	<tr>
		<td style="width: 38%; "> 
			<div class="row">
				<?php echo $form->labelEx($model,'sm_number'); ?>
				<?php echo $form->textField($model,'sm_number',array('id'=>'sm_number', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_number'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'sm_date'); ?>
				<?php echo $form->textField($model,'sm_date', array('id'=>'sm_date', 'readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_date'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'cm_cuscode'); ?>
				<?php // echo $form->textField($model,'cm_cuscode',array('placeholder'=>'search by customer name')); ?>
				<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'name'=>'cm_cuscode',
							'model'=>$model,
							'attribute'=>'cm_cuscode',
							'source'=>CController::createUrl('/smheader/customercode'),
							'options'=>array(
								'minLength'=>'1', 
								'select'=>'js:function(event,ui) {
										$("#cm_cuscode12").val(ui.item.value);
										$("#customer_name").text(ui.item.label);
										$("#sp_name").val(ui.item.sp);
			                         }'
							),
							'htmlOptions'=>array(
								'id'=>'cm_cuscode12',
								'placeholder'=>'search by customer name',
							),
						)); ?>
				<?php echo $form->error($model,'cm_cuscode'); ?>
				<span id="customer_name"></span>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'sm_sp'); ?>
				<?php echo $form->textField($model,'sm_sp',array('id'=>'sp_name','readonly'=>'readonly')); ?>
				<?php echo $form->error($model,'sm_sp'); ?>
			</div>
		
			<div class="row">
				<?php //echo $form->labelEx($model,'sm_doc_type'); ?>
				<?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Sales', 'id'=>'sm_doc_type')); ?>
				<?php //echo $form->error($model,'sm_doc_type'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'sm_storeid'); ?>
				<?php echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('id'=>'sm_storeid')); ?>
				<?php echo $form->error($model,'sm_storeid'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'sm_payterms'); ?>
				<?php echo $form->dropDownList($model,'sm_payterms', array('Cash'=>'Cash','Credit'=>'Credit'), array('id'=>'sm_payterms')); ?>
				<?php echo $form->error($model,'sm_payterms'); ?>
			</div>
		</td>
		
		<td> &nbsp; </td>
		<td> &nbsp; </td>
		
		<td> 
			<div class="row">
				<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'name'=>'product_name',
							'model'=>$model,
							'source'=>CController::createUrl('/smheader/autocompletetest'),
							'options'=>array(
								'minLength'=>'1', 
								'select'=>'js:function( event, ui ) {
										$("#cm_code").val("");
			                              getProductData(ui.item.label,ui.item.code,ui.item.rate,ui.item.unit,ui.item.available,ui.item.tax);
			                              return false;
			                         }',
							),
							'htmlOptions'=>array(
								'id'=>'cm_code',
								'placeholder'=>'search by product name',
								'style' => 'width: 96%; padding: 8px; margin-bottom: 10px; border: 1px solid orange;',
								'onClick' => 'document.getElementById("cm_code").value= ""',
							),
						));?>
			</div>	
		
			<table>
				<thead style="text-align: left;">
					 <tr>
					 	<th style="width: 145px"> Name</th>
						<th style="width: 65px"> Code </th>
					 	<th style="width: 85px"> Rate </th>
					 	<th style="width: 65px"> Unit </th>
					 	<th style="width: 65px"> Quantity </th>
					 	<th style="width: 65px"> In Stock </th>
					 	<th style="width: 65px"> Tax </th>
					 	<th style="width: 85px"> Line Amount </th>
					 </tr>
				 </thead>
				 
				 <tbody  id="test">
				 	<tr>
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

			<table style="margin-left: 47%; margin-top: 20px;"  CELLSPACING ="0">
				<tr> 
					 <td>
					 		
						<div class="row">
							<?php echo $form->labelEx($model,'sm_totalamt'); ?>
							<?php echo $form->textField($model,'sm_totalamt',array('value'=>'0', 'id'=>'sm_totalamt','class'=>'sm_totalamt', 'readonly'=>'readonly', 'style'=>'width: 148px;')); ?>
							<?php echo $form->error($model,'sm_totalamt'); ?>
						</div>
					
						<div class="row">
							<?php echo $form->labelEx($model,'sm_total_tax_amt'); ?>
							<?php echo $form->textField($model,'sm_total_tax_amt',array('value'=>'0', 'id'=>'sm_total_tax_amt','class'=>'sm_total_tax_amt', 'readonly'=>'readonly')); ?>
							<?php echo $form->error($model,'sm_total_tax_amt'); ?>
						</div>
					
						<div class="row">
							<?php echo $form->labelEx($model,'sm_disc_rate'); ?>
							<?php echo $form->textField($model,'sm_disc_rate',array('id'=>'sm_disc_rate','class'=>'sm_disc_rate', 'onchange' => 'discoutnRate();', 'placeholder'=>'0')); ?>
							<?php echo $form->error($model,'sm_disc_rate'); ?>
						</div>
					
						<div class="row">
							<?php echo $form->labelEx($model,'sm_disc_amt'); ?>
							<?php echo $form->textField($model,'sm_disc_amt',array('id'=>'sm_disc_amt','class'=>'sm_disc_amt', 'onchange' => 'discoutnAmount();', 'placeholder'=>'0')); ?>
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
		</td>
	</tr>
</table>
	<div class="row">
		<?php //echo $form->labelEx($model,'sm_refe_code'); ?>
		<?php echo $form->hiddenField($model,'sm_refe_code',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'sm_refe_code'); ?>
	</div>
	

	

	<div class="row">
		<?php //echo $form->labelEx($model,'sm_sign'); ?>
		<?php echo $form->hiddenField($model,'sm_sign', array('value'=>'1', 'readonly'=>'readonly')); ?>
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

</div><!-- form -->