<?php
/* @var $this ImtransactionController */
/* @var $model Imtransaction */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imtransaction-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'im_number'); ?>
		<?php echo $form->textField($model,'im_number',array('readonly'=>true )); ?>
		<?php echo $form->error($model,'im_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php // echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>
		
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'cm_code',
				'model'=>$model,
				'attribute'=>'cm_code',
				'source'=>CController::createUrl('/Imtransaction/GetCmNames'),
				'options'=>array(
					'minLength'=>'1', 
					'select'=>'js:function(event, ui){
						$("#cm_code").text(ui.item.value);
						$("#productnameid").text(ui.item.label);
					}'
				),
				'htmlOptions'=>array(
					'id'=>'cm_code',
					//'rel'=>'val',

				),
			));
		?> <div id="productnameid"></div>
		
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_storeid'); ?>
		<?php echo $form->dropDownList($model,'im_storeid', CHtml::listData(Branchmaster::model()->findAll(), 'cm_branch', 'cm_branch' ), array('empty'=>'Please Select Warehouse')); ?>
		<?php echo $form->error($model,'im_storeid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'im_BatchNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_date'); ?>
		<?php //echo $form->textField($model,'im_date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_date', //attribute name
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
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
			),
		));?> 
		<?php echo $form->error($model,'im_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_ExpireDate'); ?>
		<?php // echo $form->textField($model,'im_ExpireDate'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_ExpireDate', //attribute name
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
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d', strtotime("tomorrow")),
			),
		));?> 
		<?php echo $form->error($model,'im_ExpireDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_quantity'); ?>
		<?php echo $form->textField($model,'im_quantity', array('placeholder'=>'type recieve quantity', 'id'=>'im_quantity')); ?>
		<?php echo $form->error($model,'im_quantity'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'im_sign'); ?>
		<?php echo $form->hiddenField($model,'im_sign',  array('value'=>'1')); ?>
		<?php //echo $form->error($model,'im_sign'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_unit'); ?>
		<?php echo $form->dropDownList($model,'im_unit',  CHtml::listData(Codesparam::model()->findAll('cm_type="Unit of Measurement"'), 'cm_code', 'cm_code' ), array('empty'=>'Please Unit')); ?>
		<?php echo $form->error($model,'im_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_rate'); ?>
		<?php echo $form->textField($model,'im_rate',array('placeholder'=>'type rate', 'id'=>'im_rate')); ?>
		<?php echo $form->error($model,'im_rate'); ?>
	</div>
<script type="text/javascript">
$(function() {
	$("#im_quantity").change(function(){
	        setTarget()
	});
	    $("#im_rate").change(function(){
	        setTarget();
	});
	});

	function setTarget(){
	    var a = $("#im_quantity").val();
	    var b = $("#im_rate").val();
	    var data = (a * b);
	    $('#im_totalprice').val(data);
	}
</script>
	<div class="row">
		<?php echo $form->labelEx($model,'im_totalprice'); ?>
		<?php echo $form->textField($model,'im_totalprice',array('placeholder'=>'total price','id'=>'im_totalprice')); ?>
		<?php echo $form->error($model,'im_totalprice'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'im_RefNumber'); ?>
		<?php echo $form->hiddenField($model,'im_RefNumber',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'im_RefNumber'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'im_RefRow'); ?>
		<?php echo $form->hiddenField($model,'im_RefRow'); ?>
		<?php //echo $form->error($model,'im_RefRow'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_note'); ?>
		<?php echo $form->textField($model,'im_note',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'im_note'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'im_voucherno'); ?>
		<?php echo $form->hiddenField($model,'im_voucherno',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'im_voucherno'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'cm_supplierid'); ?>
		<?php echo $form->hiddenField($model,'cm_supplierid',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'cm_supplierid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_currency'); ?>
		<?php echo $form->textField($model,'im_currency',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'im_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_ExchangeRate'); ?>
		<?php echo $form->textField($model,'im_ExchangeRate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'im_ExchangeRate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_status'); ?>
		<?php echo $form->textField($model,'im_status', array('value'=>'Open', 'readonly'=>true)); ?>
		<?php echo $form->error($model,'im_status'); ?>
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