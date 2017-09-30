<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */
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
		<?php echo $form->label($model,'im_grnnumber'); ?>
		<?php echo $form->textField($model,'im_grnnumber',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_ExpireDate'); ?>
		<?php echo $form->textField($model,'im_ExpireDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_RcvQuantity'); ?>
		<?php echo $form->textField($model,'im_RcvQuantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_costprice'); ?>
		<?php echo $form->textField($model,'im_costprice',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_unit'); ?>
		<?php echo $form->textField($model,'im_unit',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_unitqty'); ?>
		<?php echo $form->textField($model,'im_unitqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_rowamount'); ?>
		<?php echo $form->textField($model,'im_rowamount',array('size'=>20,'maxlength'=>20)); ?>
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