<?php
/* @var $this TrnheaderController */
/* @var $model Trnheader */

$this->breadcrumbs=array(
	'HR Transaction'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'New Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>View Transaction  #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'trnnumber',
		'trndate',
		'trnyear',
		'trnperiod',
	),
)); ?>
