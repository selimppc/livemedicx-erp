<?php
/* @var $this BranchcurrencyController */
/* @var $model Branchcurrency */

$this->breadcrumbs=array(
	'Branch Currency Detail'=>array('admin', 'cm_branch'=>$model->cm_branch ),
	//$model->id=>array('view','id'=>$model->id),
	'Update Branch Currency',
);

$this->menu=array(
	//array('label'=>'List Branchcurrency', 'url'=>array('index')),
	//array('label'=>'Create Branchcurrency', 'url'=>array('create')),
	//array('label'=>'View Branchcurrency', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Branchcurrency', 'url'=>array('admin')),
);
?>

<h1>Update Branch Currency # <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>