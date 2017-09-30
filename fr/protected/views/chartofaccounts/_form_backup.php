<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chartofaccounts-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'am_accountcode'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'am_accountcode'); ?>
		<?php echo $form->textField($model,'am_accountcode',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_accountcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_description'); ?>
		<?php echo $form->textField($model,'am_description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'am_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_accounttype'); ?>
		<?php //echo $form->radioButtonList($model,'am_accounttype',array('male'=>'male','female'=>'female')); ?>
		<?php echo $form->radioButton($model,'am_accounttype',array('value'=>5,'uncheckValue'=>null)); ?>
		<?php echo $form->radioButton($model,'am_accounttype',array('value'=>5,'uncheckValue'=>null)); ?>
		<?php echo $form->error($model,'am_accounttype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_accountusage'); ?>
		<?php echo $form->textField($model,'am_accountusage',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_accountusage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_groupone'); ?>
		<?php echo $form->textField($model,'am_groupone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_groupone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_grouptwo'); ?>
		<?php echo $form->textField($model,'am_grouptwo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_grouptwo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_groupthree'); ?>
		<?php echo $form->textField($model,'am_groupthree',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_groupthree'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_groupfour'); ?>
		<?php echo $form->textField($model,'am_groupfour',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_groupfour'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_analyticalcode'); ?>
		<?php echo $form->textField($model,'am_analyticalcode',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'am_analyticalcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_branch'); ?>
		<?php echo $form->textField($model,'am_branch',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_status'); ?>
		<?php echo $form->textField($model,'am_status',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_status'); ?>
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
		<?php echo $form->textField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'updateuser'); ?>
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