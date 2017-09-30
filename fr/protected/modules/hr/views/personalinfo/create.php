<?php
/* @var $this PersonalinfoController */
/* @var $model Personalinfo */

$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'New Employee Info',
);

$this->menu=array(
	array('label'=>'Exiting Employee', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Position', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/CreatePosition')),
				array('label'=>'Department', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminDepartment')),
				array('label'=>'Designation', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminDesignation')),
				array('label'=>'Bank / Cash', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminBankCash')),
				array('label'=>'Leave Plan', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminLeavePlan')),
				array('label'=>'Salary Type', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('personalinfo/AdminSalaryType')),
	),
	),
);
?>

<h1>New Employee Info</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>