<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */
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
	'id'=>'purchaseorddt-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_purordnum'); ?>
		<?php echo $form->textField($model,'pp_purordnum', array('readonly' => 'true') ); ?>
		
		<?php echo $form->error($model,'pp_purordnum'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'cm_code',
				'model'=>$model,
				'attribute'=>'cm_code',
				'source'=>CController::createUrl('/purchaseorddt/CodeQuantityUnit'),
				'options'=>array(
					'minLength'=>'1', 
					'select'=>'js:function(event, ui){
						$("#cm_code").text(ui.item.value);
						$("#product_name_id").text(ui.item.label);
						$("#unitofmeasurement").val(ui.item.unitofmeasurement);
						$("#unitquantity").val(ui.item.unitquantity);
						$("#purchaserate").val(ui.item.purchaserate);
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
		<span id="product_name_id" style="margin-left: 20px; font-size: 14px; background: #E9E9E9;"></span>
	</div>
    <?php //echo $form->textField($model,'product_search', array('name'=>'product_search','value'=>'$data->product->cm_name')); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'pp_quantity'); ?>
		<?php echo $form->textField($model,'pp_quantity', array('placeholder'=>'0', 'required'=>TRUE )); ?>
		<?php echo $form->error($model,'pp_quantity'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_grnqty'); ?>
		<?php //echo $form->textField($model,'pp_grnqty'); ?>
		<?php //echo $form->error($model,'pp_grnqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_unit'); ?>
		<?php //echo $form->dropDownList($model,'pp_unit', CHtml::listData(Codesparam::model()->findAll('cm_type = "Unit Of Measurement" '), 'cm_code', 'cm_code'), array('id'=>'unitofmeasurement' )); ?>  
		<?php //echo $form->textField($model,'pp_unit', array('id'=>'unitofmeasurement' )); ?>
        <?php echo $form->dropDownlist($model,'pp_unit',CHtml::listData(Productmaster::model()->findAll(), 'cm_purunit', 'cm_purunit'), array('id'=>'unitofmeasurement' , 'empty'=>'- Select unit -', 'required'=> TRUE)); ?>
		<?php echo $form->error($model,'pp_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_unitqty'); ?>
		<?php  echo $form->textField($model,'pp_unitqty', array('id'=>'unitquantity')); ?>
		<?php echo $form->error($model,'pp_unitqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_purchasrate'); ?>
		<?php echo $form->textField($model,'pp_purchasrate',  array('id'=>'purchaserate' )); ?>
		<?php echo $form->error($model,'pp_purchasrate'); ?>
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
          	<?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1', 'style'=>'padding-top: 25px;')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Purchase Detail' : 'Update Purchase Dt.', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->