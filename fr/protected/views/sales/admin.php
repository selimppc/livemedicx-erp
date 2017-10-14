<?php
/* @var $this SalesController */
/* @var $model Smheader */

$this->breadcrumbs=array(
	'Smheaders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Smheader', 'url'=>array('index')),
	array('label'=>'Create Smheader', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#smheader-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Smheaders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smheader-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'sm_number',
		'sm_date',
		'cm_cuscode',
		'sm_sp',
		'sm_doc_type',
		/*
		'sm_storeid',
		'sm_territory',
		'sm_rsm',
		'sm_area',
		'sm_payterms',
		'am_accountcode',
		'sm_chequeno',
		'sm_currency',
		'sm_exchrate',
		'sm_totalamt',
		'sm_total_tax_amt',
		'sm_disc_rate',
		'sm_disc_amt',
		'sm_netamt',
		'sm_sign',
		'sm_stataus',
		'sm_refe_code',
		'glvoucher',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
