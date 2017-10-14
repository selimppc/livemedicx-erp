<?php
/* @var $this PurchaseordhdController */
/* @var $model Purchaseordhd */
/* @var $form CActiveForm */
?>

<style type="text/css">
#part_20 input{
	background: none;
	padding: 5px;
	width: 95%;
	color: #666;
}

#part_20 label, #part_50 label{
	font-size: 14px;
}
#part_50 textarea{
	background: none;
	padding: 3px;
	width: 99%;
	color: #666;
	font-size: 12px;
	height: 43px;
}
#part_20{
	width: 19%; 
	float: left;
	/*background: #FEFCE3;*/
	background: #D3E2EF;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 3px;
	line-height: 22px;
}
#part_20:hover{
	background: white;

}

#part_20 input:focus, #part_50 textarea:focus{ 
			background-color: white;
		}
		
#part_50{
	width: 48.5%; 
	float: left;
	background: #FEFCE3;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 3px;
	line-height: 22px;
}
#part_50:hover{
	background: white;

}

#box_input_id{
	width: 99%; 
	float: left; 
	margin-bottom: -1px;
	margin-left: 1%;
}
.hr_input_field, #Purchaseordhd_pp_store{
	width: 99%; 
	float: left; 
	background: none;
	padding: 2.5px;
	color: #666;
}
.ui-datepicker-trigger{
	text-align: right;
	margin-left: 45px;
}
</style>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchaseordhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'pp_purordnum'),
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php // echo $form->errorSummary($model); ?>
	
<h3>Purchase Header</h3>	
<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_purordnum', array('style'=>'width: 180px; color: #FF7700;')); ?>
		<?php echo $form->textField($model,'pp_purordnum', array('readonly' => 'true')); ?>
		<?php // echo $form->error($model,'pp_purordnum'); ?>
	</div>	
	<div id="part_20">
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
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
			)
		));?> 
		<?php echo $form->error($model,'pp_date'); ?>
	</div>	
	<div id="part_20">
		<?php echo $form->labelEx($model,'cm_supplierid', array('style'=>' color: #FF7700;')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		        'name'=>'cm_supplierid',
				'id' =>'selectid',
				'model'=>$model, //Model object
				'attribute'=>'cm_supplierid', //attribute name
		        'sourceUrl' => Yii::app()->createUrl('Purchaseordhd/Acomplete'),
		        'options'=>array(
		            'minLength'=>'1',
					'showAnim'=>'fold',
					'type' => 'get',
					
		        ),
		 
		        'htmlOptions'=>array(
		            'class'=>'input-1',
		          	'onblur' => "myFunction()",
		        	'placeholder'=>'search by supplier name',
		        ),
		    )); ?>


		<?php echo $form->error($model,'cm_supplierid'); ?>
	</div>	
	<div id="part_20">
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
		        	'placeholder'=>'search by typing R',
		        ),
		    )); ?>

		<?php echo $form->error($model,'pp_requisitionno'); ?>
	</div>	
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_payterms'); ?>
		<?php echo $form->dropDownList($model,'pp_payterms',array('Cash'=>'Cash','Credit'=>'Credit'), array('class'=>'hr_input_field')); ?>
		<?php echo $form->error($model,'pp_payterms'); ?>
	</div>	
</div>	

<script type="text/javascript">
		function myFunction(){
			var str = document.getElementById("selectid").value;
			document.getElementById("selectid").value = str.split("-",1);
			
		}
</script>
		
<div id="box_input_id">
	<div id="part_20">
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
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d', strtotime("tomorrow")),
			)
		));?> 
		<?php echo $form->error($model,'pp_deliverydate'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_store', array('style'=>'width: 180px; ')); ?>
		<?php // echo $form->dropDownlist($model,'pp_store', CHtml::listData(Branchmaster::model()->findAll(), 'cm_branch', 'cm_branch')); ?>
		<?php $storeArray = CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_branch');
           echo $form->dropDownList($model,'pp_store', $storeArray, 
                          array(
                          		'empty'=>" - Select Warehouse - ",
                                'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('purchaseordhd/GetCurrency' ),
	                          		//'success'=>'js:function(data){$("#currencyid").val(data);}', 
                          			'update' => '#currencyid',  
									'data'=>array('store'=>'js:this.value',),   
            						'success'=> 'function(data) {$("#currencyid").empty();
                           		 	$("#currencyid").val(data);
                           		 	} ', 
                          ),
                 			     
            )); ?>
		<?php echo $form->error($model,'pp_store'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_currency'); ?>
		<?php echo $form->textField($model,'pp_currency', array('id'=>'currencyid', 'readonly'=> true)); ?>
		<?php echo $form->error($model,'pp_currency'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_discrate'); ?>
		<?php echo $form->textField($model,'pp_discrate',array('class'=>'discrate', 'id'=>'discrate' )); ?>
		<?php echo $form->error($model,'pp_discrate'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_discamt'); ?>
		<?php echo $form->textField($model,'pp_discamt',array('class'=>'discamt', 'id'=>'discamt', 'readonly'=>true )); ?>
		<?php echo $form->error($model,'pp_discamt'); ?>
	</div>
</div>
<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_amount'); ?>
		<?php echo $form->textField($model,'pp_amount', array('class'=>'amount', 'id'=>'amount', 'readonly' => true ) ); ?>
		<?php echo $form->error($model,'pp_amount'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'pp_status'); ?>
		<?php echo $form->textField($model,'pp_status', array('value'=>'Open', 'readonly' => 'true')); ?>
		<?php // echo $form->dropDownList($model,'pp_status', $this->getStatusOptions()); ?>
		<?php echo $form->error($model,'pp_status'); ?>
	</div>

</div>

<p> &nbsp; </p>
<h3>Purchase Details</h3>
<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model2,'cm_code', array('style'=>' color: #FF7700;')); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'cm_code',
				'model'=>$model2,
				'attribute'=>'cm_code',
				'source'=>CController::createUrl('/purchaseorddt/CodeQuantityUnit'),
				'options'=>array(
					'minLength'=>'1', 
					'select'=>'js:function(event, ui){
						$("#cm_code").text(ui.item.value);
						$("#product_name_id").text(ui.item.label);
						$("#unitmeasure").text(ui.item.unit);
					}'
				),
				'htmlOptions'=>array(
					'id'=>'cm_code',
					//'rel'=>'val',
					'placeholder'=>'search by product name'
				),
			));
		?> <div id="product_name_id"> </div> 
		<?php echo $form->error($model2,'cm_code'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model2,'pp_quantity'); ?>
		<?php echo $form->textField($model2,'pp_quantity'); ?>
		<?php echo $form->error($model2,'pp_quantity'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model2,'pp_unit'); ?>
		<?php echo $form->dropDownList($model2,'pp_unit', CHtml::listData(Codesparam::model()->findAll('cm_type = "Unit Of Measurement" '), 'cm_code', 'cm_code'), array('class'=>'hr_input_field')); ?>  
		<?php echo $form->error($model2,'pp_unit'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model2,'pp_unitqty'); ?>
		<?php  echo $form->textField($model2,'pp_unitqty'); ?>
		<?php echo $form->error($model2,'pp_unitqty'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model2,'pp_purchasrate'); ?>
		<?php echo $form->textField($model2,'pp_purchasrate'); ?>
		<?php echo $form->error($model2,'pp_purchasrate'); ?>
	</div>
</div>


	
	<div class="row">
		<?php //echo $form->labelEx($model,'pp_taxrate'); ?>
		<?php // echo $form->textField($model,'pp_taxrate',array('size'=>20,'maxlength'=>20)); ?>
		<?php // echo $form->error($model,'pp_taxrate'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'pp_taxamt'); ?>
		<?php //echo $form->textField($model,'pp_taxamt',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'pp_taxamt'); ?>
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
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
			</div>
		</div>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->