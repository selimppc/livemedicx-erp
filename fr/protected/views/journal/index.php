<?php
/* @var $this JournalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Vouhcerheaders',
);

$this->menu=array(
	array('label'=>'Create Vouhcerheader', 'url'=>array('create')),
	array('label'=>'Manage Vouhcerheader', 'url'=>array('admin')),
);
?>

<h1>Vouhcerheaders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
