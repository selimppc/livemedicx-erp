<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Purchase Module'=>array('sareport/purchaseReports'),
	'Purchase Order Reports',
);

$this->menu=array(
	array('label'=>'<< Back to Report Tool', 'url'=>array('sareport/itemLedger'))
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
    <div id="flag_desc_text">
        <b>Purchase order </b>: In this screen select Select Purchase Order Number from the pull down menu to report in pdf or xls click <b>PDF</b> or <b>XLS</b> respectively. *** Data Posting to GL is necessary for viewing and result. You can go back to the Report Tools to view all Report tools by clicking the menu tab <b>“<< Back to Report”</b>.

    </div>
</div>

<div style="clear: both;"></div>

<?php echo CHtml::beginForm($this->createUrl('/sareport/purchaseOrderReports'), 'POST', array('target'=>'_blank'))?>

<table style="text-align: left; ">
	  <tr>
	    <th> Purchase Order Number List: </th>
	  </tr>
	  <tr>
	  	<td> <?php echo CHtml::activeDropDownList($model, 'pp_purordnum', CHtml::listData(Purchaseordhd::model()->findAll(array('order'=>'pp_purordnum ASC')), 'pp_purordnum', 'pp_purordnum'), array('empty'=>'- Select PO Number -', 'required'=>TRUE)); ?> </td>
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

