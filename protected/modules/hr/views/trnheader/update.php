<?php
/* @var $this TrnheaderController */
/* @var $model Trnheader */

$this->breadcrumbs=array(
	'HR Transaction'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'New Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
	array('label'=>'Manage Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<h1>Update Transaction <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>