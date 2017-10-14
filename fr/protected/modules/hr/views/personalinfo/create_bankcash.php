<?php
$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> New Bank /Cash',
);

$this->menu=array(
	array('label'=>'New Bank /Cash', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreateBankCash')),
    array('label'=>'Manage Bank /Cash', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminBankCash')),
);
?>

<h1>New Bank /Cash</h1>
<?php echo $this->renderPartial('_form_bankcash', array('model'=>$model)); ?>
