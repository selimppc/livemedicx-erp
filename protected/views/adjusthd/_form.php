<?php
/* @var $this AdjusthdController */
/* @var $model Adjusthd */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
    #Adjusthd_adjustment_type input, #Adjusthd_adjustment_type label{
        padding-left: 1em;
        display: inline !important;
        width: auto !important;
        margin-top: 2px;
    }
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'adjusthd-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'transaction_number'); ?>
		<?php echo $form->textField($model,'transaction_number',array('readonly'=>TRUE, 'style'=>$model->isNewRecord ? 'background: #efefef':'', )); ?>
		<?php echo $form->error($model,'transaction_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DATE'); ?>
		<?php //echo $form->textField($model,'DATE'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'DATE', //attribute name
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
                'value'=>CTimestamp::formatDate('Y-m-d', strtotime("now") ),
            ),
        ));?>
        <?php echo $form->error($model,'DATE'); ?>
	</div>

	<div class="row">
		<label>Branch <span class="required">*</span></label>
		<?php $branch = CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description');
        echo $form->dropDownlist($model,'branch', $branch, array('empty'=>'- Select Branch -', 'required'=>TRUE, )); ?>
		<?php echo $form->error($model,'branch'); ?>
	</div>

	<div class="row" style="margin-top: 10px;">
		<label>Adjustment Type <span class="required">*</span> </label>
		<?php echo $form->radioButtonList($model,'adjustment_type', array('-1'=>'Negative', '1'=>'Positive'),
            array('class'=>'compactRadioGroup', 'required'=>TRUE, 'separator'=>'', 'labelOptions'=>array('style'=>'display:inline; margin: -5px 55px 0px 0px; padding: 0px 0px 0px 3px;'))
            ); ?>
		<?php echo $form->error($model,'adjustment_type'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'confirm_date'); ?>
		<?php //echo $form->textField($model,'confirm_date'); ?>

		<?php //echo $form->error($model,'confirm_date'); ?>
	</div>

	<div class="row">
		<label>Currency <span class="required">*</span> </label>
		<?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'currency', $currency, array('empty'=>'- Choose Currency -', 'required'=>TRUE,

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

        )); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exchange_rate'); ?>
		<?php echo $form->textField($model,'exchange_rate', array('id'=>'exchange_rate', 'placeholder'=>'0.00')); ?>
		<?php echo $form->error($model,'exchange_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'STATUS'); ?>
		<?php echo $form->textField($model,'STATUS',array('value'=>'Open','readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'STATUS'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'inserttime'); ?>
		<?php echo $form->hiddenField($model,'inserttime'); ?>
		<?php //echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'insertuser'); ?>
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->hiddenField($model,'updatetime'); ?>
		<?php //echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Adjustment Header' : 'Update Adjustment Header', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->