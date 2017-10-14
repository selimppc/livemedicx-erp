<?php
/* @var $this BatchsaleController */
/* @var $model Batchsale */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batchsale-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_number'); ?>
		<?php echo $form->textField($model,'sm_number',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_batchnumber'); ?>
		<?php echo $form->textField($model,'sm_batchnumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sm_batchnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_expdate'); ?>
		<?php echo $form->textField($model,'sm_expdate'); ?>
		<?php echo $form->error($model,'sm_expdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_unit'); ?>
		<?php echo $form->textField($model,'sm_unit',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_quantity'); ?>
		<?php echo $form->textField($model,'sm_quantity'); ?>
		<?php echo $form->error($model,'sm_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_bonusqty'); ?>
		<?php echo $form->textField($model,'sm_bonusqty'); ?>
		<?php echo $form->error($model,'sm_bonusqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_rate'); ?>
		<?php echo $form->textField($model,'sm_rate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_tax_rate'); ?>
		<?php echo $form->textField($model,'sm_tax_rate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_tax_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_tax_amt'); ?>
		<?php echo $form->textField($model,'sm_tax_amt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_tax_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_line_amt'); ?>
		<?php echo $form->textField($model,'sm_line_amt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_line_amt'); ?>
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
		<?php echo $form->textField($model,'insertuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->