<?php
/* @var $this AdjustdtController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Adjustdts',
);

$this->menu=array(
	array('label'=>'Create Adjustdt', 'url'=>array('create')),
	array('label'=>'Manage Adjustdt', 'url'=>array('admin')),
);
?>

<h1>Adjustdts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
