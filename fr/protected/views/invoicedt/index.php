<?php
/* @var $this InvoicedtController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Smdetails',
);

$this->menu=array(
	array('label'=>'Create Smdetail', 'url'=>array('create')),
	array('label'=>'Manage Smdetail', 'url'=>array('admin')),
);
?>

<h1>Smdetails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
