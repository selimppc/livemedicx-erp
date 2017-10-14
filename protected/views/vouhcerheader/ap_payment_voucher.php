<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Account Payable'=>array('vouhcerheader/appayment'),
	'New  Account Payable',
);

$this->menu=array(
    array('label'=>'<< Back to Account Payable', 'url'=>array('vouhcerheader/appayment')),
	array('label'=>'Manage Account Payable', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('vouhcerheader/manageAcPayment')),
);
?>

<style type="text/css">
	table .money-receipt-sales, td, th
	{
		border: 1px solid #4E8EC2;
	}

#Vouhcerheader_am_currency{
	width: 140px;
}
</style>

<script type="text/javascript">

function getMe(){
	
	var vdate = document.getElementById("date_formate_v").value;
	var year = vdate.substring(0,4);

	
	
	var month = vdate.substring(5,7);
	var offset = document.getElementById("offset_pre").value;
	var period =  12 + parseInt(month) - parseInt(offset);
	//alert(month);
	//exit;
	
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



var id=0;
var addedProductCodes = [];

$(document).ready(function(){
	$(".items tr").click(function() {

	    var tableData = $(this).children("td").map(function() {
	        return $(this).text();
	    }).get();

	    var total = Math.round((document.getElementById("sm_totalamt").value)*100)/100;
	    //total = parseInt(total) + parseInt($.trim(tableData[1]));

	    var value = Math.round(($.trim(tableData[1]))*100)/100;
	    var preBalance = Math.round((document.getElementById("balance").value)*100)/100 ;
	    
	    var td_productCode = $.trim(tableData[0]);
  
	   
	    
		var index = $.inArray(td_productCode, addedProductCodes);
		if (index >= 0) {
			alert("You already added this Product");
			exit;
		} else {
			    if (preBalance >= value ){
			    	$("#test").append(
				    		"<tr><td><input name='am_invnumber[]' value='"+ $.trim(tableData[0]) +"' style='width: 97%;' readonly ></td><td><input name='am_amount[]' value='"+ value +"' style='width: 97%; text-align: right;' readonly ></td>  <td><input value='"+ $.trim(tableData[2]) +"' readonly style='width: 97%; text-align: right;'></td> <td><input value='"+ $.trim(tableData[3]) +"' readonly style='width: 97%; text-align: right;' ></td></tr>");
	
					var balance = Math.round((preBalance - value)*100)/100;
			    	document.getElementById("balance").value = balance;
			    	document.getElementById("sm_totalamt").value = Math.round((value + total)*100)/100;
	
				}else if (preBalance < value && preBalance != 0){
					$("#test").append(
				    		"<tr><td><input name='am_invnumber[]' value='"+ $.trim(tableData[0]) +"' style='width: 97%;' readonly ></td><td><input name='am_amount[]' value='"+ preBalance +"' style='width: 97%; text-align: right;' readonly ></td><td><input value='"+ $.trim(tableData[2]) +"' readonly style='width: 97%; text-align: right;' ></td> <td><input value='"+ $.trim(tableData[3]) +"' readonly style='width: 97%; text-align: right;'></td></tr>");
					var balance = Math.round((preBalance - preBalance)*100)/100;
					document.getElementById("balance").value = balance;
					document.getElementById("sm_totalamt").value = Math.round((total + preBalance)*100)/100;
	
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
	total = parseFloat(preTotal) - parseFloat(value);
	document.getElementById("sm_totalamt").value = parseFloat(total).toFixed(2);
}

function balanceAmount(){
	
	var amount = document.getElementById("cm_net_amount").value;

	var unpaidtotalamount = document.getElementById("unpaidtotalamount").innerHTML;

	if( parseInt(amount) > parseInt(unpaidtotalamount) ){
			alert(" Ops! Amount is Bigger than unpaid Amount");
			document.getElementById("balance").value = 0;
			document.getElementById("cm_net_amount").value = 0.00;
			exit;
		}else{

			
			document.getElementById("balance").value = amount;
			
		}
	
}



</script>



<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Account Payable Voucher:</b>
        Fill in the <b>Payment Voucher</b> as required. On your right hand side there are two separate tables. On the <b>"Unpaid Invoice List"</b> click under <b>Invoice No</b> row for generating <b>Allocated Invoice</b> which will appear on the table <b>Allocated Invoice</b>. Click on <b>Save</b> button.
        <br>
        <span style="color: #008000; font-weight: bold;"> Note: Payment can be Paid Part or Full. </span> <br>
        <span style="color: red; font-weight: bold;"> Warning: <b>"Allocated Invoice"</b> and <b>"Payment Voucher"</b> currency must remain the same </span>
    </div>
</div>




<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vouhcerheader-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	//'focus'=>array($model,'am_vouchernumber'),
)); ?>

<input id="offset_pre" type="hidden" value="<?php echo $offset; ?>" />	





<div style="width: 55%; float: left;">

<table>
	<tr> 
		<td colspan="4" style="text-align: center; background: #4085BB; color: white;"> 
			Payment Voucher
		</td>
	</tr>
	
	<tr>
		<td> Payment Voucher #	</td>
		<td> <?php echo $form->textField($model, 'am_vouchernumber', array('style'=>'width: 140px;') ); ?> 
		</td>
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

	<tr> 
		<td> Year </td>
		<td> <?php echo $form->textField($model,'am_year', array('id'=>'year_new', 'style'=>'width: 140px;', 'readonly'=>'readonly')); ?> </td>
		<td> Period </td>
		<td> <?php echo $form->textField($model,'am_period',  array('id'=>'period_new', 'style'=>'width: 97%;', 'readonly'=>'readonly')); ?> </td>
	</tr>
	
	<tr>
		
		<td> Status </td>
		<td> <?php echo $form->textField($model,'am_status',  array('value'=>'Balanced', 'readonly'=>'readonly', 'style'=>'width: 140px;')); ?> </td>
		<td> <b>Branch Code *</b> </td>
		<td colspan="2"> <?php echo $form->textField($model,'am_branch',  array('readonly'=>TRUE, 'style'=>'width: 200px;')); ?>
            <?php //echo $form->dropDownList($model,'am_branch',  CHtml::listData(Branchmaster::model()->findAll(array('order' => 'cm_description ASC')),'cm_branch','cm_description'), array('empty'=>'- Select Branch -',  'required'=>TRUE, 'style'=>'width: 200px;')); ?>
				<?php /*
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'name'=>'am_branch',
						'model'=>$model,
						'attribute'=>'am_branch',
						'source'=>CController::createUrl('/vouhcerheader/GetBranchNameAp'),
						'options'=>array(
							'minLength'=>'1', 
							'select'=>'js:function(event, ui){
								$("#am_branch").val(ui.item.value);
								$("#newwewe").val(ui.item.exchangerate);
								getPackages(ui.item.value, ui.item.currency);
							}'
						),
						'htmlOptions'=>array(
							'id'=>'am_branch',
							//'rel'=>'val',
							'placeholder'=>'search by branch name',
							'style'=>'width: 97%;',
							'required'=>'required',
						),
					));
				*/?>
		</td>
	</tr>
	
<?php Yii::app()->clientScript->registerScript("selimreza","
        function getPackages(value, currency){

            $.ajax({
                url: '". $this->createUrl('vouhcerheader/dynamicpackage')."',
                data: 'value='+value + '&currency=' + currency,

                success: function(packages) {
                         $('#".CHtml::activeId($model, 'am_currency')."').html(packages);
                      }
            });
        }
	",CClientScript::POS_END);
?>


	<tr> 
		<td style="width: 130px"> <b>A/C Head Payable *</b>  </td>
		<td colspan="3""> <?php // echo $form->textField($model,'am_branch',  array('style'=>'width: 140px;')); ?>
		<?php echo $form->dropDownList($model, 'am_creditorac', CHtml::listData(Chartofaccounts::model()->findAll(array('order' => 'am_description ASC')),'am_accountcode','am_description'), array('empty'=>'-- Select Account --', 'id'=>'account_code', 'style'=>'width: 99%;', 'required'=>true));?> 

		</td>
		<!-- <td> Description </td>
		<td> <span id="account_description"></span></td>  -->
	</tr>
	
	<tr>
		<td> <b>Amount Paid *</b> </td>
		<td colspan="3"> 
			<input type="text" name="am_primeamt" style="width: 99%; text-align: right;" required="required" placeholder="0.00" id="cm_net_amount" onchange="balanceAmount()" >
			<input type="hidden" id="balance" value="0" style="width: 50px;">
		</td>
	</tr>
	
	<tr>
		<td> Currency * </td>
		<td>
            <?php $currency= CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description');
            echo $form->dropDownList($model,'am_currency', $currency, array('empty'=>'- Select Currency -', 'required'=>TRUE,

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

			<?php /*echo $form->dropDownList($model,'am_currency', array(),
					array(
                        'empty'=>'- Select Currency -',
                        'ajax'=>array(
                            'type'=>'POST',
                            'url' => CController::createUrl('Vouhcerheader/GetExchagerate'),
                            'update' => '#newwewe',  
							'data'=>array('store'=>'js:this.value',),   
            				'success'=> 'function(data) {$("#newwewe").empty();
                           		$("#newwewe").val(data);
                           	} ', 
                        )) 
			); */?>
			
		
		</td>
		<td> Exchange Rate: </td>
		<td> <input id="exchange_rate" name="am_exchagerate" placeholder="0.00" style="width: 97%;"/>
            <?php //echo $form->textField($model,'exchange_rate',array('id'=>'exchange_rate', 'placeholder'=>'0.00' )); ?>
        </td>
	</tr>
	
	<tr>
		<td> <b>Expense Account:</b> </td>
		<!-- <td style="background: white;"> <?php //echo $accoutcode; ?></td>
		<td> Description </td> -->
		<td  colspan="3" style="background: white;"> <?php echo $debator; ?></td>
	</tr>
	
	<tr>
		<td> Supplier Name: </td>
		<!-- <td> <?php // echo $suppliercode; ?></td>
		<td> Name </td> -->
		<td colspan="3" style="background: white;"> <?php echo $suppliername; ?></td>
	</tr>


	
	<tr> 
		<td> Note </td>
		<td colspan="5"> <?php echo $form->textArea($model,'am_note',array('style'=>'font-size: 12px; color: #666; width: 99%;')); ?> </td>
	</tr>
</table>


</div>


<div style="width: 40%; float: left;">


<table style="width: 95%; margin-bottom: 30px;">
		<tr>
			<td colspan="4" style="text-align: center; background: #4085BB; color: white; font-weight: bold;"> 
				Unpaid Invoice List of - <?php echo $suppliername; ?> 
			</td>
		</tr>
		<tr>
			<td>
				<table>
					<thead>
						<tr>
							<th width="270">Invoice No</th>
							<th width="270">Amount Payable</th>
							<th width="200">Currency </th>
							<th width="200">Exchange Rate</th>
                            <th width="200">Date</th>

						</tr>
					</thead>

					<tbody class="items">
						<?php   foreach($unpayinvoice as $values): { ?>
							<tr style="background: white;">
								<td><?php  echo $values['invoicnumber']; ?></td>
								<td style="text-align: right;"><?php  echo $values['amount']; ?></td>
								<td><?php  echo $values['currency']; ?></td>
								<td><?php  echo $values['exchange']; ?></td>
                                <td><?php  echo $values['date']; ?></td>
								
							</tr>
						<?php  } endforeach; ?>

					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width: 71%; float: left; padding-left: 119px;"> Total: <span id="unpaidtotalamount"><?php  echo $unpamt; ?></span> </td>
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
							<th width="120"> Invoice No </th>
							<th width="100"> Amount </th>
							<th width="100"> Currency </th>
							<th> Exchange Rate </th>
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


	<table style="width: 95%; float: left;">
		<tr>
			<td>
				<table>
					<tr> 
						<td style="width:  30%;"> Total </td>
						<td style="width: 70%; ">
							<input type="text"  id="sm_totalamt" value="0" readonly style="text-align: right;">
						</td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

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
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser'); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>



<div class="row buttons">
	<div class="row status-container">
         <div class="span4 action-bar">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
	  </div>
	</div>
</div>

<?php $this->endWidget(); ?>

