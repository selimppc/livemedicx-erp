<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Voucher'=>array('admin'),
	'Custom Journal Transaction',
);


$this->menu=array(
	//array('label'=>'List Voucher Header', 'url'=>array('index')),
	array('label'=>'<< Go Back',  'url'=>array('journalTransaction')),

);
?>
<style type="text/css">
	.ui-datepicker-trigger{
		border: 1px;
		background: lightblue;
	}
	.hasDatepicker{
		padding: 3px;
	}
	
	table tr td select, #from_date, #to_date{
		padding: 15px;
		width: 220px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
		color:blue;
	}

</style>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vouhcerheader-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'am_vouchernumber'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>



			
		
			
			
<table style="text-align: left; ">
	  <tr>
	  	<th> Branch: </th>
	    <th> From Date: </th>
	    <th> To Date: </th>
	  </tr>
	  <tr>
	  <td> <?php echo $form->dropDownList($model,'am_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('required'=>'required')); ?> </td>
	  	<td>
	  		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'model'=>$model,
					'attribute'=>'from_date', //attribute name
					'language'=> '',
					'flat'=>true,//remove to hide the datepicker
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
						'showButtonPanel'=>true,
				        //'minDate'=>-5,
				        'maxDate'=>"+1M +5D",
				),
				
				'htmlOptions'=>array(
					'value'=> CTimestamp::formatDate('Y-m-d'),
					'required' => 'required',
					'style'=>'padding: 18px; width: 75%;',
					'readonly'=>'true',
				),
			));?>  
	  	</td>
	  	<td> 
	  		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'model'=>$model,
					'attribute'=>'to_date', //attribute name
					'language'=> '',
					'flat'=>true,//remove to hide the datepicker
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
						'showButtonPanel'=>true,
				        //'minDate'=>0,
				        //'maxDate'=>"+1M +5D",
				),
				
				'htmlOptions'=>array(
					'value'=> CTimestamp::formatDate('Y-m-d'),
					'required' => 'required',
					'style'=>'padding: 18px; width: 75%;',
					'readonly'=>'true',
				),
			));?> 	
	  	</td>
	  </tr>
</table>


			<?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
	
<?php $this->endWidget(); ?>

