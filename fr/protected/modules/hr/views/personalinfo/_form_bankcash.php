
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'client-account-create-form',
    'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php // echo $form->errorSummary($model); ?>
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_type'); ?>
        <?php echo $form->textField($model,'cm_type', array('value'=>'BankCash', 'readonly' => 'true')); ?>
        <?php echo $form->error($model,'cm_type'); ?>
    </div>
	
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_code'); ?>
        <?php echo $form->textField($model,'cm_code', array('style' => 'text-transform: uppercase')); ?>
        <?php echo $form->error($model,'cm_code'); ?>
    </div>
	
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_desc'); ?>
        <?php echo $form->textField($model,'cm_desc'); ?>
        <?php echo $form->error($model,'cm_desc'); ?>
    </div>
	
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_active'); ?>
        <?php echo $form->dropDownList($model,'cm_active', $this->getActiveOptions()); ?>
        <?php echo $form->error($model,'cm_active'); ?>
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
        <?php echo $form->hiddenField($model,'insertuser'); ?>
        <?php // echo $form->error($model,'insertuser'); ?>
    </div>
	
	
    <div class="row">
        <?php // echo $form->labelEx($model,'updateuser'); ?>
        <?php echo $form->hiddenField($model,'updateuser'); ?>
        <?php // echo $form->error($model,'updateuser'); ?>
    </div>
	
    <div class="row buttons">
    	<div class="row status-container">
                <div class="span4 action-bar">
        			<?php echo CHtml::submitButton('Submit', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        		</div>
		</div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form --> 
