<?php
/* @var $this PayrollController */

$this->breadcrumbs=array(
	'Payroll'=>array('admin'),
	'Payroll Management',
);

$this->menu=array(
	array('label'=>'Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('trnheader/admin')),
    
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'HR Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('payroll/ManageHrTransaction')),
				array('label'=>'HR Default', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('payroll/ManageHrDefault')),
	),
	),
);
?>

<h1><?php // echo $this->id . '/' . $this->action->id; ?></h1>

<h1 style="font-size: 30px;"> Welcome to Payroll Management System </h1>


