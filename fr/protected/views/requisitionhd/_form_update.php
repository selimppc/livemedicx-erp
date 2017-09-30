<?php
/* @var $this RequisitionhdController */
/* @var $model Requisitionhd */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requisitionhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_supplierid'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_requisitionno'); ?>
		<?php echo $form->textField($model,'pp_requisitionno', array('readonly' => 'true')); ?>
		<?php echo $form->error($model,'pp_requisitionno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_supplierid'); ?>
		<?php echo $form->dropDownList($model,'cm_supplierid', CHtml::listData(Suppliermaster::model()->findAll(),'cm_supplierid','cm_orgname'),array('empty'=>'Select Supplier')); ?>
		<?php echo $form->error($model,'cm_supplierid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'pp_date', //attribute name
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
			),
			
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
			),
		));?> 
		<?php echo $form->error($model,'pp_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_branch'); ?>
		<?php echo $form->textField($model,'pp_branch',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pp_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_note'); ?>
		<?php echo $form->textField($model,'pp_note',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'pp_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_status'); ?>
		<?php //echo $model->pp_status='Open'; ?>
		<?php echo $form->textField($model,'pp_status', array('value'=>'Open', 'readonly' => 'true')); ?>
		<?php // echo $form->dropDownList($model,'pp_status', $this->getStatusOptions()); ?>
		<?php echo $form->error($model,'pp_status'); ?>
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