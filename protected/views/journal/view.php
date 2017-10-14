<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Vouhcerheaders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Vouhcerheader', 'url'=>array('index')),
	array('label'=>'Create Vouhcerheader', 'url'=>array('create')),
	array('label'=>'Update Vouhcerheader', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Vouhcerheader', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Vouhcerheader', 'url'=>array('admin')),
);
?>

<h1>View Vouhcerheader #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'am_vouchernumber',
		'am_date',
		'am_referance',
		'am_year',
		'am_period',
		'am_branch',
		'am_note',
		'am_status',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
