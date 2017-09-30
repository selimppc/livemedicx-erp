<?php
/* @var $this BatchsaleController */
/* @var $model Batchsale */

$this->breadcrumbs=array(
	'Batchsales'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Batchsale', 'url'=>array('index')),
	array('label'=>'Manage Batchsale', 'url'=>array('admin')),
);
?>

<h1>Create Batchsale</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>