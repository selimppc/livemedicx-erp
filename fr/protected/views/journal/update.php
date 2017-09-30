<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Vouhcerheaders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Vouhcerheader', 'url'=>array('index')),
	array('label'=>'Create Vouhcerheader', 'url'=>array('create')),
	array('label'=>'View Vouhcerheader', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Vouhcerheader', 'url'=>array('admin')),
);
?>

<h1>Update Vouhcerheader <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>