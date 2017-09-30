<?php
/* @var $this TransferhdController */
/* @var $model Transferhd */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transferhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'im_note'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'im_transfernum'); ?>
		<?php echo $form->textField($model,'im_transfernum',array('readonly' => true)); ?>
		<?php echo $form->error($model,'im_transfernum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_date'); ?>
		<?php // echo $form->textField($model,'im_date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_date', //attribute name
				'language'=> '',
				'mode'=>'date', 
				'options'=>array(
					'dateFormat' => 'yy-mm-dd',
					'showAnim'=>'fold',
					'changeMonth' => 'true',
					'changeYear' => 'true',
					'showOtherMonths' => 'true',
					'selectOtherMonths' => 'true',
					'showOn' => 'both',
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			
			'htmlOptions'=>array(
				
			),
		));?> 
		<?php echo $form->error($model,'im_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_condate'); ?>
		<?php // echo $form->textField($model,'im_condate'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_condate', //attribute name
				'language'=> '',
				'mode'=>'date', 
				'options'=>array(
					'dateFormat' => 'yy-mm-dd',
					'showAnim'=>'fold',
					'changeMonth' => 'true',
					'changeYear' => 'true',
					'showOtherMonths' => 'true',
					'selectOtherMonths' => 'true',
					'showOn' => 'both',
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			
			'htmlOptions'=>array(
				
			),
		));?> 
		<?php echo $form->error($model,'im_condate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_note'); ?>
		<?php echo $form->textField($model,'im_note',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'im_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_fromstore'); ?>
		<?php //echo $form->dropDownlist($model,'im_fromstore', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_branch'),array('empty'=>'Select From Store ') ); ?>
		<?php echo $form->textField($model,'im_fromstore', array('readonly'=> true) ); ?>
		<?php echo $form->error($model,'im_fromstore'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_tostore'); ?>
		<?php echo $form->dropDownlist($model,'im_tostore', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'),array('empty'=>'Select TO Store') ); ?>
		<?php echo $form->error($model,'im_tostore'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_status'); ?>
		<?php echo $form->textField($model,'im_status', array('value'=>'Open', 'readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_status'); ?>
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
		<?php // echo $form->error($model,'updateuser'); ?>
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