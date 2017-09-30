<?php
/* @var $this BatchtransferController */
/* @var $model Batchtransfer */

$this->breadcrumbs=array(
	'Batch Transfers'=>array('admin'),
	$model->id,
);

$this->menu=array(
	// array('label'=>'List Batchtransfer', 'url'=>array('index')),
	array('label'=>'Create Batch Transfer', 'url'=>array('create')),
	//array('label'=>'Update Batch Transfer', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Batch Transfer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Batch Transfer', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>View Batch Transfers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'im_transfernum',
		'cm_code',
		'im_BatchNumber',
		'im_ExpDate',
		'im_quantity',
		'im_unit',
		'im_rate',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
