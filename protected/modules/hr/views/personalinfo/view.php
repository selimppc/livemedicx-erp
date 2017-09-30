<?php
/* @var $this PersonalinfoController */
/* @var $model Personalinfo */

$this->breadcrumbs=array(
	'Personal Info'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Personal Info', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Update Personal Info', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/update_a.png" /></span>{menu}', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Personal Info', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>View Personal Info #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'empid',
		'empname',
		'doj',
		'doc',
		'grade',
		'deptname',
		'designation',
		'bank',
		'acccode',
		'currency',
		'exchangerate',
		'amount',
		'leaveplan',
		'dob',
		'gender',
		'present',
		'parmanent',
		'cellno',
		'phone',
		'email',
		'branch',
		'status',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
