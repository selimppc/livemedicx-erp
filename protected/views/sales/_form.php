<?php
/* @var $this SalesController */
/* @var $model Smheader */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smheader-form',
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
		<?php echo $form->labelEx($model,'sm_date'); ?>
		<?php echo $form->textField($model,'sm_date'); ?>
		<?php echo $form->error($model,'sm_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_cuscode'); ?>
		<?php echo $form->textField($model,'cm_cuscode',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cm_cuscode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_sp'); ?>
		<?php echo $form->textField($model,'sm_sp',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_sp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_doc_type'); ?>
		<?php echo $form->textField($model,'sm_doc_type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_doc_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_storeid'); ?>
		<?php echo $form->textField($model,'sm_storeid',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_storeid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_territory'); ?>
		<?php echo $form->textField($model,'sm_territory',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_territory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_rsm'); ?>
		<?php echo $form->textField($model,'sm_rsm',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_rsm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_area'); ?>
		<?php echo $form->textField($model,'sm_area',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_area'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_payterms'); ?>
		<?php echo $form->textField($model,'sm_payterms',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_payterms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_accountcode'); ?>
		<?php echo $form->textField($model,'am_accountcode',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_accountcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_chequeno'); ?>
		<?php echo $form->textField($model,'sm_chequeno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sm_chequeno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_currency'); ?>
		<?php echo $form->textField($model,'sm_currency',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'sm_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_exchrate'); ?>
		<?php echo $form->textField($model,'sm_exchrate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_exchrate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_totalamt'); ?>
		<?php echo $form->textField($model,'sm_totalamt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_totalamt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_total_tax_amt'); ?>
		<?php echo $form->textField($model,'sm_total_tax_amt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_total_tax_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_disc_rate'); ?>
		<?php echo $form->textField($model,'sm_disc_rate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_disc_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_disc_amt'); ?>
		<?php echo $form->textField($model,'sm_disc_amt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_disc_amt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_netamt'); ?>
		<?php echo $form->textField($model,'sm_netamt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_netamt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_sign'); ?>
		<?php echo $form->textField($model,'sm_sign'); ?>
		<?php echo $form->error($model,'sm_sign'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_stataus'); ?>
		<?php echo $form->textField($model,'sm_stataus',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_stataus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_refe_code'); ?>
		<?php echo $form->textField($model,'sm_refe_code',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'sm_refe_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'glvoucher'); ?>
		<?php echo $form->textField($model,'glvoucher',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'glvoucher'); ?>
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