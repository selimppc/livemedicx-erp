<?php
/* @var $this AmdefaultController */
/* @var $model Amdefault */

$this->breadcrumbs=array(
	'Amdefaults'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Amdefault', 'url'=>array('index')),
	array('label'=>'Create Amdefault', 'url'=>array('create')),
	array('label'=>'View Amdefault', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Amdefault', 'url'=>array('admin')),
);
?>

<h1>Update Amdefault <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>