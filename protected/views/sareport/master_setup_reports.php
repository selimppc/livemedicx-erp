<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

$this->breadcrumbs=array(
	'Master Setup',
	'Reports'=>array('sareport/masterSetupReports'),
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
    <div id="flag_desc_text">In this screen, you have the access & view to Master Setup Reports</div>
</div>

<div style="width: 98%; margin: 0 auto;">
	
	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Product List Report',array('sareport/productList')); ?>
		</div>	
	</div>
	

	<div id="report_main_div"> 
		<div id="report_button">
			<?php echo CHtml::link('Customer Ledger Report',array('reporttools/customerLedger')); ?>
		</div>
	</div>
    <!--
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






<!-- 
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'it-imtoap-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'item_group',
		'sup_group',
		'debit_account',
		//'credit_account',
		'active',
		/*
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
 -->
