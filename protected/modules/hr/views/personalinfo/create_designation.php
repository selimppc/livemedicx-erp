<?php
$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> New Designation',
);

$this->menu=array(
	array('label'=>'New Designation', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreateDesignation')),
    array('label'=>'Manage Designation', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminDesignation')),
);
?>

<h1>New Designation</h1>
<?php echo $this->renderPartial('_form_designation', array('model'=>$model)); ?>
