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
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

    <?php // echo $form->errorSummary($model); ?>
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_type'); ?>
        <?php echo $form->textField($model,'cm_type', array('readonly' => 'true')); ?>
        <?php echo $form->error($model,'cm_type'); ?>
    </div>
	
	
    <div class="row">
        <?php echo $form->labelEx($model,'cm_code'); ?>
        <?php echo $form->textField($model,'cm_code', array('style' => 'text-transform: uppercase', $model->isNewRecord ? '' : "readonly"=>True)); ?>
        <?php echo $form->error($model,'cm_code'); ?>
    </div>


    <div class="row">
        <label>Payable Account Code</label>
        <?php echo $form->DropDownList($model,'cm_acccode', CHtml::listData(Chartofaccounts::model()->findAll(array('order'=>'am_description ASC')), 'am_accountcode', 'am_description'), array('empty'=>'- Select Account -', 'required'=>TRUE) ); ?>
        <?php echo $form->error($model,'cm_acccode'); ?>
    </div>

    <div class="row">
        <label>VAT Account Code</label>
        <?php echo $form->DropDownList($model,'cm_acctax', CHtml::listData(Chartofaccounts::model()->findAll(array('order'=>'am_description ASC')), 'am_accountcode', 'am_description'), array('empty'=>'- Select VAT Account Code-', 'required'=>TRUE) ); ?>
        <?php echo $form->error($model,'cm_acctax'); ?>
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
    	<?php //echo CHtml::submitButton('Submit', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Enter Supplier Group' : 'Update Supplier Group', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form --> 
