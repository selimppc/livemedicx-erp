<?php
/* @var $this BatchtransferController */
/* @var $model Batchtransfer */

$this->breadcrumbs=array(
	'Batch Transfers'=>array('admin'),
		$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Batch Transfers', 'url'=>array('index')),
	array('label'=>'Create Batch Transfers', 'url'=>array('create')),
	//array('label'=>'View Batch Transfers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Batch Transfers', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Update Batch Transfers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>