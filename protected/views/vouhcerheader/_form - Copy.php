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
#Vouhcerheader_voucher_no{
	width: 140px;
}
</style>





<script type="text/javascript">
var id=0;
$(document).ready(function(){
	$("#button_add").click(function() {
	    var tableData = $(this).closest("tr").find("td input").map(function() {
	        return $(this).val();
	    }).get();

	    //getting Account Code by selection
	    var e = document.getElementById("account_code");
	    var am_accountcode = e.options[e.selectedIndex].value;
	    
	    //var am_accountcode = $.trim(tableData[0]);
	    var am_currency = $.trim(tableData[0]);
	    var am_exchagerate = $.trim(tableData[1]);
	    var am_primeamt = $.trim(tableData[2]);
	    var am_baseamt = $.trim(tableData[3]);
	    var am_note = $.trim(tableData[4]);

	    var pre_prime = document.getElementById("total_prime_amount").value;
	    var pre_base = document.getElementById("total_base_amount").value;
		var pre_prime_amt = document.getElementById("pre_prime_amt").value;
		var exchange_rate = document.getElementById("exchange_rate").value;
		
	    //id=id+1;

	    var prime_total = parseInt(pre_prime) + parseInt(am_primeamt);
	    var base_total = parseInt(pre_base) + parseInt(am_baseamt);
		
		if(pre_prime_amt=="" || exchange_rate==""){	
				document.getElementById("pre_prime_amt").value = "";
				document.getElementById("pre_base_amt").value = "";
				alert("Please add Exchange Rate & Amount");
				exit;
			}else{
			$("#test").append(
					"<tr><td><input name='am_accountcode[]' value='"+ am_accountcode +"' style='width: 140px;' readonly > </td><td><input name='am_currency[]' value='"+ am_currency +"' style='width: 140px;' readonly ></td><td><input name='am_exchagerate[]' value='"+ am_exchagerate +"' style='width: 140px;' readonly ></td><td><input name='am_primeamt[]' value='"+ am_primeamt +"' style='width: 140px;' readonly ></td><td><input name='am_baseamt[]' value='"+ am_baseamt +"' style='width: 140px;' readonly ></td><td><input name='am_note[]' value='"+ am_note +"' style='width: 140px;' readonly ></td><td><span onclick='deleteRow(\"" + am_primeamt + "\", \"" + am_baseamt + "\", this)' style='background:orange; color:white; border-radius: 3px; cursor: pointer; padding: 1px 3px; margin-left: 5px;' id='delete_button'> x </span></td></tr>");

			    document.getElementById("total_prime_amount").value = prime_total;
				document.getElementById("total_base_amount").value = base_total;
				
				document.getElementById("pre_prime_amt").value = "";
				document.getElementById("pre_base_amt").value = "";
		}
	});
});

function primeMultiply(){
	var exchangeRate = document.getElementById("exchange_rate").value;
	var primeAmt = document.getElementById("pre_prime_amt").value;

	var baseAmt = parseInt(exchangeRate) * parseInt(primeAmt);
	
	document.getElementById("pre_base_amt").value = baseAmt;
	
}

function getMe(){
	var vdate = document.getElementById("date_formate_v").value;
	var year = vdate.substring(0,4);

	var month = vdate.substring(5,7);
	var offset = document.getElementById("offset_pre").value;
	var period =  12 + parseInt(month) - parseInt(offset);

	if (parseInt(period) > 12 ){
		 postPeriod =  parseInt(period) - 12;
		 document.getElementById("period_new").value = postPeriod;
		}else{		
		document.getElementById("period_new").value = period;
	}
	if(parseInt(period) <= 12){
			yearA = parseInt(year) -1;
			document.getElementById("year_new").value = yearA;
		}else{
			document.getElementById("year_new").value = year;	
		}
	}


	function deleteRow(am_primeamt, am_baseamt, row)
	{
		$(row).closest('tr').remove();
	
		var am_primeamt = Math.round((am_primeamt)*100)/100;
		var am_baseamt = Math.round((am_baseamt)*100)/100;
		    
		var totalPrime= Math.round((document.getElementById("total_prime_amount").value)*100)/100;
		totalprm = Math.round((totalPrime - am_primeamt)*100)/100;

		var totalBase= Math.round((document.getElementById("total_base_amount").value)*100)/100;
		totalbse = Math.round((totalBase - am_baseamt)*100)/100;

		document.getElementById("total_prime_amount").value = totalprm;
		document.getElementById("total_base_amount").value = totalbse;
	}

</script>








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
			GL Voucher
		</td>
	</tr>
	
	<tr>
		<td> Voucher Number	</td>
		<td> <?php //echo $form->dropdownList($model, 'am_vouchernumber', CHtml::listData(Transaction::model()->findAll('cm_type = "Voucher No"'),'cm_trncode','cm_trncode'), array('style'=>'width: 140px;') ); ?> 
			<?php $voucherArray = CHtml::listData(Transaction::model()->findAll('cm_type = "Voucher No"'),'cm_trncode','cm_trncode');
           echo $form->dropDownList($model, 'voucher_no', $voucherArray,  
                          array(
                          		'empty'=>"Select Voucher",
                                'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('vouhcerheader/GetVoucherNo' ),
	                          		//'success'=>'js:function(data){$("#currencyid").val(data);}', 
                          			'update' => '#am_vouchernumber',  
									'data'=>array('voucher_no'=>'js:this.value',),   
            						'success'=> 'function(data) {$("#am_vouchernumber").empty();
                           		 				$("#am_vouchernumber").val(data);
                           		 	} ',                           
                          ),

                 			     
            )); ?>
		</td>
		<td> <?php echo $form->textField($model,'am_vouchernumber', array('id'=>'am_vouchernumber', 'style'=>'width: 140px;', 'required'=>'required') ); ?> <?php echo $form->error($model,'am_vouchernumber'); ?></td>
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
					'id'=>'date_formate_v',
					'style' => 'width: 140px;',
					'onchange' => 'getMe()',
				),
			));?> 
		 </td>
	</tr>
	
	 
	<tr> <td style="border: none;"> <input id="offset_pre" type="hidden" value="<?php echo $offset; ?>" /> </td></tr>	
	
	
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
							'required' => true,
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
		<td> <?php echo $form->textField($model,'am_year', array('id'=>'year_new', 'style'=>'width: 140px;', 'readonly'=>'readonly')); ?> </td>
		<td> Period </td>
		<td> <?php echo $form->textField($model,'am_period',  array('id'=>'period_new', 'style'=>'width: 140px;', 'readonly'=>'readonly')); ?> </td>
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
		<?php echo $form->hiddenField($model,'insertuser'); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser'); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>



<br>
<table style="width: 80%; float: left;">
	<tr> 
		<td style="text-align: center; background: #4085BB; color: white;"> 
			GL Voucher Transaction
		</td>
	</tr>
</table>

<table>	
	<thead>
		<tr>
			<th> Account Code </th>

			<th> Local Currency </th>
			<th> Exchange Rate </th>
			<th> Amount </th>
			<th> Base Amount </th>
			<th> Remarks </th>
			<th> Action </th>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td width="170"> 
				 <?php /* $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
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
								'style'=>'padding: 3px; width: 170px;',
							),
						)); */ ?> 
				<?php echo $form->dropDownList($model2, 'am_accountcode', CHtml::listData(Chartofaccounts::model()->findAll(),'am_accountcode','am_description'), array('id'=>'account_code', 'style'=>'width: 230px;'));?>		
			</td>
			 
			<td width="114"> <input id="currency_a" style="width: 114px; padding: 3px;" readonly="readonly" /> </td>
			<td width="114"> <input id="exchange_rate" style="width: 114px; padding: 3px;" readonly="readonly"/> </td>
			<td width="114"> <input id="pre_prime_amt" onchange="primeMultiply()" style="width: 114px; padding: 3px;"/> </td>
			<td width="114"> <input id="pre_base_amt" style="width: 114px; padding: 3px;" readonly="readonly"/> </td>
			<td width="114"> <input id="pre_remarks" style="width: 114px; padding: 3px;"/>  </td>
			<td> <span id="button_add"> Add </span> </td>
		</tr>
	</tbody>
</table>

<br>
<table>
	<tbody id="test">
	</tbody>
</table>

<br>
<table style="width: 34%; float: left; margin-left: 46%;">
	<tr>
		<td width="100" style="font-weight: bold;"> Total: </td>
		<td width="120"> <?php echo $form->textField($model,'am_referance1', array('value'=>'0', 'id'=>'total_prime_amount', 'readonly'=>'readonly', 'style'=>'width: 120px; text-align: right')); ?> </td>
		<td width="120"> <?php echo $form->textField($model,'am_referance1', array('value'=>'0', 'id'=>'total_base_amount', 'readonly'=>'readonly',  'style'=>'width: 120px; text-align: right')); ?> </td>
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


