<?php
/* @var $this BatchtransferController */
/* @var $model Batchtransfer */

$this->breadcrumbs=array(
	'Batchtransfers'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Batchtransfer', 'url'=>array('index')),
	array('label'=>'Create Batchtransfer', 'url'=>array('create')),
);
?>

<h1>Manage Batch Transfers</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'batchtransfer-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'id',
		'im_transfernum',
		'cm_code',
		'im_BatchNumber',
		'im_ExpDate',
		'im_quantity',
		/*
		'im_unit',
		'im_rate',
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
