<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Report'=>array('sareport/inventory'),
	'Inventory',
);


$this->menu=array(
	array('label'=>'Item Ledger', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/report_a.png" /></span>{menu}', 'url'=>array('reporttools/itemLedger')),
);
?>

