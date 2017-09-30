<?php
/* @var $this AmdefaultController */
/* @var $model Amdefault */

$this->breadcrumbs=array(
	'Amdefaults'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Amdefault', 'url'=>array('index')),
	array('label'=>'Create Amdefault', 'url'=>array('create')),
	array('label'=>'Update Amdefault', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Amdefault', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Amdefault', 'url'=>array('admin')),
);
?>

<h1>View Amdefault #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'am_offset',
		'am_pnlacount',
		'am_year',
		'am_period',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
