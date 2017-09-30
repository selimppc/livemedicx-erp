<?php
/* @var $this AdjusthdController */
/* @var $model Adjusthd */

$this->breadcrumbs=array(
	'Adjusthds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Adjusthd', 'url'=>array('index')),
	array('label'=>'Create Adjusthd', 'url'=>array('create')),
	array('label'=>'Update Adjusthd', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Adjusthd', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adjusthd', 'url'=>array('admin')),
);
?>

<h1>View Adjusthd #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transaction_number',
		'DATE',
		'branch',
		'adjustment_type',
		'confirm_date',
		'currency',
		'exchange_rate',
		'STATUS',
		'inserttime',
		'insertuser',
		'updatetime',
		'updateuser',
	),
)); ?>
