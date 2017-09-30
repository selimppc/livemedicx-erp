<?php
$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> New Leave Plan',
);

$this->menu=array(
	array('label'=>'New Leave Plan', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreateLeavePlan')),
    array('label'=>'Manage Leave Plan', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminLeavePlan')),
);
?>

<h1>New Bank /Cash</h1>
<?php echo $this->renderPartial('_form_leaveplan', array('model'=>$model)); ?>
