<?php
/* @var $this InvoicedtController */
/* @var $model Smdetail */

$this->breadcrumbs=array(
	'Smdetails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Smdetail', 'url'=>array('index')),
	array('label'=>'Create Smdetail', 'url'=>array('create')),
	array('label'=>'Update Smdetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Smdetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Smdetail', 'url'=>array('admin')),
);
?>

<h1>View Smdetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sm_number',
		'cm_code',
		'sm_unit',
		'sm_rate',
		'sm_bonusqty',
		'sm_quantity',
		'sm_tax_rate',
		'sm_tax_amt',
		'sm_lineamt',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
