<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

$this->breadcrumbs=array(
	'Sales',
	'Reports'=>array('sareport/salesReports'),
	'Reporting Tools',
);

$this->menu=array(
    //array('label'=>'List ItImtoap', 'url'=>array('index')),
);

?>
<style type="text/css">
	#report_main_div{
		width: 96%; 
		float: left;
		color: orange;
		margin-left: 30px;
	}
	#report_button{
		width: 33%; 
		float: left;
	}

	#report_button a {
		text-decoration: none;
		color: white;
		width: 55%;
		float: left;
		text-align: center;
		margin-top: 10px;
		padding: 17px 30px;
		background: #4085BB;
		border-radius: 2px;
		font-size: 16px;
        box-shadow: 10px 3px 5px #aaa;
	}
	#report_button a:hover {
		background: #2F6088;
	}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">
        <b>Report</b>: In this screen, you have the choice of viewing the Sales Reports.
        </div>
</div>



<div style="width: 98%; margin: 0 auto;">

	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Customer Ledger Report',array('sareport/customerLedgerSales')); ?>
		</div>	
	</div>
    <!--
	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Print Money Receipt',array('sareport/customerLedgerSales')); ?>
		</div>
	</div>

	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('Chart of Account List',array('sareport/chartOfAccount')); ?>
		</div>
	</div>
	
	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('Journal Transaction',array('sareport/journalTransaction')); ?>
		</div>
	</div>
	-->
</div>





