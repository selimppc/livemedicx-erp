<?php
/* @var $this BranchmasterController */
/* @var $model Branchmaster */

$this->breadcrumbs=array(
	'Branch Master'=>array('admin'),
	//$model->cm_branch,
	'View Branch Master',
);

$this->menu=array(
	//array('label'=>'List Branchmaster', 'url'=>array('index')),
	array('label'=>'New Branch Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	//array('label'=>'Update Branchmaster', 'url'=>array('update', 'id'=>$model->cm_branch)),
	//array('label'=>'Delete Branchmaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cm_branch),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Branch Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">View Branch Master # <?php echo $model->cm_branch; ?></div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cm_branch',
		'cm_currency',
		'cm_description',
		'cm_contacperson',
		'cm_designation',
		'cm_mailingaddress',
		'cm_phone',
		'cm_cell',
		'cm_fax',
		'active',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
