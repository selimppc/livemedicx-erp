<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Master Setup',
	'Reports'=>array('sareport/masterSetupReports'),
	'Incorporate Product List Report',
);

$this->menu=array(
	array('label'=>'<< Back to Report', 'url'=>array('sareport/masterSetupReports')),
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
        <b>Product List Report </b>: In this screen select product class &product group to report in pdf or xls click <b>PDF</b> or <b>XLS</b> respectively. *** Data Posting to GL is necessary for viewing and result. You can go back to the Report Tools to view all Report tools by clicking the menu tab <b>“<< Back to Report”</b>.

 </div>
</div>

<div style="clear: both;"></div>

<form action="../../reports/product_list_report.php" target="_blank">

<table style="text-align: left; ">
	  <tr>
	    <th> Product Class: </th>
	    <th> Product Category: </th>
	  </tr>
	  <tr>
	  
	  	<td>
            <?php echo CHtml::activeDropDownList($model, 'cm_class', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Class"'), 'cm_code', 'cm_code'),array('empty'=>'- Select Product Class -')); ?>
        </td>
		
	  	<td>
        <?php echo CHtml::activeDropDownList($model, 'cm_category', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Category"'), 'cm_code', 'cm_desc'),array('empty'=>'- All Product Category -')); ?>
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
<?php //echo CHtml::endForm(); ?>

