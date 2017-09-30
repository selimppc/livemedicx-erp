<?php
$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> New Position',
);

$this->menu=array(
	array('label'=>'New Position', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreatePosition')),
    array('label'=>'Manage Position', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminPosition')),
);
?>

<h1>New Unit Of Measurement</h1>
<?php echo $this->renderPartial('_form_position', array('model'=>$model)); ?>
