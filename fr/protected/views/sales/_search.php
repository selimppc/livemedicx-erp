<?php
/* @var $this SalesController */
/* @var $model Smheader */
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
		<?php echo $form->label($model,'sm_date'); ?>
		<?php echo $form->textField($model,'sm_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cm_cuscode'); ?>
		<?php echo $form->textField($model,'cm_cuscode',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_sp'); ?>
		<?php echo $form->textField($model,'sm_sp',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_doc_type'); ?>
		<?php echo $form->textField($model,'sm_doc_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_storeid'); ?>
		<?php echo $form->textField($model,'sm_storeid',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_territory'); ?>
		<?php echo $form->textField($model,'sm_territory',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_rsm'); ?>
		<?php echo $form->textField($model,'sm_rsm',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_area'); ?>
		<?php echo $form->textField($model,'sm_area',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_payterms'); ?>
		<?php echo $form->textField($model,'sm_payterms',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'am_accountcode'); ?>
		<?php echo $form->textField($model,'am_accountcode',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_chequeno'); ?>
		<?php echo $form->textField($model,'sm_chequeno',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_currency'); ?>
		<?php echo $form->textField($model,'sm_currency',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_exchrate'); ?>
		<?php echo $form->textField($model,'sm_exchrate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_totalamt'); ?>
		<?php echo $form->textField($model,'sm_totalamt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_total_tax_amt'); ?>
		<?php echo $form->textField($model,'sm_total_tax_amt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_disc_rate'); ?>
		<?php echo $form->textField($model,'sm_disc_rate',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_disc_amt'); ?>
		<?php echo $form->textField($model,'sm_disc_amt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_netamt'); ?>
		<?php echo $form->textField($model,'sm_netamt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_sign'); ?>
		<?php echo $form->textField($model,'sm_sign'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_stataus'); ?>
		<?php echo $form->textField($model,'sm_stataus',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sm_refe_code'); ?>
		<?php echo $form->textField($model,'sm_refe_code',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'glvoucher'); ?>
		<?php echo $form->textField($model,'glvoucher',array('size'=>50,'maxlength'=>50)); ?>
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