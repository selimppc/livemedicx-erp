<?php
/* @var $this BatchsaleController */
/* @var $model Batchsale */

$this->breadcrumbs=array(
	'Batchsales'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Batchsale', 'url'=>array('index')),
	array('label'=>'Create Batchsale', 'url'=>array('create')),
	array('label'=>'Update Batchsale', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Batchsale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Batchsale', 'url'=>array('admin')),
);
?>

<h1>View Batchsale #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sm_number',
		'cm_code',
		'sm_batchnumber',
		'sm_expdate',
		'sm_unit',
		'sm_quantity',
		'sm_bonusqty',
		'sm_rate',
		'sm_tax_rate',
		'sm_tax_amt',
		'sm_line_amt',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
