<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */
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
		<?php echo $form->label($model,'pp_purordnum'); ?>
		<?php echo $form->textField($model,'pp_purordnum',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_serialno'); ?>
		<?php echo $form->textField($model,'pp_serialno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_quantity'); ?>
		<?php echo $form->textField($model,'pp_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_grnqty'); ?>
		<?php echo $form->textField($model,'pp_grnqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_unit'); ?>
		<?php echo $form->textField($model,'pp_unit',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_unitqty'); ?>
		<?php echo $form->textField($model,'pp_unitqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pp_purchasrate'); ?>
		<?php echo $form->textField($model,'pp_purchasrate',array('size'=>20,'maxlength'=>20)); ?>
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