<?php
/* @var $this CompanyprofileController */
/* @var $model Companyprofile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'companyprofile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shortdescription'); ?>
		<?php echo $form->textArea($model,'shortdescription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'shortdescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longdescription'); ?>
		<?php echo $form->textArea($model,'longdescription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'longdescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php echo $form->fileField($model,'photo'); ?>
		<?php echo $form->error($model,'photo'); ?> 
	</div>
        <?php if($model->isNewRecord!='1'){ ?>
        <div class="row">
             <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/companyprofile/'.$model->photo, "photo",array("width"=>200)); ?>  // Image shown here if page is update page
        </div>
        <?php } ?>
	<div class="row buttons">
            <div class="row status-container">
                <div class="span4 action-bar">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
                </div>
            </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->