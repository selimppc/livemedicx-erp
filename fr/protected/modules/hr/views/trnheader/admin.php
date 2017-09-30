<?php
/* @var $this TrnheaderController */
/* @var $model Trnheader */

$this->breadcrumbs=array(
	'HR Transaction'=>array('admin'),
	'Manage Transaction',
);

$this->menu=array(
	array('label'=>'New Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#trnheader-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Transaction</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trnheader-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'trnnumber',
		'trndate',
		'trnyear',
		'trnperiod',
		'inserttime',
		/*
		'updatetime',
		'insertuser',
		'updateuser',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
