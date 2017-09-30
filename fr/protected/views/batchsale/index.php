<?php
/* @var $this BatchsaleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Batchsales',
);

$this->menu=array(
	array('label'=>'Create Batchsale', 'url'=>array('create')),
	array('label'=>'Manage Batchsale', 'url'=>array('admin')),
);
?>

<h1>Batchsales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
