<?php
/* @var $this PurchaseordhdController */
/* @var $model Purchaseordhd */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchaseordhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'pp_purordnum'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div style="float: left; width: 50%;">

	<div class="row">
		<?php echo $form->labelEx($model,'pp_purordnum'); ?>
		<?php echo $form->textField($model,'pp_purordnum',array('readonly' => 'true')); ?>
		<?php echo $form->error($model,'pp_purordnum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_date'); ?>
		<?php // echo $form->textField($model,'pp_date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'pp_date', //attribute name
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
			),
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
				'readonly'=>'true',
			)
		));?> 
		<?php echo $form->error($model,'pp_date'); ?>
	</div>


<script type="text/javascript">
		function myFunction(){
			var str = document.getElementById("selectid").value;
			document.getElementById("selectid").value = str.split("-",1);
			
		}
</script>
		

	<div class="row">
		<?php echo $form->labelEx($model,'cm_supplierid'); ?>
        <?php echo $form->dropDownlist($model,'cm_supplierid', CHtml::listData(Suppliermaster::model()->findAll(), 'cm_supplierid', 'cm_orgname'), array('empty'=>'- Select Supplier -', 'required'=> TRUE)); ?>
        <?php echo $form->error($model,'cm_supplierid'); ?>
    </div>


	<div class="row">
		<?php echo $form->labelEx($model,'pp_requisitionno'); ?>
		<?php // echo $form->dropDownList($model,'pp_requisitionno',CHtml::listData(Purchaseordhd::model()->findAll(array('order'=>'pp_requisitionno DESC', 'limit'=>'5')), 'pp_requisitionno', 'pp_requisitionno')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model, //Model object
				'name'=>'pp_requisitionno',
				'attribute'=>'pp_requisitionno', //attribute name
		        'sourceUrl' => Yii::app()->createUrl('purchaseordhd/getreqno'),
		        'options'=>array(
		            'minLength'=>'1',
					'showAnim'=>'fold',
					'type' => 'get',
					'select'=>'js:function(event, ui) {
						$("#reqno").text(ui.item.value);
					}'
		        ),
		        'htmlOptions'=>array(
		            'class'=>'input-1',
		          	'id' =>'reqno',
		        ),
		    )); ?>

		<?php echo $form->error($model,'pp_requisitionno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_payterms'); ?>
		<?php echo $form->textField($model,'pp_payterms',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'pp_payterms'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pp_deliverydate'); ?>
		<?php // echo $form->textField($model,'pp_deliverydate'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'pp_deliverydate', //attribute name
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
					
			),
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
				'readonly'=>'true',
			)
		));?> 
		<?php echo $form->error($model,'pp_deliverydate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_store'); ?>
		<?php echo $form->textField($model,'pp_store',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'pp_store'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'pp_address'); ?>
		<?php echo $form->textArea($model,'pp_address',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'pp_address'); ?>
	</div>



</div>
        
        
<div style="float: left; width: 50%;">


	<div class="row">
		<?php echo $form->labelEx($model,'pp_taxrate'); ?>
		<?php echo $form->textField($model,'pp_taxrate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pp_taxrate'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pp_taxamt'); ?>
		<?php echo $form->textField($model,'pp_taxamt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pp_taxamt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_discrate'); ?>
		<?php echo $form->textField($model,'pp_discrate',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pp_discrate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_discamt'); ?>
		<?php echo $form->textField($model,'pp_discamt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pp_discamt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_amount'); ?>
		<?php echo $form->textField($model,'pp_amount',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'pp_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_status'); ?>
		<?php echo $form->textField($model,'pp_status', array('value'=>'Open', 'readonly' => 'true')); ?>
		<?php // echo $form->dropDownList($model,'pp_status', $this->getStatusOptions()); ?>
		<?php echo $form->error($model,'pp_status'); ?>
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