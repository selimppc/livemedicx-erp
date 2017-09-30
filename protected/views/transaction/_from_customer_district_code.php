<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'client-account-create-form',
    'enableAjaxValidation'=>false,
		'focus'=>array($model,'cm_trncode'),
        'enableClientValidation'=>true,
)); ?>



    <?php echo $form->errorSummary($model); ?>
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_type'); ?>
        <?php echo $form->textField($model,'cm_type', array('readonly' => 'true')); ?>
        <?php echo $form->error($model,'cm_type'); ?>
    </div>
	
	
    <div class="row">
        <label> District Code <span style="color: red;">*</span></label>
        <?php echo $form->textField($model,'cm_trncode', array('style'=>'text-transform: uppercase', $model->isNewRecord ? '' : "readonly"=>True, "required"=>true)); ?>
        <?php // echo $form->error($model,'cm_trncode'); ?>
    </div>
	
	<div class="row">
        <label> District Name <span style="color: red;">*</span></label>
        <?php echo $form->textField($model,'cm_branch', array("required"=>true)); ?>
        <?php echo $form->error($model,'cm_branch'); ?>
    </div>
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_lastnumber'); ?>
        <?php echo $form->textField($model,'cm_lastnumber', array('value'=>'0')); ?>
        <?php echo $form->error($model,'cm_lastnumber'); ?>
    </div>
	
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_increment'); ?>
        <?php echo $form->textField($model,'cm_increment', array('value'=>'1')); ?>
        <?php echo $form->error($model,'cm_increment'); ?>
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
        <?php echo $form->hiddenField($model,'insertuser'); ?>
        <?php //echo $form->error($model,'insertuser'); ?>
    </div>
	
	
    <div class="row">
        <?php //echo $form->labelEx($model,'updateuser'); ?>
        <?php echo $form->hiddenField($model,'updateuser'); ?>
        <?php //echo $form->error($model,'updateuser'); ?>
    </div>
	
    <div class="row buttons">
        <?php //echo CHtml::submitButton('Submit', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Enter District Code' : 'Update District Code', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form --> 
