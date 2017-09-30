<?php
/* @var $this BatchtransferController */
/* @var $model Batchtransfer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batchtransfer-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'im_transfernum'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'im_transfernum'); ?>
		<?php echo $form->textField($model,'im_transfernum',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'im_transfernum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'im_BatchNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_ExpDate'); ?>
		<?php echo $form->textField($model,'im_ExpDate'); ?>
		<?php echo $form->error($model,'im_ExpDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_quantity'); ?>
		<?php echo $form->textField($model,'im_quantity'); ?>
		<?php echo $form->error($model,'im_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_unit'); ?>
		<?php echo $form->textField($model,'im_unit',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'im_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_rate'); ?>
		<?php echo $form->textField($model,'im_rate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'im_rate'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'inserttime'); ?>
		<?php echo $form->hiddenField($model,'inserttime'); ?>
		<?php //echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->hiddenField($model,'updatetime'); ?>
		<?php //echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'insertuser'); ?>
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<div class="row status-container">
            <div class="span4 action-bar">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->