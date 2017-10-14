<?php
/* @var $this BranchmasterController */
/* @var $model Branchmaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'branchmaster-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_branch'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_branch'); ?>
		<?php echo $form->textField($model,'cm_branch',array('size'=>10,'maxlength'=>10, $model->isNewRecord ? '' : "readonly"=>True)); ?>
		<?php echo $form->error($model,'cm_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_description'); ?>
		<?php echo $form->textField($model,'cm_description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cm_description'); ?>
	</div>
	

    <div class="row">
        <?php echo $form->labelEx($model,'cm_currency'); ?>
        <?php //echo $form->dropDownList($model,'pp_currency', CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description'), array('empty'=>'- Select Currency -', 'required'=>true, )); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'cm_currency', $currency, array('empty'=>'- Select Currency -', 'required'=>TRUE,

            'ajax' => array(
                'type'=>'POST',
                'url'=>CController::createUrl('purchaseordhd/GetExchangeRate' ),
                //'success'=>'js:function(data){$("#currencyid").val(data);}',
                'update' => '#exchange_rate',
                'data'=>array('store'=>'js:this.value',),
                'success'=> 'function(data) {$("#exchange_rate").empty();
                    $("#exchange_rate").val(data);
                    } ',
            ),

        ));  ?>
        <?php echo $form->error($model,'cm_currency'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_exchrate'); ?>
        <?php echo $form->textField($model,'cm_exchrate',array('id'=>'exchange_rate', 'placeholder'=>'0.00' )); ?>
        <?php echo $form->error($model,'cm_exchrate'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_contacperson'); ?>
		<?php echo $form->textField($model,'cm_contacperson',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_contacperson'); ?>
	</div>

	<div class="row">
		<label>Job Title/Position</label>
		<?php echo $form->textField($model,'cm_designation',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cm_designation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_mailingaddress'); ?>
		<?php echo $form->textArea($model,'cm_mailingaddress',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cm_mailingaddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_phone'); ?>
		<?php echo $form->textField($model,'cm_phone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cm_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_cell'); ?>
		<?php echo $form->textField($model,'cm_cell',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cm_cell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_fax'); ?>
		<?php echo $form->textField($model,'cm_fax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cm_fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', $this->getActiveOptions()); ?>
		<?php echo $form->error($model,'active'); ?>
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
		<?php // echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php // echo $form->error($model,'updateuser'); ?>
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