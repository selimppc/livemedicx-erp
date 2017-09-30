<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchaseorddt-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'pp_serialno'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_purordnum'); ?>
		<?php echo $form->textField($model,'pp_purordnum', array('readonly' => 'true') ); ?>
		
		<?php echo $form->error($model,'pp_purordnum'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_serialno'); ?>
		<?php //echo $form->textField($model,'pp_serialno'); ?>
		<?php //echo $form->error($model,'pp_serialno'); ?>
	</div>

<script type="text/javascript">
		function myFunction(){
			var str = document.getElementById("getcmcode").value;
			document.getElementById("getcmcode").value = str.split("-",1);
			
		}
</script>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php
			 $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
			 'model'=>$model, //Model object
				'name'=>'cm_code',
				'attribute'=>'cm_code', //attribute name
			 'sourceUrl'=>Yii::app()->createUrl('Purchaseorddt/GetCmCode'),
			 'options'=>array(
			 'minLength'=>'1',
			 'type'=>'get',
			 'select'=>'js:function(event, ui) {
					 $("#getcmcode").text(ui.item.value);
					}'
			 ),
			 'htmlOptions'=>array(
		            'class'=>'input-1',
		          	'id' =>'getcmcode',
			 		'onblur' => "myFunction()",
		        ),
			 ));
		 ?>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_quantity'); ?>
		<?php echo $form->textField($model,'pp_quantity'); ?>
		<?php echo $form->error($model,'pp_quantity'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pp_grnqty'); ?>
		<?php //echo $form->textField($model,'pp_grnqty'); ?>
		<?php //echo $form->error($model,'pp_grnqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_unit'); ?>
		<?php echo $form->dropDownList($model,'pp_unit', CHtml::listData(Codesparam::model()->findAll('cm_type = "Unit Of Measurement" '), 'cm_code', 'cm_code')); ?>
		<?php echo $form->error($model,'pp_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_unitqty'); ?>
		<?php  echo $form->textField($model,'pp_unitqty'); ?>

		<?php echo $form->error($model,'pp_unitqty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_purchasrate'); ?>
		<?php echo $form->textField($model,'pp_purchasrate'); ?>
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
		<div class="row status-container">
                <div class="span4 action-bar">
                	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
                </div>
        </div>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->