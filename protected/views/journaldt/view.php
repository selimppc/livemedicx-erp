<?php
/* @var $this JournaldtController */
/* @var $model Voucherdetail */

$this->breadcrumbs=array(
	'Voucherdetails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Voucherdetail', 'url'=>array('index')),
	array('label'=>'Create Voucherdetail', 'url'=>array('create')),
	array('label'=>'Update Voucherdetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Voucherdetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Voucherdetail', 'url'=>array('admin')),
);
?>

<h1>View Voucherdetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'am_vouchernumber',
		'am_accountcode',
		'am_subacccode',
		'am_currency',
		'am_exchagerate',
		'am_primeamt',
		'am_baseamt',
		'am_branch',
		'am_note',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
