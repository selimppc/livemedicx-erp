<?php
/* @var $this BatchtransferController */
/* @var $model Batchtransfer */

$this->breadcrumbs=array(
	'Batch Transfers'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Batch Transfers', 'url'=>array('index')),
	array('label'=>'Manage Batch Transfers', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Create Batch Transfers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>