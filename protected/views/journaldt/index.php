<?php
/* @var $this JournaldtController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Voucherdetails',
);

$this->menu=array(
	array('label'=>'Create Voucherdetail', 'url'=>array('create')),
	array('label'=>'Manage Voucherdetail', 'url'=>array('admin')),
);
?>

<h1>Voucherdetails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
