<?php
/* @var $this AmdefaultController */
/* @var $model Amdefault */

$this->breadcrumbs=array(
    'General Ledger'=>array(''),
    'Chart of Accounts'=>array('chartofaccounts/admin'),
    'Settings'=>array(''),
	'Defaults'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Am Default', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Create Am Default</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>