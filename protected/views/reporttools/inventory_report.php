<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

include('header.php');
?>
<style type="text/css">
	#report_main_div{
		width: 96%; 
		float: left;
		color: orange;
		margin-left: 30px;
	}
	#report_button{
		width: 95%; 
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
    <div id="flag_desc_text">In this screen, you have the access & view to  IM(Inventory Management) Reports</div>
</div>



<div style="width: 98%; margin: 0 auto;">
	<div style="width: 48%; float:left; margin-right: 2%">
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Item Ledger',array('reporttools/itemLedger')); ?>
			</div>	
		</div>

		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Inventory Movement',array('reporttools/inventoryMovement')); ?>
			</div>
		</div>

		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Stock Dispatch',array('reporttools/stockDispatch')); ?>
			</div>
		</div>

		<div id="report_main_div">
			<div id="report_button">
				<?php echo CHtml::link('Stock Balance',array('reporttools/stockBalance')); ?>
			</div>
		</div>

		<div id="report_main_div">
			<div id="report_button">
				<?php echo CHtml::link('Stock Balance after Adjustment',array('reporttools/stockBalanceAfterAd')); ?>
			</div>
		</div>

	</div>
	<div style="width: 50%; float:left;">
		<div id="report_main_div">
			<div id="report_button">
				<?php echo CHtml::link('Expired Product List',array('reporttools/expiredProductList')); ?>
			</div>
		</div>
	</div>
</div>





