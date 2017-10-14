<?php
/* @var $this AdjusthdController */
/* @var $model Adjusthd */
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
		<?php echo $form->label($model,'transaction_number'); ?>
		<?php echo $form->textField($model,'transaction_number',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DATE'); ?>
		<?php echo $form->textField($model,'DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'branch'); ?>
		<?php echo $form->textField($model,'branch',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adjustment_type'); ?>
		<?php echo $form->textField($model,'adjustment_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'confirm_date'); ?>
		<?php echo $form->textField($model,'confirm_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exchange_rate'); ?>
		<?php echo $form->textField($model,'exchange_rate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'STATUS'); ?>
		<?php echo $form->textField($model,'STATUS',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inserttime'); ?>
		<?php echo $form->textField($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'insertuser'); ?>
		<?php echo $form->textField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updatetime'); ?>
		<?php echo $form->textField($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->