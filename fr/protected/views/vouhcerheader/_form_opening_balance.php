<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */
/* @var $form CActiveForm */
?>
<style type="text/css">
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
}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vouhcerheader-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'am_vouchernumber'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<table>
	<tr> 
		<td colspan="6" style="text-align: center; background: #4085BB; color: white;"> 
			Opening Balance
		</td>
	</tr>
	
	<tr>
		<td> OB Number	</td>
		<td> <?php echo $form->dropdownList($model, 'am_vouchernumber', CHtml::listData(Transaction::model()->findAll('cm_type = "Voucher No" AND cm_trncode="OB--"'),'cm_trncode','cm_trncode'), array('style'=>'width: 140px;') ); ?> </td>
		<td> <?php echo $form->textField($model,'am_vouchernumber', array('style'=>'width: 140px;') ); ?> <?php echo $form->error($model,'am_vouchernumber'); ?></td>
		<td> Date </td>
		<td colspan="2"> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'am_date', //attribute name
					'language'=> '',
					'mode'=>'date', 
					'options'=>array(
						'dateFormat' => 'yy-mm-dd',
						'showAnim'=>'fold',
						'changeMonth' => 'true',
						'changeYear' => 'true',
						'showOtherMonths' => 'true',
						'selectOtherMonths' => 'true',
						'showOn' => 'both',
						'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
				),
				
				'htmlOptions'=>array(
					'value'=>CTimestamp::formatDate('Y-m-d'),
				'style' => 'width: 140px;'
				),
			));?> 
		 </td>
	</tr>
	
	<tr> 
		<td> Brach Code </td>
		<td colspan="2"> <?php // echo $form->textField($model,'am_branch',  array('style'=>'width: 140px;')); ?> 
				<?php 
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'name'=>'am_branch',
						'model'=>$model,
						'attribute'=>'am_branch',
						'source'=>CController::createUrl('/vouhcerheader/getbranchname'),
						'options'=>array(
							'minLength'=>'1', 
							'select'=>'js:function(event, ui){
								$("#cm_branch").val(ui.item.value);
								$("#branch_desc").text(ui.item.label);
								$("#currency_a").val(ui.item.currency);
								$("#exchange_rate").val(ui.item.exchangerate);
							}'
						),
						'htmlOptions'=>array(
							'id'=>'cm_branch',
							//'rel'=>'val',
							'placeholder'=>'search by branch name',
						),
					));
				?> 
		</td>
		<td> Branch Name </td>
		<td colspan="2"> <span id="branch_desc"></span> </td>
	</tr>
	
	<tr> 
		<td>References </td>
		<td colspan="5"> <?php echo $form->textField($model,'am_referance',array('style'=>'width: 99%;')); ?> </td>
	</tr>
	<tr> 
		<td> Year </td>
		<td> <?php echo $form->textField($model,'am_year', array('style'=>'width: 140px;', 'readonly'=>'readonly')); ?> </td>
		<td> Period </td>
		<td> <?php echo $form->textField($model,'am_period',  array('style'=>'width: 140px;', 'readonly'=>'readonly')); ?> </td>
		<td> Status </td>
		<td> <?php echo $form->textField($model,'am_status',  array('value'=>'Open', 'readonly'=>'readonly', 'style'=>'width: 140px;')); ?> </td>
	</tr>
	
	<tr> 
		<td> Note </td>
		<td colspan="5"> <?php echo $form->textArea($model,'am_note',array('style'=>'font-size: 12px; color: #666; width: 99%;')); ?> </td>
	</tr>
</table>







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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

</div><!-- form -->

<br>
<table style="width: 94%; float: left;">
	<tr> 
		<td style="text-align: center; background: #4085BB; color: white;"> 
			Opening Balance Transaction
		</td>
	</tr>
</table>

<table>	
	<thead>
		<tr>
			<th> Acc. Code </th>
			<th> Description </th>
			<th> Currency </th>
			<th> Exchange Rate </th>
			<th> Prime Amount </th>
			<th> Base Amount </th>
			<th> Remarks </th>
			<th> Action </th>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td width="120"> 
				<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
							'name'=>'account_code',
							//'model'=>$model,
							//'attribute'=>'account_code',
							'source'=>CController::createUrl('/vouhcerheader/accountname'),
							'options'=>array(
								'minLength'=>'1', 
								'select'=>'js:function(event, ui){
									$("#account_code").val(ui.item.value);
									$("#account_desc").val(ui.item.label);
								}'
							),
							'htmlOptions'=>array(
								'id'=>'account_code',
								'placeholder'=>'search account code',
								'style'=>'padding: 3px',
							),
						)); ?> 
			</td>
			<td width="210"> <input id="account_desc" style="width: 210px; padding: 3px;" readonly="readonly"/> </td>
			<td width="114"> <input id="currency_a" style="width: 114px; padding: 3px;" readonly="readonly" /> </td>
			<td width="114"> <input id="exchange_rate" style="width: 114px; padding: 3px;" readonly="readonly"/> </td>
			<td width="114"> <input id="pre_prime_amt" onchange="primeMultiply()" style="width: 114px; padding: 3px;"/> </td>
			<td width="114"> <input id="pre_base_amt" style="width: 114px; padding: 3px;" readonly="readonly"/> </td>
			<td width="114"> <input id="pre_remarks" style="width: 114px; padding: 3px;"/>  </td>
			<td> <span id="button_add"> Add </span> </td>
		</tr>
	</tbody>
</table>

<script type="text/javascript">
var id=0;
$(document).ready(function(){
	$("#button_add").click(function() {
	    var tableData = $(this).closest("tr").find("td input").map(function() {
	        return $(this).val();
	    }).get();
	    
	    var pre_prime = document.getElementById("total_prime_amount").value;
	    var pre_base = document.getElementById("total_base_amount").value;
		var account_code = document.getElementById("account_code").value;
	    //id=id+1;

	    var prime_total = parseInt(pre_prime) + parseInt($.trim(tableData[4]));
	    var base_total = parseInt(pre_base) + parseInt($.trim(tableData[5]));

		if( account_code == ""){	
				alert("Please add account code and details");
				exit;
			}else{
			$("#test").append(
					   "<tr><td><input name='am_accountcode[]' value='"+$.trim(tableData[0])+"' style='width: 140px;' readonly > </td><td><input value='"+$.trim(tableData[1])+"' style='width: 140px;' readonly ></td><td><input name='am_currency[]' value='"+$.trim(tableData[2])+"' style='width: 140px;' readonly ></td><td><input name='am_exchagerate[]' value='"+$.trim(tableData[3])+"' style='width: 140px;' readonly ></td><td><input name='am_primeamt[]' value='"+$.trim(tableData[4])+"' style='width: 140px;' readonly ></td><td><input name='am_baseamt[]' value='"+$.trim(tableData[5])+"' style='width: 140px;' readonly ></td><td><input name='am_note[]' value='"+$.trim(tableData[6])+"' style='width: 140px;' readonly ></td></tr>");

			    document.getElementById("total_prime_amount").value = prime_total;
				document.getElementById("total_base_amount").value = base_total;
		}
	});
});

function primeMultiply(){
	var exchangeRate = document.getElementById("exchange_rate").value;
	var primeAmt = document.getElementById("pre_prime_amt").value;

	var baseAmt = parseInt(exchangeRate) * parseInt(primeAmt);

	document.getElementById("pre_base_amt").value = baseAmt;
	
}
</script>


<br>
<table>
	<tbody id="test">
	</tbody>
</table>

<br>
<table style="width: 34%; float: left; margin-left: 46%;">
	<tr>
		<td width="100" style="font-weight: bold;"> Total: </td>
		<td width="120"> <?php echo $form->textField($model,'am_referance', array('value'=>'0', 'id'=>'total_prime_amount', 'readonly'=>'readonly')); ?> </td>
		<td width="120"> <?php echo $form->textField($model,'am_referance', array('value'=>'0', 'id'=>'total_base_amount', 'readonly'=>'readonly')); ?> </td>
	</tr>
</table>




<div class="row buttons">
	<div class="row status-container">
         <div class="span4 action-bar">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
	  </div>
	</div>
</div>

<?php $this->endWidget(); ?>


