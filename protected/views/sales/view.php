<?php
/* @var $this SalesController */
/* @var $model Smheader */

$this->breadcrumbs=array(
	'Smheaders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Smheader', 'url'=>array('index')),
	array('label'=>'Create Smheader', 'url'=>array('create')),
	array('label'=>'Update Smheader', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Smheader', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Smheader', 'url'=>array('admin')),
);
?>

<h1>View Smheader #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sm_number',
		'sm_date',
		'cm_cuscode',
		'sm_sp',
		'sm_doc_type',
		'sm_storeid',
		'sm_territory',
		'sm_rsm',
		'sm_area',
		'sm_payterms',
		'am_accountcode',
		'sm_chequeno',
		'sm_currency',
		'sm_exchrate',
		'sm_totalamt',
		'sm_total_tax_amt',
		'sm_disc_rate',
		'sm_disc_amt',
		'sm_netamt',
		'sm_sign',
		'sm_stataus',
		'sm_refe_code',
		'glvoucher',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
