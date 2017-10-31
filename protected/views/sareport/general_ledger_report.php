<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

$this->breadcrumbs=array(
	'Reports (GL)'=>array('sareport/GLReports'),
	'Reporting',
);
/*
$this->menu=array(
	//array('label'=>'List ItImtoap', 'url'=>array('index')),
	//array('label'=>'Create Module Interface', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'IM to AP', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
);
*/
?>
<style type="text/css">
	#report_main_div{
		width: 100%; 
		float: left;
		color: orange;
		margin-left: 30px;
	}
	#report_button{
		width: 100%; 
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
    <div id="flag_desc_text"> <b>GL Reporting Tools:</b> In this screen, you have the access & view to General Ledger Reports </div>
</div>

<div style="width: 98%; float: left;">
	<div style="width: 32%; float: left; margin-right: 2%;">
	
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Consolidated Trial Balance',array('sareport/TrialBlance')); ?>
			</div>	
		</div>
		
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Trial Balance for ALL',array('sareport/trialBlanceAll')); ?>
			</div>
		</div>

		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Chart of Account List',array('sareport/chartOfAccount')); ?>
			</div>
		</div>
		
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Journal Transaction',array('sareport/journalTransaction')); ?>
			</div>
		</div>
	</div>
	<div style="width: 32%; float: left; margin-right: 2%;">
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Balance Sheet',array('sareport/balanceSheet')); ?>
			</div>
		</div>
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Profit & Loss',array('sareport/pnl')); ?>
			</div>
		</div>
		<div id="report_main_div">
			<div id="report_button">
				<?php //echo CHtml::link('A/C - GL Report',array('sareport/AcGlReports')); ?>
				<?php echo CHtml::link('A/C - GL Report',array('reporttools/AcGlReports')); ?>
			</div>
		</div>
	</div>
	<div style="width: 32%; float: left;">
	</div>
</div>

<div style="width: 98%; margin: 0 auto;">

	

</div>




