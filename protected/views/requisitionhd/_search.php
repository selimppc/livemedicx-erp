<?php
/* @var $this RequisitionhdController */
/* @var $model Requisitionhd */
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
		<?php echo $form->label($model,'pp_requisitionno'); ?>
		<?php echo $form->textField($model,'pp_requisitionno',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_supplierid'); ?>
		<?php echo $form->textField($model,'cm_supplierid',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_date'); ?>
		<?php echo $form->textField($model,'pp_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_branch'); ?>
		<?php echo $form->textField($model,'pp_branch',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_note'); ?>
		<?php echo $form->textField($model,'pp_note',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_status'); ?>
		<?php echo $form->textField($model,'pp_status',array('size'=>50,'maxlength'=>50)); ?>
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