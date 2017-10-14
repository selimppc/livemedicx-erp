<?php
/* @var $this TrnheaderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'HR Transaction',
);

$this->menu=array(
	array('label'=>'New Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Transaction</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
