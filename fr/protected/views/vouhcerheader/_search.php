<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */
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
		<?php echo $form->label($model,'am_vouchernumber'); ?>
		<?php echo $form->textField($model,'am_vouchernumber',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_date'); ?>
		<?php echo $form->textField($model,'am_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_referance'); ?>
		<?php echo $form->textField($model,'am_referance',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_year'); ?>
		<?php echo $form->textField($model,'am_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_period'); ?>
		<?php echo $form->textField($model,'am_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_branch'); ?>
		<?php echo $form->textField($model,'am_branch',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_note'); ?>
		<?php echo $form->textField($model,'am_note',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_status'); ?>
		<?php echo $form->textField($model,'am_status',array('size'=>20,'maxlength'=>20)); ?>
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
		<?php echo $form->textField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
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