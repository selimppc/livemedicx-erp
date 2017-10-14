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

	function totalAmount(){
		var totalAmount = Math.round((document.getElementById("total_amount").value)*100)/100;
		var vatAmount = Math.round((document.getElementById("vat_amount").value)*100)/100;

        var net_amount = Math.round( (totalAmount + vatAmount) *100)/100;

        document.getElementById("net_amount").value = net_amount;
		
	}

    function vatAmount(){

        var totalAmount = Math.round((document.getElementById("total_amount").value)*100)/100;
        var vatAmount = Math.round((document.getElementById("vat_amount").value)*100)/100;

        var net_amount = Math.round( (totalAmount + vatAmount) *100)/100;

        document.getElementById("net_amount").value = net_amount;

    }



</script>

<div style="width:99%; float: left;">

	<table>
		<tr> 
			<td colspan="4" style="text-align: center; background: #4085BB; color: white;"> 
				<b> Direct Sale Header  </b>
			</td>
		</tr>
		
		<tr>
			<td> <?php echo $form->labelEx($model,'sm_number'); ?> </td>
			<td> <?php echo $form->textField($model,'sm_number',array('id'=>'sm_number', 'readonly'=>'readonly', 'style'=>'background: #ccc; width: 97%; padding: 5px;')); ?> </td>
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
			<td> Sale from Warehouse <?php //echo $form->labelEx($model,'sm_storeid'); ?> </td>
			<td colspan="3"> <?php echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('id'=>'warehouse', 'style'=>'width: 99.50%;')); ?>
				 <?php //echo $form->textField($model,'sm_storeid', array('id'=>'sm_storeid', 'readonly'=>true)); ?>
			</td>

		</tr>
        <tr>
            <td>
                <label> Note/ Remarks </label>
            </td>
            <td colspan="3">
                <?php echo $form->textArea($model,'sm_note', array('required'=>TRUE, 'style'=>'width: 99%; height: 80px;')); ?>
            </td>
        </tr>

	</table>
    <p style="color: darkorange; padding: 5px; font-weight: bold;">Write down your total amount and vat amount below</p>
    <table>
        <tr>
            <td>
                <b>Amount (Excl. VAT)</b>
            </td>
            <td>
                <?php echo $form->textField($model,'sm_totalamt', array('onchange' => 'totalAmount();', 'id'=>'total_amount',  'style'=>'width: 120px ; text-align:right; padding: 5px;', 'required'=>TRUE,)); ?>
            </td>
            <td>
                <b>VAT Amount</b>
            </td>
            <td>
                <?php echo $form->textField($model,'sm_total_tax_amt', array('onchange' => 'vatAmount();', 'id'=>'vat_amount', 'style'=>'width: 120px; text-align:right;padding: 5px;', 'required'=>TRUE,)); ?>
            </td>
            <td>
                <b>Total Amount (Incl. VAT)</b>
            </td>
            <td>
                <?php echo $form->textField($model,'sm_netamt', array('id'=>'net_amount', 'style'=>'width: 120px; text-align:right;padding: 5px;', 'required'=>TRUE,)); ?>
            </td>
        </tr>
    </table>

    <div class="row">
        <?php //echo $form->labelEx($model,'sm_doc_type'); ?>
        <?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Sales', 'id'=>'sm_doc_type')); ?>
        <?php //echo $form->error($model,'sm_doc_type'); ?>
    </div>

<br>


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