<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
    'General Ledger',
	'Reports (GL)'=>array('sareport/GLReports'),
	'Chart Of Account',
);
$this->menu=array(
    array('label'=>'<< Back to Reports', 'url'=>array('sareport/GLReports')),

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
		width: 220px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
	}

</style>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Chart Of Account Reports :</b> Select Account Type from the pull down list. To view report in pdf or xls click on <b>"PDF"</b> or <b>"XLS"</b> . *** Data Posting to GL is necessary for viewing and result. You can go back to the <b>Report Tools</b> to view all Report tools by clicking the menu tab  <b>“ << Back to Report”</b>.</div>
</div>

<div style="clear: both;"></div>

<?php echo CHtml::beginForm($this->createUrl('/sareport/ChartOfAccountList'), 'POST', array('target'=>'_blank'))?>

<table style="text-align: left; ">
	  <tr>
	    <th> Account Type: </th>
	  </tr>
	  <tr>
	  	<td> <?php echo CHtml::activeDropDownList($model, 'am_accounttype', array('Asset'=>'Asset', 'Liability'=>'Liability', 'Income'=>'Income', 'Expenses'=>'Expenses'), array('empty'=>'- All Account-')); ?> </td>
	  </tr>
</table>

	<div class="row buttons">
		<div class="row status-container">
          <div class="span4 action-bar">
			<?php echo CHtml::submitButton('To PDF', array('class'=>'action-btn', 'id'=>'action-btn-pdf', 'name' => 'topdf', 'style'=>'margin-right: 10px;')); ?>
			<?php echo CHtml::submitButton('To XLS', array('class'=>'action-btn', 'id'=>'action-btn-xls', 'name' => 'topxls')); ?>
		  </div>
        </div>
	</div>
<?php echo CHtml::endForm(); ?>

