<?php
/* @var $this AdjustdtController */
/* @var $model Adjustdt */

$this->breadcrumbs=array(
    'Inventory',
    'Stock Adjustment'=>array('adjusthd/admin'),
    'Detail',
);

$this->menu=array(
    array('label'=>'<< Back to Adjustment Header', 'url'=>array('adjusthd/admin')),
);

?>

<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">Adjustment Detail</div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'adjustdt-grid',
	'dataProvider'=>$model->search($transaction_number),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'transaction_number',
		'product_code',
        array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
		'batch_number',
		'expirry_date',
        'unit',
		'quantity',
		'stock_rate',
	),
)); ?>
