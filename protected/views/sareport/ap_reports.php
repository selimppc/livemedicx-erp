<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

$this->breadcrumbs=array(
	'Accounts Payable',
	'Reports'=>array('sareport/apReports'),
	'Reporting',
);


?>
<style type="text/css">
	#report_main_div{
		width: 96%; 
		float: left;
		color: orange;
		margin-left: 30px;
		border-radius: 10px;
	}
	#report_button{
		width: 33%; 
		float: left;
		border-radius: 10px;
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
		border-radius: 10px;
		font-size: 16px;
		box-shadow: 10px 3px 5px #aaa;
	}
	#report_button a:hover {
		background: #2F6088;
		border-radius: 10px;
	}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Account Payable Reporting Tools:</b>In this screen, you have the access & view to Account Payable Reports.</div>
</div>

<div style="width: 98%; margin: 0 auto;">

	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Supplier Ledger',array('sareport/SupplierLedger_ap')); ?>
		</div>	
	</div>
	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Supplier List Report',array('sareport/SupplierReport_AP')); ?>
		</div>
	</div>
	<!-- 
	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('Trial Balance for ALL',array('sareport/trialBlanceAll')); ?>
		</div>
	</div>
	
	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('User Report',array('default/billadmin')); ?>
		</div>
	</div>
	
	<div id="report_main_div"> 
		<div id="report_button">
			<?php //echo CHtml::link('User Report',array('default/billadmin')); ?>
		</div>
	</div>
	 -->
</div>






