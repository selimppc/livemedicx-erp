<?php
$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> New Salary Type',
);

$this->menu=array(
	array('label'=>'New Salary Type', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreateSalaryType')),
    array('label'=>'Manage Salary Type', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminSalaryType')),
);
?>

<h1>New Salary Type</h1>
<?php echo $this->renderPartial('_form_salarytype', array('model'=>$model)); ?>
