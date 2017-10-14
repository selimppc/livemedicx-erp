<?php
/* @var $this BatchsaleController */
/* @var $model Batchsale */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_number'); ?>
		<?php echo $form->textField($model,'sm_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_batchnumber'); ?>
		<?php echo $form->textField($model,'sm_batchnumber',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_expdate'); ?>
		<?php echo $form->textField($model,'sm_expdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_unit'); ?>
		<?php echo $form->textField($model,'sm_unit',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_quantity'); ?>
		<?php echo $form->textField($model,'sm_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_bonusqty'); ?>
		<?php echo $form->textField($model,'sm_bonusqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_rate'); ?>
		<?php echo $form->textField($model,'sm_rate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_tax_rate'); ?>
		<?php echo $form->textField($model,'sm_tax_rate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_tax_amt'); ?>
		<?php echo $form->textField($model,'sm_tax_amt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_line_amt'); ?>
		<?php echo $form->textField($model,'sm_line_amt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inserttime'); ?>
		<?php echo $form->textField($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updatetime'); ?>
		<?php echo $form->textField($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'insertuser'); ?>
		<?php echo $form->textField($model,'insertuser',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->