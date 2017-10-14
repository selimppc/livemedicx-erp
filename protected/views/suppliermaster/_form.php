<?php
/* @var $this SuppliermasterController */
/* @var $model Suppliermaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'suppliermaster-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_supplierid'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <div style="float: left; width: 50%;">
	<div class="row">
		<?php echo $form->labelEx($model,'cm_supplierid'); ?>
		<?php echo $form->textField($model,'cm_supplierid', array($model->isNewRecord ? '' : "readonly"=>True, 'required'=>TRUE )); ?>
		<?php echo $form->error($model,'cm_supplierid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_group'); ?>
		<?php echo $form->dropDownList($model,'cm_group' , CHtml::listData(Codesparam::model()->findAll('cm_type="Supplier Group"'), 'cm_code', 'cm_code')); ?>
		<?php echo $form->error($model,'cm_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_orgname'); ?>
		<?php echo $form->textField($model,'cm_orgname',array( 'required'=>TRUE )); ?>
		<?php echo $form->error($model,'cm_orgname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_address'); ?>
		<?php echo $form->textField($model,'cm_address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'cm_address'); ?>
	</div>

	<div class="row">
		<label>City</label>
		<?php echo $form->textField($model,'cm_district',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_district'); ?>
	</div>

    <div class="row">
        <label>Post/Zip Code</label>
        <?php echo $form->textField($model,'cm_postcode',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($model,'cm_postcode'); ?>
    </div>

	<div class="row">
		<label>Country</label>
		<?php echo $form->textField($model,'cm_post',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_post'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cm_policest'); ?>
		<?php //echo $form->textField($model,'cm_policest',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'cm_policest'); ?>
	</div>



             </div>
        
        
        
        
        <div style="float: left; width: 50%;">
            
	<div class="row">
		<?php echo $form->labelEx($model,'cm_contactperson'); ?>
		<?php echo $form->textField($model,'cm_contactperson',array( 'required'=>TRUE )); ?>
		<?php echo $form->error($model,'cm_contactperson'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_phone'); ?>
		<?php echo $form->textField($model,'cm_phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cm_phone'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'cm_cellphone'); ?>
		<?php echo $form->textField($model,'cm_cellphone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_cellphone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_fax'); ?>
		<?php echo $form->textField($model,'cm_fax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cm_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_email'); ?>
		<?php echo $form->emailField($model,'cm_email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_url'); ?>
		<?php echo $form->textField($model,'cm_url',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_status'); ?>
		<?php echo $form->dropDownList($model,'cm_status', $this->getStatusOptions()); ?>
		<?php echo $form->error($model,'cm_status'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'inserttime'); ?>
		<?php echo $form->hiddenField($model,'inserttime'); ?>
		<?php // echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->hiddenField($model,'updatetime'); ?>
		<?php // echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'insertuser'); ?>
		<?php echo $form->hiddenField($model,'insertuser', array('size'=>50,'maxlength'=>50)); ?>
		<?php // echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php // echo $form->error($model,'updateuser'); ?>
	</div>
            
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