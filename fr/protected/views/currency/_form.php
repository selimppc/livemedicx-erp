<?php
/* @var $this CurrencyController */
/* @var $model Currency */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'currency-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_currency'); ?>
		<?php echo $form->dropDownList($model,'cm_currency', $model->getCurrencyOptions()); ?>
		<?php echo $form->error($model,'cm_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_description'); ?>
		<?php echo $form->textField($model,'cm_description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cm_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_exchangerate'); ?>
		<?php echo $form->textField($model,'cm_exchangerate',array('value'=>$model->isNewRecord ? "1.00" : $model->cm_exchangerate)); ?>
		<?php echo $form->error($model,'cm_exchangerate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_active'); ?>
		<?php echo $form->dropDownList($model,'cm_active', $model->getActiveOptions()); ?>
		<?php echo $form->error($model,'cm_active'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'inserttime'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add New Currency' : 'Update Currency', array('class'=>'btn_btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->