<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */

$this->breadcrumbs=array(
	'Chart of Accounts'=>array('admin'),
	$model->am_accountcode,
);

$this->menu=array(
	//array('label'=>'List Chartofaccounts', 'url'=>array('index')),
	array('label'=>'Create Chart of Accounts', 'url'=>array('create')),
	array('label'=>'Update Chart of Accounts', 'url'=>array('update', 'id'=>$model->am_accountcode)),
	array('label'=>'Delete Chart of Accounts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->am_accountcode),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Chart of Accounts', 'url'=>array('admin')),
);
?>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">  View Chart of Accounts #<?php echo $model->am_accountcode; ?> </div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'am_accountcode',
		'am_description',
		'am_accounttype',
		'am_accountusage',
		'am_groupone',
		'am_grouptwo',
		'am_groupthree',
		'am_groupfour',
		'am_analyticalcode',
		'am_branch',
		'am_status',

	),
)); ?>
