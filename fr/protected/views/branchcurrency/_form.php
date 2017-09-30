<?php
/* @var $this BranchcurrencyController */
/* @var $model Branchcurrency */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'branchcurrency-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_currency'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_branch'); ?>
		<?php echo $form->textField($model,'cm_branch', array('readonly'=> true)); ?>
		<?php echo $form->error($model,'cm_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_currency'); ?>
		<?php echo $form->dropDownList($model,'cm_currency', CHtml::listData(Codesparam::model()->findAll('cm_type="Currency"'), 'cm_code', 'cm_code')); ?>
		<?php echo $form->error($model,'cm_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_description'); ?>
		<?php echo $form->textField($model,'cm_description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cm_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_exchangerate'); ?>
		<?php echo $form->textField($model,'cm_exchangerate') ?>
		<?php echo $form->error($model,'cm_exchangerate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_active'); ?>
		<?php echo $form->dropDownList($model,'cm_active', $this->getActiveOptions()); ?>
		<?php echo $form->error($model,'cm_active'); ?>
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