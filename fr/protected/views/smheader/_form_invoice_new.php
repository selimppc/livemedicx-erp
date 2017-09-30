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

table .money-receipt-sales, td, th
{
	border: 1px solid #4E8EC2;
}
#button_add{
	text-align: center;
	background: orange;
	color: white;
	cursor: pointer;
	padding: 3px 8px;
	border-radius: 3px;
	font-weight: bold;
}
#Vouhcerheader_voucher_no{
	width: 140px;
}
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sm-header-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_cuscode'),
)); ?>


<script type="text/javascript">
	var id=0;
    var addedProductCodes = [];

	$(document).ready(function(){
		$("#button_add").click(function() {
		    var tableData = $(this).closest("tr").find("td input").map(function() {
		        return $(this).val();
		    }).get();

		    var product_name = $.trim(tableData[0]);
			var code = $.trim(tableData[1]);
			var sellRate = Math.round(($.trim(tableData[2]))*100)/100;
			var taxRate = Math.round(($.trim(tableData[3]))*100)/100;
			var quantity = Math.round(($.trim(tableData[4]))*100)/100;
			var unit = $.trim(tableData[5]);
			var total = Math.round(($.trim(tableData[6]))*100)/100;
			var available = $.trim(tableData[8]);

			var sm_totalamt = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
			var sm_total_tax_amt = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
			var total_tax_amt = Math.round(((taxRate * total)/100)*100)/100;
			//var sm_disc_rate = document.getElementById("sm_disc_rate").value;
			//var sm_disc_amt = document.getElementById("sm_disc_amt").value;
			var sm_netamt = Math.round((document.getElementById("sm_netamt").value)*100)/100;
			id=id+1;

            var td_productCode = $.trim(tableData[1]);
            var index = $.inArray(td_productCode, addedProductCodes);

            if (index >= 0) {
                alert("You already added this Product");
                exit;
            }

			if(quantity == "" || product_name == ""){	
					alert("Please Add Product or Quantity !!!");
					exit;

				}else{
					$("#test").append(
							"<tr><td><input type='' value='"+ product_name +"'  readonly></td><td><input type='' name='cm_code[]' value='"+ code +"' style='width: 100px' readonly></td><td><input type='' id='sellRate_"+id+"' name='sm_rate[]' value='"+ sellRate +"' style='width: 100px' readonly></td><td><input type='' name='sm_tax_rate[]' id='taxRate_"+id+"' value='"+ taxRate +"' style='width: 100px' readonly></td><td><input name='sm_quantity[]' value='"+ quantity +"'  style='width: 100px' readonly></td><td><input type='' name='sm_unit[]' value='"+ unit +"' style='width: 100px' readonly></td><td><input type='' name='sm_lineamt[]' id='price_"+id+"' price='"+ total +"' value='"+ total +"' style='width: 100px' readonly ></td><td><span onclick='deleteRow(\"" + sellRate + "\", \"" + taxRate + "\", \"" + quantity + "\", this)' style='background:orange; color:white; border-radius: 3px; cursor: pointer; padding: 1px 3px; margin-left: 5px;' id='delete_button'> x </span></td></tr>"
							);	

					document.getElementById("sm_totalamt").value = Math.round((sm_totalamt + total)*100)/100;
					document.getElementById("sm_total_tax_amt").value = Math.round((sm_total_tax_amt + total_tax_amt)*100)/100;
					document.getElementById("sm_netamt").value = Math.round((sm_netamt + total + total_tax_amt)*100)/100;

					document.getElementById("product_name").value = "";
					document.getElementById("quantity_a").value = "";
					document.getElementById("code").value = "";
					document.getElementById("sell_rate").value = "";
					document.getElementById("tax_rate").value = "";
					document.getElementById("unit_a").value = "";
					document.getElementById("total").value = "0.00";
                    document.getElementById("available").value = "";
	
			}
            addedProductCodes.push(td_productCode);
		});
	});

	function primeMultiply(){
		var quantity_a = document.getElementById("quantity_a").value;
		var total_a = document.getElementById("total_a").value;

		var available = document.getElementById("available").value;

		if(parseInt(quantity_a) > parseInt(available)){
				alert("Product Quantity is not Available! Available Quantity is: " + available );
				document.getElementById("quantity_a").value = " ";
				exit;
			}else{
				var total = Math.round((quantity_a * total_a)*100)/100;		
				document.getElementById("total").value = total;
			}
		
	}

    function rateMultiply(){

        var quantity_a = document.getElementById("quantity_a").value;
        var total_a = document.getElementById("total_a").value;

        var sell_rate = Math.round((document.getElementById("sell_rate").value)*100)/100;
        document.getElementById("total_a").value = sell_rate;

        var total = Math.round((quantity_a * sell_rate)*100)/100;
        document.getElementById("total").value = total;

    }


	function discoutnRate(){
		//var total = Math.round((document.getElementById("sm_netamt").value)*100)/100;
        var total = Math.round((document.getElementById("sm_totalamt").value)*100)/100;

		var disc = Math.round((document.getElementById("sm_disc_rate").value)*100)/100;
		var discountamount = Math.round((total * disc / 100)*100)/100; 
		
		document.getElementById("sm_disc_amt").value = discountamount;
		
		var totalamt = Math.round((document.getElementById("sm_netamt").value)*100)/100;
		var netamt = Math.round((totalamt - discountamount)*100)/100;
		document.getElementById("sm_netamt").value = netamt;
		
	}
	function discoutnAmount(){

		var discamt11 = Math.round((document.getElementById("sm_disc_amt").value)*100)/100;
        var totalamt = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
        var sm_total_tax_amt = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;

		var netamt11 = Math.round(( (totalamt - discamt11) + sm_total_tax_amt )*100)/100;

		document.getElementById("sm_netamt").value = netamt11;
	}

	$(document).ready(function(){
		$('#sm_disc_rate').change(function(){
			var dueamt = document.getElementById("sm_disc_rate").value;

			if(dueamt >= 0 ){
				$("#sm_disc_amt").prop('readonly', true);
                $("#sm_disc_rate").prop('readonly', true);
			}else{
				$("#sm_disc_rate").prop('readonly', true);
                $("#sm_disc_amt").prop('readonly', true);
			}
			});

        $('#sm_disc_amt').change(function(){
            var dueamt = document.getElementById("sm_disc_rate").value;
            var disc_amt = document.getElementById("sm_disc_amt").value;

            if(disc_amt >= 0 ){
                $("#sm_disc_amt").prop('readonly', true);
                $("#sm_disc_rate").prop('readonly', true);
            }else{
                $("#sm_disc_rate").prop('readonly', true);
                $("#sm_disc_amt").prop('readonly', true);
            }
        });
	});

	function deleteRow(sellRate, taxRate, quantity, row)
	{
		$(row).closest('tr').remove();

		var sellRate = Math.round((sellRate)*100)/100;
		var taxRate = Math.round((taxRate)*100)/100;
		var quantity = Math.round((quantity)*100)/100;
		
		var total= Math.round((document.getElementById("sm_totalamt").value)*100)/100;
		var Rate = Math.round((sellRate * quantity)*100)/100;
		total = Math.round((total - Rate)*100)/100;

		var tax1 = Math.round((document.getElementById("sm_total_tax_amt").value)*100)/100;
		var tax2 = Math.round((sellRate * taxRate * quantity / 100)*100)/100;
		taxamount = Math.round((tax1 - tax2)*100)/100;

		var sm_netamt = Math.round((document.getElementById("sm_netamt").value)*100)/100;
		sm_netamt = Math.round((sm_netamt - (Rate + (sellRate * taxRate * quantity / 100) ))*100)/100;
		
		document.getElementById("sm_totalamt").value = Math.round((total)*100)/100;
		document.getElementById("sm_total_tax_amt").value = taxamount;
		document.getElementById("sm_netamt").value = sm_netamt;
	}

</script>

<div>
    <h4 style="background: #FFCCFF; padding: 7px; width: 69.5%; font-weight: normal; border-radius: 5px;">
        <b>Sales Invoice</b>: Fill in Sales Invoice Header information.
    </h4>
	<table>
		<tr> 
			<td colspan="4" style="text-align: center; background: #4085BB; color: white;"> 
				<b> Sales Invoice </b>
			</td>
		</tr>
		
		<tr>
			<td> <?php echo $form->labelEx($model,'sm_number'); ?> </td>
			<td> <?php echo $form->textField($model,'sm_number',array('id'=>'sm_number', 'readonly'=>'readonly')); ?> </td>
			<td> <?php echo $form->labelEx($model,'sm_date'); ?> </td>
			<td> <?php echo $form->textField($model,'sm_date', array('id'=>'sm_date', 'readonly'=>'readonly')); ?> </td>
		</tr>
		
		<tr>
			<td> <?php echo $form->labelEx($model,'cm_cuscode'); ?> </td>
            <td>
                <?php echo CHtml::activeDropDownList($model, 'cm_cuscode', CHtml::listData(Customermst::model()->findAll(array('order'=>'cm_name ASC')), 'cm_cuscode', 'cm_name'),  array('empty'=>'- Select Customer -', 'required'=>TRUE) ); ?>
            </td>
            <td> <?php echo $form->labelEx($model,'sm_payterms'); ?> </td>
            <td> <?php echo $form->dropDownList($model,'sm_payterms', array('Cash'=>'Cash','Credit'=>'Credit'), array('id'=>'sm_payterms')); ?> </td>
			<!-- <td>
				 <?php /* $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
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
                            'required'=>'required',
						),
					)); */ ?>
			</td>
			<td> Customer Name </td>
			<td> <span id="customer_name"></span> </td> -->
		</tr>
		
		<tr>
			<td> <?php echo $form->labelEx($model,'sm_currency'); ?> </td>
			<td>
                <?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
                echo $form->dropDownList($model,'sm_currency', $currency, array('empty'=>'- Choose Currency -', 'required'=>TRUE,

                    'ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('purchaseordhd/GetExchangeRate' ),
                        //'success'=>'js:function(data){$("#currencyid").val(data);}',
                        'update' => '#exchange_rate',
                        'data'=>array('store'=>'js:this.value',),
                        'success'=> 'function(data) {$("#exchange_rate").empty();
                    $("#exchange_rate").val(data);
                    } ',
                    ),

                ));  ?>
            </td>
			<td> <?php echo $form->labelEx($model,'sm_exchrate'); ?> </td>
			<td> <?php echo $form->textField($model,'sm_exchrate',array('id'=>'exchange_rate', 'placeholder'=>'0.00', 'style'=>'width: 200px;' )); ?> </td>
		</tr>
		
		<tr>
			<td> <?php echo $form->labelEx($model,'product_class'); ?> </td>
			<td> <?php echo $form->dropDownList($model,'product_class', CHtml::listData(Codesparam::model()->findAll('cm_type = "Product Class"'),'cm_code', 'cm_code'), array('id'=>'productClass')); ?> </td>
			<td> Sale from Warehouse <?php //echo $form->labelEx($model,'sm_storeid'); ?> </td>
			<td> <?php echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('id'=>'warehouse', 'style'=>'width: 200px;')); ?>
				 <?php //echo $form->textField($model,'sm_storeid', array('id'=>'sm_storeid', 'readonly'=>true)); ?>
			</td>
		</tr>
	
	</table>	
</div>
			<div class="row">
				<?php //echo $form->labelEx($model,'sm_doc_type'); ?>
				<?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Sales', 'id'=>'sm_doc_type')); ?>
				<?php //echo $form->error($model,'sm_doc_type'); ?>
			</div>

<br>

<div>
    <h4 style="background: #FFCCFF; padding: 7px; width: 90%; font-weight: normal; border-radius: 5px;">
        <span style="color: #008000"> <b>Instruction </b></span> ** : Item for Sales: Under <b>"Product Name"</b> column, you can add item by typing product name or code in the search field. <b>"Code"</b>, <b>"Sell Rate"</b>, <b>"Tax Rate"</b>, <b>"Unit"</b> will appear automatically. By inputting quantity, total amount will appear under <b>"Total</b> Column. Now Click Orange Button <b style="background:orange; color: white; padding: 0px 3px;">Add</b> under the <b>Action</b> column for Invoice. You can add multiple items.

    </h4>
	<table style="width: 91%;">
		<tr> 
			<td style="width: 90%; text-align: center; background: #4085BB; color: white;">
				<b>Item Details</b>
			</td>
		</tr>
	</table>
</div>

<div>	
	<table>	
		<thead>
			<tr>
				<th> Product Name </th>
				<th> Code </th>
				<th> Sell Rate </th>
				<th> Tax Rate </th>
				<th> Quantity </th>
				<th> Unit </th>
				<th> Total </th>
				<th> Action </th>
			</tr>
		</thead>
		
		<tbody>
			<tr> 
				<td> 
					<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'name'=>'product_name',
							'model'=>$model,
							//'source'=>CController::createUrl('/smheader/autocompleteTestNew'),
                            'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('smheader/autocompleteTestNew').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        productClass: $("#productClass").val(),
                                        warehouse: $("#warehouse").val(),
                                    },
                                    success: function (data) {
                                            response(data);
                                    }
                                })
                             }',
							'options'=>array(
								'minLength'=>'1', 
								'select'=>'js:function( event, ui ) {
										$("#product_name").text(ui.item.label);
										$("#code").val(ui.item.code);
										$("#sell_rate").val(ui.item.rate);
										$("#tax_rate").val(ui.item.tax);
										$("#unit_a").val(ui.item.unit);
										$("#total_a").val(ui.item.rate);
										$("#available").val(ui.item.available);

			                         }',
							),
							'htmlOptions'=>array(
								'id'=>'product_name',
								'placeholder'=>'search by product name or code',
								//'style' => 'width: 96%; padding: 8px; margin-bottom: 10px; border: 1px solid orange;',
								//'onClick' => 'document.getElementById("cm_code").value= ""',
							),
						));?>
				</td>
				
				<td> <input id="code" style="width: 100px; padding: 3px;" readonly="readonly"/> </td>
				<td> <input id="sell_rate" style="width: 100px; padding: 3px;" onchange="rateMultiply()" /> </td>
				<td> <input id="tax_rate" style="width: 100px; padding: 3px;" /> </td>
				<td> <input id="quantity_a" style="width: 100px; padding: 3px; text-align: center;" onchange="primeMultiply()" placeholder="0" /> </td>

				<td> <input id="unit_a" style="width: 100px; padding: 3px;" readonly="readonly"/> </td>
				<td> <input id="total" value="0.00" style="width: 100px; padding: 3px; text-align: right;" readonly="readonly"/> 
					 <input type="hidden" id="total_a" style="width: 100px; padding: 3px;" readonly="readonly"/>

					
				</td>
				<td> <span id="button_add"> Add </span> </td>
			</tr>
		</tbody>
	</table>
    <div style="color: darkorange; font-style: italic; ">
        <label style="width: 160px;"> <b>Available Quantity </b>: </label>
        <b><input id="available" style="width: 100px; padding: 3px; background: none;color: darkorange; font-weight: bold; font-size: 14px;" readonly="readonly" /> </b>
    </div>

</div>
<br>

<div style="float: left">
	<table>
		<tbody id="test">
		</tbody>
	</table>
</div>

<div>
    <h4 style="margin-left: 58%; background: #FFCCFF; padding: 7px; width: 290px; font-weight: bold; border-radius: 5px;">
        Break Down of Invoice Amount
    </h4>
	<table style="margin-left: 58%; margin-top: 6px;"  CELLSPACING ="0">
		<tr> 
			 <td> <b>Invoice Amount: </b> <?php //echo $form->labelEx($model,'sm_totalamt'); ?> </td>
			 <td> <?php echo $form->textField($model,'sm_totalamt',array('value'=>'0', 'id'=>'sm_totalamt','class'=>'sm_totalamt', 'readonly'=>'readonly', 'style'=>'width: 148px;')); ?> </td>
		</tr>	 

		<tr> 
			 <td> <?php echo $form->labelEx($model,'sm_disc_rate'); ?> </td>
			 <td> <?php echo $form->textField($model,'sm_disc_rate',array('id'=>'sm_disc_rate','class'=>'sm_disc_rate', 'onchange' => 'discoutnRate();', 'placeholder'=>'0')); ?> </td>
		</tr>
		<tr> 
			 <td> <?php echo $form->labelEx($model,'sm_disc_amt'); ?> </td>
			 <td> <?php echo $form->textField($model,'sm_disc_amt',array('id'=>'sm_disc_amt','class'=>'sm_disc_amt', 'onchange' => 'discoutnAmount();', 'placeholder'=>'0')); ?> </td>
		</tr>

        <tr>
            <td> <label>Tax Amount</label> </td>
            <td> <?php echo $form->textField($model,'sm_total_tax_amt',array('value'=>'0', 'id'=>'sm_total_tax_amt','class'=>'sm_total_tax_amt', 'readonly'=>'readonly')); ?> </td>
        </tr>
        
		<tr>
			 <td> <label>Total Amount</label> </td>
			 <td> <?php echo $form->textField($model,'sm_netamt',array('value'=>'0', 'id'=>'sm_netamt','class'=>'sm_netamt', 'readonly'=>'readonly')); ?> </td>
		</tr>

	</table>
</div>

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