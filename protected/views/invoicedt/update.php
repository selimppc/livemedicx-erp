<?php
/* @var $this InvoicedtController */
/* @var $model Smdetail */

$this->breadcrumbs=array(
	'Smdetails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Smdetail', 'url'=>array('index')),
	array('label'=>'Create Smdetail', 'url'=>array('create')),
	array('label'=>'View Smdetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Smdetail', 'url'=>array('admin')),
);
?>

<h1>Update Smdetail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>