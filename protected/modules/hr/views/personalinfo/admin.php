<?php
/* @var $this PersonalinfoController */
/* @var $model Personalinfo */

$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Exiting Employee ',
);

$this->menu=array(
	array('label'=>'New Employee', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Position', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminPosition')),
				array('label'=>'Department', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminDepartment')),
				array('label'=>'Designation', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminDesignation')),
				array('label'=>'Bank / Cash', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminBankCash')),
				array('label'=>'Leave Plan', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminLeavePlan')),
				array('label'=>'Salary Type', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminSalaryType')),
	),
	),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#personalinfo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Personal Info </h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'personalinfo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'empid',
		'empname',
		'doj',
		'doc',
		'grade',
		'deptname',
		'designation',
		//'bank',
		//'acccode',
		//'currency',
		//'exchangerate',
		//'amount',
		//'leaveplan',
		'dob',
		'gender',
		//'present',
		//'parmanent',
		'cellno',
		//'phone',
		//'email',
		'branch',
		'status',

		array(
			'header'=>'Action',
			'class'=>'CButtonColumn',
		),
	),
)); ?>
