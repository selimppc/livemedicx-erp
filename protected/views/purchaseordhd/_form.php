<?php
/* @var $this PurchaseordhdController */
/* @var $model Purchaseordhd */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchaseordhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'pp_purordnum'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>
	

	<div class="row">
		<?php echo $form->labelEx($model,'pp_purordnum'); ?>
		<?php echo $form->textField($model,'pp_purordnum', array('readonly' => 'true')); ?>
		<?php echo $form->error($model,'pp_purordnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_date'); ?>
		<?php // echo $form->textField($model,'pp_date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'pp_date', //attribute name
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
			)
		));?> 
		<?php echo $form->error($model,'pp_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_supplierid'); ?>
        <?php echo $form->dropDownlist($model,'cm_supplierid', CHtml::listData(Suppliermaster::model()->findAll(), 'cm_supplierid', 'cm_orgname'), array('empty'=>'- Select Supplier -', 'required'=> TRUE)); ?>
		<?php echo $form->error($model,'cm_supplierid'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_requisitionno'); ?>
		<?php // echo $form->dropDownList($model,'pp_requisitionno',CHtml::listData(Purchaseordhd::model()->findAll(array('order'=>'pp_requisitionno DESC', 'limit'=>'5')), 'pp_requisitionno', 'pp_requisitionno')); ?>
		<?php /* $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model, //Model object
				'name'=>'pp_requisitionno',
				'attribute'=>'pp_requisitionno', //attribute name
		        'sourceUrl' => Yii::app()->createUrl('purchaseordhd/getreqno'),
		        'options'=>array(
		            'minLength'=>'1',
					'showAnim'=>'fold',
					'type' => 'get',
					'select'=>'js:function(event, ui) {
						$("#reqno").text(ui.item.value);
						disableInput();
					}'
		        ),
		        'htmlOptions'=>array(
		            'class'=>'input-1',
		          	'id' =>'reqno',
		        	//'placeholder'=>'search by typing R',
                    'readonly'=> TRUE,
                    'style'=>'background: #efefef; ',
		        ),
		    )); */ ?>

		<?php //echo $form->error($model,'pp_requisitionno'); ?>
	</div>

	<!-- Readonly requisition field after search by requisition -->
	<script type="text/javascript">
			function disableInput(){
				$("#reqno").prop('readonly', true);
			}
	</script>



	<div class="row">
		<?php echo $form->labelEx($model,'pp_payterms'); ?>
		<?php echo $form->dropDownList($model,'pp_payterms',array('Cash'=>'Cash','Credit'=>'Credit')); ?>
		<?php echo $form->error($model,'pp_payterms'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pp_deliverydate'); ?>
		<?php // echo $form->textField($model,'pp_deliverydate'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'pp_deliverydate', //attribute name
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
				'value'=>CTimestamp::formatDate('Y-m-d', strtotime("tomorrow")),
			)
		));?> 
		<?php echo $form->error($model,'pp_deliverydate'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'pp_store'); ?>
		<?php  echo $form->dropDownlist($model,'pp_store', CHtml::listData(Branchmaster::model()->findAll(), 'cm_branch', 'cm_description'), array('empty'=>'- Select Warehouse -', 'required'=>true, ) ); ?>
		<?php echo $form->error($model,'pp_store'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pp_currency'); ?>
		<?php //echo $form->dropDownList($model,'pp_currency', CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description'), array('empty'=>'- Select Currency -', 'required'=>true, )); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
              echo $form->dropDownList($model,'pp_currency', $currency, array('empty'=>'- Choose Currency -','required'=>TRUE,

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
		<?php echo $form->error($model,'pp_currency'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'pp_exchrate'); ?>
        <?php echo $form->textField($model,'pp_exchrate',array('id'=>'exchange_rate', 'placeholder'=>'0.00' )); ?>
        <?php echo $form->error($model,'pp_exchrate'); ?>
    </div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_taxrate'); ?>
		<?php //echo $form->textField($model,'pp_taxrate',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'pp_taxrate'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'pp_taxamt'); ?>
		<?php //echo $form->textField($model,'pp_taxamt',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'pp_taxamt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_discrate'); ?>
		<?php echo $form->textField($model,'pp_discrate',array('class'=>'discrate', 'id'=>'discrate' )); ?>
		<?php echo $form->error($model,'pp_discrate'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_discamt'); ?>
		<?php //echo $form->textField($model,'pp_discamt',array('class'=>'discamt', 'id'=>'discamt', 'readonly'=>true )); ?>
		<?php //echo $form->error($model,'pp_discamt'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_amount'); ?>
		<?php //echo $form->textField($model,'pp_amount', array('class'=>'amount', 'id'=>'amount', 'readonly' => true ) ); ?>
		<?php //echo $form->error($model,'pp_amount'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pp_status'); ?>
		<?php echo $form->textField($model,'pp_status', array('value'=>'Open', 'readonly' => 'true')); ?>
		<?php // echo $form->dropDownList($model,'pp_status', $this->getStatusOptions()); ?>
		<?php echo $form->error($model,'pp_status'); ?>
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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1', 'style'=>'padding-top: 25px;')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Purchase Header' : 'Update Purchase', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->