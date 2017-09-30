<?php
/* @var $this PersonalinfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personal Info',
);

$this->menu=array(
	array('label'=>'Create Personal Info','template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
	array('label'=>'Manage Personal Info','template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}',  'url'=>array('admin')),
);
?>

<h1>Personal Info</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
