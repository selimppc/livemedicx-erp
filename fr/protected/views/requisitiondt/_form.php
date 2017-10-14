<?php
/* @var $this RequisitiondtController */
/* @var $model Requisitiondt */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requisitiondt-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,

)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_requisitionno'); ?>
		<?php echo $form->textField($model,'pp_requisitionno' ); ?>
		<?php echo $form->error($model,'pp_requisitionno'); ?>
	</div>
	
	<div class="row" >
		<?php echo $form->labelEx($model, 'cm_code'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'cm_code',
				'model'=>$model,
				'attribute'=>'cm_code',
				'source'=>CController::createUrl('/Requisitiondt/Acomplete'),
				'options'=>array(
					'minLength'=>'1', 
					'select'=>'js:function(event, ui){
						$("#cm_code").text(ui.item.value);
						$("#productname").text(ui.item.label);
						$("#unitid").val(ui.item.unit);
						$("#unitquantity").text(ui.item.unitquantity);


					}'
				),
				'htmlOptions'=>array(
					'id'=>'cm_code',
					//'rel'=>'val',
					'placeholder'=>'search by product name',
                    'readonly'=>$model->isNewRecord ? '' : True,
				),
			));
		?> 

		<?php echo $form->error($model,'cm_code'); ?>
	</div>
	<div class="row" style="margin-bottom: 10px">
		Product Description: 
		<span id="productname" style="margin-left: 20px; font-size: 14px; background: #E9E9E9;"></span>
	</div>

	<div class="row" id="drophidden">
		<?php echo $form->labelEx($model,'pp_unit'); ?>
		<?php echo $form->textField($model,'pp_unit', array('class'=>'unitclass', 'id'=>'unitid', 'readonly'=>TRUE));?>
		<?php echo $form->error($model,'pp_unit'); ?>
	</div>

    <div class="row">
        <label>Unit Quantity</label>
        <span style="margin-left: 5px;" id="unitquantity">Hello</span>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'pp_quantity'); ?>
		<?php echo $form->textField($model,'pp_quantity', array('required'=>True)); ?>
		<?php echo $form->error($model,'pp_quantity'); ?>
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
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Requisition Detail' : 'Update Requisition', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


