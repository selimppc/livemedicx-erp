<?php
/* @var $this AdjusthdController */
/* @var $model Adjusthd */

$this->breadcrumbs=array(
	'Adjusthds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Adjusthd', 'url'=>array('index')),
	array('label'=>'Create Adjusthd', 'url'=>array('create')),
	array('label'=>'View Adjusthd', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Adjusthd', 'url'=>array('admin')),
);
?>

<h1>Update Adjusthd <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>