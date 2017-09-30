<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Sales',
	'Reports'=>array('sareport/salesReports'),
	'Sales Report',
);

$this->menu=array(
	array('label'=>'<< Back to Report', 'url'=>array('sareport/salesReports')),
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
		width: 170px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
		color:blue;
		font-size: 18px;
		}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Customer Ledger Report :</b> Select customer and input desire dates, from and to. To view report in pdf or xls click on <b>"PDF"</b> or <b>"XLS"</b> . *** Data Posting to GL is necessary for viewing and result. You can go back to the <b>Report Tools</b> to view all Report tools by clicking the menu tab  <b>“ << Back to Report”</b>. </div>
</div>

<div style="clear: both;"></div>

<form action="../../reports/sales_report.php" target="_blank">

<table style="text-align: left; ">
	  <tr>
	  	<th>Branch:</th>
	    <th>Customer Type: </th>
	    <th> From Date: </th>
	    <th> To Date: </th>
	  </tr>
	  <tr>
	  	<td><?php echo CHtml::activeDropDownList($model,'cm_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')),'cm_branch','cm_description'),array('prompt'=>'All Branch') );?></td>
	  	<td> <?php echo CHtml::activeDropDownList($model, 'cm_group', CHtml::listData(Codesparam::model()->findAll('cm_type="Customer Group"'), 'cm_code', 'cm_code'),array('empty'=>'All Customer Type')); ?></td>
	  	<td>
	  		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'name'=>'from_date', //attribute name
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
						//'showButtonPanel'=>true,
				        //'minDate'=>-5,
				        'maxDate'=>"+1M +5D",
				),
				
				'htmlOptions'=>array(
					'value'=> CTimestamp::formatDate('Y-m-d'),
					'required' => 'required',
				),
			));?>  
	  	</td>
	  	<td> 
	  		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'name'=>'to_date', //attribute name
					'model'=>'model',
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
						//'showButtonPanel'=>true,
				        //'minDate'=>-5,
				        //'maxDate'=>"+1M +5D",
				),
				
				'htmlOptions'=>array(
					'value'=> CTimestamp::formatDate('Y-m-d'),
					'required' => 'required',
				),
			));?> 	
	  	</td>

	  </tr>
</table>
<div class="row buttons">
            <div class="row status-container">
                <div class="span4 action-bar">
	
			<input type="submit" class="action-btn" id="action-btn-4" style="margin-right: 10px;" value="See Report">
		 </div>
		</div>
	</div>
	
<?php echo CHtml::endForm(); ?>

