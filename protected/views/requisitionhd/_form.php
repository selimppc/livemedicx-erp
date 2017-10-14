<?php
/* @var $this RequisitionhdController */
/* @var $model Requisitionhd */
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
	'id'=>'requisitionhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_supplierid'),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_requisitionno'); ?>
		<?php echo $form->textField($model,'pp_requisitionno', array('readonly' => 'true')); ?>
		<?php echo $form->error($model,'pp_requisitionno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_supplierid'); ?>
		<?php echo $form->dropDownList($model,'cm_supplierid', CHtml::listData(Suppliermaster::model()->findAll(),'cm_supplierid','cm_orgname'),array('empty'=>'- Select Supplier -', 'required'=> TRUE )); ?>
		<?php echo $form->error($model,'cm_supplierid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_date'); ?>
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
			),
		));?> 
		<?php echo $form->error($model,'pp_date'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'pp_currency'); ?>
        <?php //echo $form->dropDownList($model,'pp_currency', CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description'), array('empty'=>'- Select Currency -', 'required'=>true, )); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'pp_currency', $currency, array('empty'=>'- Choose Currency -',

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
		<?php echo $form->labelEx($model,'pp_branch'); ?>
		<?php echo $form->dropDownList($model,'pp_branch', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'),array('empty'=>'- Select Branch -', 'required'=> TRUE)); ?>
		<?php echo $form->error($model,'pp_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_note'); ?>
		<?php echo $form->textArea($model,'pp_note', array('style'=>'font-size: 13px; color: #666;')); ?>
		<?php echo $form->error($model,'pp_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_status'); ?>
		<?php //echo $model->pp_status='Open'; ?>
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
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Requisition Header' : 'Update Requisition', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->