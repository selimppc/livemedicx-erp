<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */
/* @var $form CActiveForm */
?>
<div style="width: 100%; float: left;"> 

<div style="width: 44%; float: left;"> 

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grndetail-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'im_grnnumber'); ?>
		<?php // echo $form->dropDownList($model,'im_grnnumber',CHtml::listData(Grnheader::model()->findAll(array('order'=>'im_grnnumber DESC', 'limit'=>'1')), 'im_grnnumber', 'im_grnnumber'), array('id'=>"grnnumber")); ?>
		<?php echo $form->textField($model,'im_grnnumber',array('readonly' => 'true') ); ?>
		<?php echo $form->error($model,'im_grnnumber'); ?>
	</div>	


	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php echo $form->textField($model, 'cm_code' ); ?>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	<div class="row" style="background: #efefef; width: 60%; margin-left: 29%; padding-left: 3px; margin-bottom: 10px;">
		<?php $x = Productmaster::model()->findByAttributes( array('cm_code'=>$cm_code));
       		  $y = $x['cm_name'];
       		  echo $y; 
       ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber', array('placeholder'=>'type batch number')); ?>
		<?php echo $form->error($model,'im_BatchNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_ExpireDate'); ?>
		<?php // echo $form->textField($model,'im_ExpireDate' ); ?>
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
				// 'value'=>CTimestamp::formatDate('Y-m-d'),

			)
		));?> 
		<?php echo $form->error($model,'im_ExpireDate'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_unit'); ?>
		<?php  echo $form->textField($model,'im_unit', array('readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_unit'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'im_unitqty'); ?>
		<?php echo $form->textField($model,'im_unitqty', array('readonly'=>TRUE) ); ?> 
		<?php echo $form->error($model,'im_unitqty'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_RcvQuantity'); ?>
		<?php //echo $form->textField($model,'im_RcvQuantity',  array('id'=>'rcvquantity') ); ?>
		<?php echo $form->textField($model,'im_RcvQuantity',  array('id'=>'rcvquantity') ); ?> 
       		  
		<?php echo $form->error($model,'im_RcvQuantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_costprice'); ?>
		<?php echo $form->textField($model,'im_costprice', array('id'=>'purchasrate', 'readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_costprice'); ?>
	</div>

<script type="text/javascript">
$(function() {
	$("#rcvquantity").change(function(){
	        setTarget()
	});
	    $("#purchasrate").change(function(){
	        setTarget();
	});
	});

	function setTarget(){
	    var a = $("#rcvquantity").val();
	    var b = $("#purchasrate").val();
	    var data = (a * b);
	    $('#rowamount').val(data);
	}
</script>
	<div class="row">
		<?php echo $form->labelEx($model,'im_rowamount'); ?>
		<?php echo $form->textField($model,'im_rowamount',array('id'=>'rowamount', 'readonly'=>TRUE )); ?>
		<?php echo $form->error($model,'im_rowamount'); ?>
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
</div>




<div style="width: 53%;float: left; margin-left: 2%;"> 

</div>
</div>