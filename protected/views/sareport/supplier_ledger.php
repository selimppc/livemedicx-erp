<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Master Setup',
	'Reports'=>array('sareport/masterSetupReports'),
	'Supplier Ledger',
);

$this->menu=array(
    array('label'=>'<< Back to Reports', 'url'=>array('sareport/masterSetupReports')),

);
?>
<style type="text/css">
	.ui-datepicker-trigger{
		border: none;
		background: none;
	}
	.hasDatepicker{
		padding: 3px;
	}
	
	table tr td select, #from_date, #to_date{
		padding: 15px;
		width: 180px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
	}

</style>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">
        <b>Supplier Ledger </b>: In this screen select Branch, Supplier and input desire dates, from and to, to report in pdf or xls click <b>PDF</b> or <b>XLS</b> respectively. *** Data Posting to GL is necessary for viewing and result. You can go back to the Report Tools to view all Report tools by clicking the menu tab <b>“<< Back to Report”</b>.
</div>
</div>
<div style="clear: both"></div>
<br>

<form action="../../reports/supplier_report.php" target="_blank">

<table style="text-align: left; width: 90%;">
	  <tr>
	    <th> Branch: </th>
	    <th> From Date: </th>
	    <th> To Date: </th>
		<th> Supplier: </th>
	  </tr>
	  <tr>
	  	<td> <?php echo CHtml::activeDropDownList($model, 'cm_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'),  array('prompt'=>'All') ); ?> </td>
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
		<td> <?php echo CHtml::activeDropDownList($model, 'supplier_name', CHtml::listData(Suppliermaster::model()->findAll(array('order'=>'cm_orgname ASC')), 'cm_supplierid', 'cm_orgname'),  array('empty'=>'- All Supplier -', ) ); ?> </td>
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

