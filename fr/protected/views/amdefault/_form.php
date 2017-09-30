<?php
/* @var $this AmdefaultController */
/* @var $model Amdefault */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'amdefault-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_offset'); ?>
		<?php echo $form->textField($model,'am_offset'); ?>
		<?php echo $form->error($model,'am_offset'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_pnlacount'); ?>
		<?php echo $form->textField($model,'am_pnlacount',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_pnlacount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_year'); ?>
		<?php echo $form->textField($model,'am_year'); ?>
		<?php echo $form->error($model,'am_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_period'); ?>
		<?php echo $form->textField($model,'am_period'); ?>
		<?php echo $form->error($model,'am_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inserttime'); ?>
		<?php echo $form->textField($model,'inserttime'); ?>
		<?php echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->textField($model,'updatetime'); ?>
		<?php echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'insertuser'); ?>
		<?php echo $form->textField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->