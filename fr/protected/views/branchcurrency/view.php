<?php
/* @var $this BranchcurrencyController */
/* @var $model Branchcurrency */

$this->breadcrumbs=array(
	'Branch Currencies'=>array('admin'),
	//$model->id,
	'View Branch Currency',
);

$this->menu=array(
	//array('label'=>'List Branchcurrency', 'url'=>array('index')),
	//array('label'=>'Create Branch Currency', 'url'=>array('create')),
	//array('label'=>'Update Branchcurrency', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Branchcurrency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Branch Currencies', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin', 'cm_branch'=>$model->cm_branch)),
);
?>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">View Branch Currency #<?php echo $model->id; ?></div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cm_branch',
		'cm_currency',
		'cm_description',
		'cm_exchangerate',
		'cm_active',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
