<?php
/* @var $this TrnheaderController */
/* @var $model Trnheader */

$this->breadcrumbs=array(
	'HR Transaction'=>array('admin'),
	'New Transaction',
);

$this->menu=array(
	
	array('label'=>'Manage Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>New Transaction</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>