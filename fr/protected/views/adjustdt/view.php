<?php
/* @var $this AdjustdtController */
/* @var $model Adjustdt */

$this->breadcrumbs=array(
	'Adjustdts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Adjustdt', 'url'=>array('index')),
	array('label'=>'Create Adjustdt', 'url'=>array('create')),
	array('label'=>'Update Adjustdt', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Adjustdt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adjustdt', 'url'=>array('admin')),
);
?>

<h1>View Adjustdt #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transaction_number',
		'product_code',
		'batch_number',
		'expirry_date',
		'quantity',
		'stock_rate',
		'inserttime',
		'insertuser',
		'updatetime',
		'updateuser',
	),
)); ?>
