<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<div class="wide form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>

	<div class="row">
		<?php echo $form->label($model,'cm_type'); ?>
		<?php echo $form->textField($model,'cm_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cm_trncode'); ?>
		<?php echo $form->textField($model,'cm_trncode'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cm_branch'); ?>
		<?php echo $form->textField($model,'cm_branch'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cm_lastnumber'); ?>
		<?php echo $form->textField($model,'cm_lastnumber'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cm_increment'); ?>
		<?php echo $form->textField($model,'cm_increment'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'cm_active'); ?>
		<?php echo $form->textField($model,'cm_active'); ?>
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
		<?php echo $form->textField($model,'insertuser'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'updateuser'); ?>
		<?php echo $form->textField($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
