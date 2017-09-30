<?php
/* @var $this BranchcurrencyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Branch Currencies',
);

$this->menu=array(
	array('label'=>'New Branch Currency', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Branch Currencies', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Branch Currencies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
