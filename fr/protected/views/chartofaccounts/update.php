<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */

$this->breadcrumbs=array(
	'Chart of Accounts'=>array('admin'),
	$model->am_accountcode=>array('view','id'=>$model->am_accountcode),
	'Update Chart of Accounts',
);

$this->menu=array(
	//array('label'=>'List Chartofaccounts', 'url'=>array('index')),
	array('label'=>'Create Chart of Accounts', 'url'=>array('create')),
	array('label'=>'View Chart of Accounts', 'url'=>array('view', 'id'=>$model->am_accountcode)),
	array('label'=>'Manage Chart of Accounts', 'url'=>array('admin')),
);
?>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">Update Chart of Accounts <?php echo $model->am_accountcode; ?></div>
</div>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>