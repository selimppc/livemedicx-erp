<?php
/* @var $this AdjusthdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Adjusthds',
);

$this->menu=array(
	array('label'=>'Create Adjusthd', 'url'=>array('create')),
	array('label'=>'Manage Adjusthd', 'url'=>array('admin')),
);
?>

<h1>Adjusthds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
