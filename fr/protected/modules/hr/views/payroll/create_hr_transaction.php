<?php
$this->breadcrumbs=array(
	'Payroll'=>array('admin'),
	'Settings',
	'HR Transaction',
);

$this->menu=array(

    array('label'=>'Manage HR Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/managevoucherno')),
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'HR Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/createvoucherno')),
	),
	),
);
?>

<h1>New HR Transaction </h1>
<?php echo $this->renderPartial('_from_hr_transaction', array('model'=>$model)); ?>
