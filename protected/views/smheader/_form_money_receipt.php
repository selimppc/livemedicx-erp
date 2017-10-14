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

		    var total = Math.round((document.getElementById("sm_totalamt").value)*100)/100;

		    var value = Math.round(($.trim(tableData[1]))* 100 )/100;	
			
		    var preBalance = Math.round((document.getElementById("balance").value)*100)/100 ;    
		    
		    var td_productCode = $.trim(tableData[0]);
		    
			var index = $.inArray(td_productCode, addedProductCodes);
			if (index >= 0) {
				alert("You already added this Product");
				exit;
			} else {
				    if ( preBalance >= value ){
				    	$("#test").append(
					    		"<tr><td><input name='sm_invnumber[]' value='"+ $.trim(tableData[0]) +"' style='width: 97%;' readonly ></td><td><input name='sm_amount[]' value='"+ value +"' style='width: 97%; text-align: right;' readonly ></td><td><input name='' value='"+ $.trim(tableData[2]) +"' style='width: 97%;' readonly ></td><td><input name='' value='"+ $.trim(tableData[3]) +"' style='width: 97%;text-align: right;' readonly ></td></tr>");
		
				    	var balance = Math.round( (preBalance - value) * 100)/100;
				    	document.getElementById("balance").value = balance;
				    	document.getElementById("sm_totalamt").value = Math.round( (value + total)* 100)/100;
		
					}else if (preBalance < value && preBalance!=0){

						$("#test").append(
					    		"<tr><td><input name='sm_invnumber[]' value='"+ $.trim(tableData[0]) +"' style='width: 97%;' readonly ></td><td><input name='sm_amount[]' value='"+ preBalance +"' style='width: 97%; text-align: right;' readonly ></td><td><input name='' value='"+ $.trim(tableData[2]) +"' style='width: 97%;' readonly ></td><td><input name='' value='"+ $.trim(tableData[3]) +"' style='width: 97%; text-align: right;' readonly ></td></tr>");

						var balance = Math.round( (preBalance - preBalance)*100)/100;
						document.getElementById("balance").value = balance;
						document.getElementById("sm_totalamt").value = total + preBalance ;
		
					}else{
						alert("Amount is not sufficient");
						exit;
					}

				    addedProductCodes.push(td_productCode);
			}

		});
	});
	
	function deleteRow(value, row)
	{
		$(row).closest('tr').remove();

		var preTotal =document.getElementById("sm_totalamt").value;
		total = preTotal - value;
		document.getElementById("sm_totalamt").value = total;
	}

	function balanceAmount(){
        var invoice_total_amount = Math.round((document.getElementById("invoice_total_amount").innerHTML)*100)/100;
		var amount = Math.round((document.getElementById("cm_net_amount").value)*100)/100;

        if(amount > invoice_total_amount){
            alert("Amount is bigger than Invoice Amount");
            document.getElementById("cm_net_amount").value = '';
            exit;
        }else{
            document.getElementById("balance").value = amount;
        }
	}
</script>
<div style="width: 50%; float: left;">

<table class="money-receipt-sales">
	<tr>
		<td colspan="4" style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> Money Receipt </td>
	</tr>
	
	<tr> 
		<td> Receipt Number: &nbsp;&nbsp;</td>  
		<td> <?php echo $form->textField($model,'sm_number',array('id'=>'sm_number', 'readonly'=>'readonly', 'style'=>'width: 120px;')); ?></td>
		<td> Date: &nbsp;&nbsp;</td> 
		<td><?php echo $form->textField($model,'sm_date', array('id'=>'sm_date', 'readonly'=>'readonly', 'style'=>'width: 120px;')); ?></td>
	</tr>
	
	<tr> 
		<td> Customer: &nbsp;&nbsp;</td>  
		<td> <?php echo $form->textField($model,'cm_cuscode',array('id'=>'cm_cuscode', 'readonly'=>'readonly', 'style'=>'width: 120px;')); ?></td>
		<td colspan="2" style="background: white;"> <?php echo $cname; ?> </td> 

	</tr>
	
	<tr> 
		<td> Bank/Cash: &nbsp;&nbsp;</td>

		<td colspan="3"> <?php //echo $form->textField($model,'am_accountcode', array('id'=>'sm_number', 'style'=>'width: 120px;')); ?>
            <?php echo $form->dropDownList($model,'am_accountcode', CHtml::listData(Chartofaccounts::model()->findAll(array('order'=>'am_description ASC')), 'am_accountcode', 'am_description'), array('empty'=>'- Select Account -', 'required'=>TRUE, 'style'=>'width: 358px;')); ?>
				<?php 
				/* $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'name'=>'am_accountcode',
					'model'=>$model,
					'attribute'=>'am_accountcode',
					'source'=>CController::createUrl('/smheader/AutocompleteBankCash'),
					'options'=>array(
						'minLength'=>'1', 
						'select'=>'js:function(event, ui){
							$("#am_accountcode").text(ui.item.value);
							$("#bank_cash_desc").text(ui.item.label);
						}'
					),
					'htmlOptions'=>array(
						'id'=>'am_accountcode',
						'placeholder'=>'search by account',
						'required'=>'required',
						'style'=>'width: 120px;',
					),
				)); */
			?> 
		</td>

	</tr>
	
	<tr> 
		<td>Check No: &nbsp;&nbsp;</td>  
		<td> <?php echo $form->textField($model,'sm_chequeno',array('id'=>'check_no', 'placeholder'=>'type check no', 'style'=>'width: 120px;')); ?></td>
		<td> Amount: &nbsp;&nbsp;</td> 
		<td> <?php echo $form->textField($model,'sm_netamt',array('placeholder'=>'0.00', 'required'=>TRUE, 'id'=>'cm_net_amount', 'onchange' => 'balanceAmount();', 'style'=>'width: 120px; text-align: right;')); ?>
		<input type="hidden" id="balance" value="0" style="width: 50px;">
		</td>
	</tr>

    <tr>
        <td> Currency: </td>
        <td>
            <?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
            echo $form->dropDownList($model,'sm_currency', $currency, array('empty'=>'- Choose Currency -', 'required'=>TRUE, 'style'=>'width: 140px',

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
        <td> Exchange Rate </td>
        <td> <?php echo $form->textField($model,'sm_exchrate',array('id'=>'exchange_rate', 'placeholder'=>'0.00', 'style'=>'width: 120px;' )); ?> </td>
    </tr>

    <tr>
        <td>Status: &nbsp;&nbsp;</td>
        <td><?php echo $form->textField($model,'sm_stataus',array('value'=>'Open','readonly'=>'readonly','style'=>'width: 120px;')); ?> </td>
        <td> Branch</td>
        <td> <?php //echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('empty'=>'- Select Branch -', 'required'=>TRUE, 'style'=>'width: 120px;')); ?>
            <?php echo $form->textField($model,'sm_storeid', array('readonly'=>TRUE, 'required'=>TRUE, 'style'=>'width: 120px;')); ?>
        </td>
        <?php //echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_branch'), array('id'=>'sm_storeid')); ?>
    </tr>

	<tr> 
		<td>Note : &nbsp;&nbsp;</td>
		<td colspan="3" style="background: white;"><input></td>
	</tr>
	

	
</table>
</div>

<div style="width: 40%; float: left;">

	<table style="width: 95%; margin-bottom: 30px;">
		<tr>
			<td colspan="4" style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> Unpaid Invoice List of - <?php echo $cname; ?> </td>
		</tr>
		<tr>
			<td>
				<table>
					<thead>
						<tr>
							<th width="105">Invoice No</th>
							<th width="105">Receivable Amount</th>
                            <th width="105">Currency</th>
                            <th width="105">Exch. Rate</th>
						</tr>
					</thead>

					<tbody class="items">
						<?php  foreach($mralc as $values): { ?>
							<tr style="background: white;">
								<td><?php echo $values['sm_invnumber']; ?></td>
								<td style="text-align: right;"><?php echo $values['sm_amount']; ?></td>
                                <td><?php echo $values['sm_currency']; ?></td>
                                <td style="text-align: right;"><?php echo $values['sm_exchrate']; ?></td>
							</tr>
						<?php } endforeach; ?>

					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td style="text-align: right;"> Total: <span id="invoice_total_amount"><?php echo $ramt; ?> </span> </td>
		</tr>
	</table>
	
	<table style="width: 95%; margin-bottom: 30px;">	
		<tr>
			<td colspan="4" style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> Allocated Invoice</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">
				<table>
					<thead>
						<tr>
							<th width="105">Invoice No</th>
							<th width="105">Amount</th>
                            <th width="105">Currency</th>
                            <th width="105">Exch. Rate</th>
						</tr>
					</thead>

					<tbody id="test">
						<tr>
							<td> </td>
							<td> </td>
                            <td> </td>
                            <td> </td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>




	<table style="width: 95%;">
		<tr>
			<td>

				<div class="row">
				<?php echo $form->labelEx($model,'total_amount_', array('style'=>'font-weight: bold;')); ?>
				<?php echo $form->textField($model,'total_amount_',array('value'=>'0', 'id'=>'sm_totalamt','class'=>'sm_totalamt', 'readonly'=>'readonly', 'style'=>'width: 200; font-weight: bold;')); ?>
				<?php //echo $form->error($model,'total_amount_header'); ?>
				</div>
			</td>
		</tr>
	</table>

</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'sm_doc_type'); ?>
	<?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Receipt', 'id'=>'sm_doc_type')); ?>
	<?php //echo $form->error($model,'sm_doc_type'); ?>
	</div>

	<div class="row">
	<?php //echo $form->labelEx($model,'sm_sign'); ?>
	<?php echo $form->hiddenField($model,'sm_sign', array('value'=>'-1', 'readonly'=>'readonly')); ?>
	<?php //echo $form->error($model,'sm_sign'); ?>
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
	<?php echo $form->hiddenField($model,'insertuser'); ?>
	<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
	<?php // echo $form->labelEx($model,'updateuser'); ?>
	<?php echo $form->hiddenField($model,'updateuser'); ?>
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
