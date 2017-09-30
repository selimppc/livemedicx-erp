<?php
/* @var $this JournaldtController */
/* @var $model Voucherdetail */

$this->breadcrumbs=array(
	'Voucherdetails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Voucherdetail', 'url'=>array('index')),
	array('label'=>'Create Voucherdetail', 'url'=>array('create')),
	array('label'=>'View Voucherdetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Voucherdetail', 'url'=>array('admin')),
);
?>

<h1>Update Voucherdetail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>