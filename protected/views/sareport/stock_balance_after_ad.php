<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Inventory',
	'Reports'=>array('sareport/inventoryReports'),
	'Stock Balance after Adjustment',
);

$this->menu=array(
	array('label'=>'<< Back to Report', 'url'=>array('sareport/inventoryReports')),
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
    <div id="flag_desc_text">
        <b>Stock Balance after Adjustment </b>: In this screen select Branch and input desire dates to report in pdf or xls click <b>PDF</b> or <b>XLS</b> respectively. *** Data Posting to GL is necessary for viewing and result. You can go back to the Report Tools to view all Report tools by clicking the menu tab <b>“<< Back to Report”</b>.

        </div>
</div>

<div style="clear: both;"></div>

<form action="../../reports/stock_balance_after_adjust.php" target="_blank">

<table style="text-align: left; ">
	  <tr>
	    <th> Branch: </th>
	    <th> Date: </th>
	    
	  </tr>
	  <tr>

	  	<td> <?php echo CHtml::activeDropDownList($model, 'cm_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('empty'=>'- Select Branch -', 'required'=>TRUE)); ?> </td>
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
                    'placeholder'=>' pick your date ',
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

