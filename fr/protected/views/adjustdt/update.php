<?php
/* @var $this AdjustdtController */
/* @var $model Adjustdt */

$this->breadcrumbs=array(
    'Inventory',
    'Stock Adjustment'=>array('adjusthd/admin'),
    'New Stock Adjustment',
    'Update',
);

$this->menu=array(
    array('label'=>'<< Back to Adjustment Header', 'url'=>array('adjusthd/admin')),
);
?>

<h1>Update Adjustdt <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>