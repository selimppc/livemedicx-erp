<?php
/* @var $this GroupthreeController */
/* @var $model Groupthree */
/* @var $form CActiveForm */
?>

<div style="width: 98%; float: left;"> 
	<div style="width: 45%; float: left;"> 
	

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupthree-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'am_groupthree'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'am_groupone'); ?>
		<?php echo $form->textField($model,'am_groupone', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'am_groupone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_grouptwo'); ?>
		<?php echo $form->textField($model,'am_grouptwo', array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'am_grouptwo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_groupthree'); ?>
		<?php echo $form->textField($model,'am_groupthree',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_groupthree'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_description'); ?>
		<?php echo $form->textField($model,'am_description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_description'); ?>
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
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
		 </div>
	</div>	 
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


</div>

<div style="width: 50%; float: left; margin-left: 5%; line-height: 6px;"> 

<h1>List Group Three</h1>
	
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'groupthree-grid',
			'dataProvider'=>Groupthree::model()->search(),
			//'filter'=>$model,
			'columns'=>array(
				//'id',
				'am_groupone',
				'am_grouptwo',
				'am_groupthree',
				'am_description',
		
			),
		)); ?>
	</div>

</div>
