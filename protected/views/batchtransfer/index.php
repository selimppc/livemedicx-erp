<?php
/* @var $this BatchtransferController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Batch Transfers',
);

$this->menu=array(
	array('label'=>'Create Batch Transfers', 'url'=>array('create')),
	array('label'=>'Manage Batch Transfers', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Batch Transfers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
