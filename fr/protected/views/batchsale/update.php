<?php
/* @var $this BatchsaleController */
/* @var $model Batchsale */

$this->breadcrumbs=array(
	'Batchsales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Batchsale', 'url'=>array('index')),
	array('label'=>'Create Batchsale', 'url'=>array('create')),
	array('label'=>'View Batchsale', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Batchsale', 'url'=>array('admin')),
);
?>

<h1>Update Batchsale <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>