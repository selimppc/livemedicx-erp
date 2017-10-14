<?php
/* @var $this PersonalinfoController */
/* @var $model Personalinfo */
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
	background: #FEFCE3;
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
.hr_input_field, #Personalinfo_currency, #Personalinfo_branch{
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
	'id'=>'personalinfo-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'empid'),
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model,'empid'); ?><br>
		<?php echo $form->textField($model,'empid',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'empname'); ?><br>
		<?php echo $form->textField($model,'empname',array('size'=>60,'maxlength'=>150)); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'doj'); ?><br>
		<?php //echo $form->textField($model,'doj'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'doj', //attribute name
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
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'doc'); ?><br>
		<?php // echo $form->textField($model,'doc'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'doc', //attribute name
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
					//'minDate'=>'+0',
					//'minDate'=> date("Y-m-d"),
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
			),
		));?> 
	</div>
	<div id="part_20">
	 	<?php echo $form->labelEx($model,'grade'); ?><br>
		<?php echo $form->dropDownList($model,'grade', CHtml::listData(Codesparam::model()->findAll('cm_type="Position"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
	</div>
</div>



<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model,'deptname'); ?><br>
		<?php echo $form->dropDownList($model,'deptname', CHtml::listData(Codesparam::model()->findAll('cm_type="Department"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'designation'); ?><br>
		<?php echo $form->dropDownList($model,'designation', CHtml::listData(Codesparam::model()->findAll('cm_type="Designation"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'bank'); ?><br>
		<?php echo $form->dropDownList($model,'bank', CHtml::listData(Codesparam::model()->findAll('cm_type="BankCash"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'acccode'); ?><br>
		<?php echo $form->textField($model,'acccode',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'amount'); ?><br>
		<?php echo $form->textField($model,'amount',array('value'=>'0.00', 'style'=>'text-align: right;')); ?>
	</div>
	
</div>


<div id="box_input_id">
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'branch'); ?>
		<?php echo $form->dropDownList($model,'branch',CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'),
			array(
                        'empty'=>'- Select Branch -',
                        'ajax'=>array(
                            'type'=>'POST',
                            'url' => CController::createUrl('trnheader/GetExchagerate'),
                            //'update' => '#currency',  
							'data'=>array('store'=>'js:this.value'), 
            				'success'=> 'function(data) {$("#exchangerate").empty();
                           		$("#exchangerate").val(data);
                           		// getPackages(data);
                           	} ', 

                        ))
		); ?>

	</div>

<?php Yii::app()->clientScript->registerScript("selimreza1","
        function getPackages(data){
            $.ajax({
                url: '". $this->createUrl('trnheader/DynamicCurrency')."',
                data: 'value='+data,

                success: function(packages) {
                         $('#".CHtml::activeId($model, 'currency')."').html(packages);
                      }
            });
        }
	",CClientScript::POS_END);
?>


	
	<div id="part_20">
	 	<?php echo $form->labelEx($model,'currency'); ?><br>
		<?php // echo $form->dropDownList($model,'currency', array()); ?>
		<?php $storeArray = CHtml::listData(Branchcurrency::model()->findAll(),'cm_currency','cm_currency');
           echo $form->dropDownList($model,'currency', $storeArray, 
                          array(
                          		'empty'=>"- Select Currency -",
                                'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('personalinfo/GetCurrency' ),
	                          		//'success'=>'js:function(data){$("#currencyid").val(data);}', 
                          			'update' => '#exchangerate',  
									'data'=>array('store'=>'js:this.value',),   
            						'success'=> 'function(data) {$("#exchangerate").empty();
                           		 		$("#exchangerate").val(data);
                           		 	} ', 
                          ),
                 			     
            )); ?>
	</div>
	
	<div id="part_20">
		<?php echo $form->labelEx($model,'exchangerate'); ?><br>
		<?php echo $form->textField($model,'exchangerate',array('value'=>'0.00', 'id'=>'exchangerate', 'readonly'=>'readonly', 'style'=>'text-align: right;')); ?>
	</div>
	
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'dob'); ?><br>
		<?php // echo $form->textField($model,'dob'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'dob', //attribute name
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
					'yearRange'=>'1960:today', 
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
			),
			
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d'),
			),
		));?> 
	</div>
	<div id="part_20">
	 	<?php echo $form->labelEx($model,'gender'); ?><br>
		<?php echo $form->dropDownList($model,'gender',array('Male'=>'Male','Female'=>'Female'), array('class'=>'hr_input_field')); ?>
	</div>
</div>


<div id="box_input_id">
	<div id="part_50">
		<?php echo $form->labelEx($model,'present'); ?><br>
		<?php echo $form->textArea($model,'present',array('size'=>60,'maxlength'=>300)); ?>
	</div>
	<div id="part_50"> 
		<?php echo $form->labelEx($model,'parmanent'); ?><br>
		<?php echo $form->textArea($model,'parmanent',array('size'=>60,'maxlength'=>300)); ?>
	</div>
	
</div>



<div id="box_input_id">
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'cellno'); ?><br>
		<?php echo $form->textField($model,'cellno',array('size'=>20,'maxlength'=>20)); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'phone'); ?><br>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>
	<div id="part_20">
	 	<?php echo $form->labelEx($model,'email'); ?><br>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'leaveplan'); ?><br>
		<?php echo $form->dropDownList($model,'leaveplan', CHtml::listData(Codesparam::model()->findAll('cm_type="Leave Plan"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
	</div>
	<div id="part_20"> 
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array('Open'=>'Open','Close'=>'Close'), array('class'=>'hr_input_field')); ?>
	</div>

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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php // echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php // echo $form->error($model,'updateuser'); ?>
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