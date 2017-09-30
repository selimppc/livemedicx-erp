<?php
/* @var $this AmdefaultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Amdefaults',
);

$this->menu=array(
	array('label'=>'Create Amdefault', 'url'=>array('create')),
	array('label'=>'Manage Amdefault', 'url'=>array('admin')),
);
?>

<h1>Amdefaults</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
