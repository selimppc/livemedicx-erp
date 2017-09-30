<?php
$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> New Department',
);

$this->menu=array(
	array('label'=>'New Department', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreateDepartment')),
    array('label'=>'Manage Department', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminDepartment')),
);
?>

<h1>New Department</h1>
<?php echo $this->renderPartial('_form_department', array('model'=>$model)); ?>
