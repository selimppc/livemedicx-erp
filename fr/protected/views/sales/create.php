<?php
/* @var $this SalesController */
/* @var $model Smheader */

$this->breadcrumbs=array(
	'Smheaders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Smheader', 'url'=>array('index')),
	array('label'=>'Manage Smheader', 'url'=>array('admin')),
);
?>

<h1>Create Smheader</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>