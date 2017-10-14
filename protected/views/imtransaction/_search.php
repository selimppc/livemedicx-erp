<?php
/* @var $this ImtransactionController */
/* @var $model Imtransaction */
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
		<?php echo $form->label($model,'im_number'); ?>
		<?php echo $form->textField($model,'im_number',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_storeid'); ?>
		<?php echo $form->textField($model,'im_storeid',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_date'); ?>
		<?php echo $form->textField($model,'im_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_ExpireDate'); ?>
		<?php echo $form->textField($model,'im_ExpireDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_quantity'); ?>
		<?php echo $form->textField($model,'im_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_sign'); ?>
		<?php echo $form->textField($model,'im_sign'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_unit'); ?>
		<?php echo $form->textField($model,'im_unit',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_rate'); ?>
		<?php echo $form->textField($model,'im_rate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_totalprice'); ?>
		<?php echo $form->textField($model,'im_totalprice',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_RefNumber'); ?>
		<?php echo $form->textField($model,'im_RefNumber',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_RefRow'); ?>
		<?php echo $form->textField($model,'im_RefRow'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_note'); ?>
		<?php echo $form->textField($model,'im_note',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_status'); ?>
		<?php echo $form->textField($model,'im_status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_voucherno'); ?>
		<?php echo $form->textField($model,'im_voucherno',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_supplierid'); ?>
		<?php echo $form->textField($model,'cm_supplierid',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_currency'); ?>
		<?php echo $form->textField($model,'im_currency',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'im_ExchangeRate'); ?>
		<?php echo $form->textField($model,'im_ExchangeRate',array('size'=>20,'maxlength'=>20)); ?>
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