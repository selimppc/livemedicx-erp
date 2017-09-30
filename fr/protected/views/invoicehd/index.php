<?php
/* @var $this InvoicehdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Smheaders',
);

$this->menu=array(
	array('label'=>'Create Smheader', 'url'=>array('create')),
	array('label'=>'Manage Smheader', 'url'=>array('admin')),
);
?>

<h1>Smheaders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
