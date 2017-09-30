<?php
/* @var $this InvoicedtController */
/* @var $model Smdetail */

$this->breadcrumbs=array(
    'Sales',
	'Invoice '=>array('smheader/admin'),
	'Invoice Details',
);

$this->menu=array(
    array('label'=>'<< Back to Invoice', 'url'=>array('smheader/admin')),
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
    <div id="flag_desc_text">In this screen you can only view purchase details information. You can go back to Purchase Header to view all Voucher Header information at a glance by clicking the menu tab <b>"<< Back to Invoice"</b>.</div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'smdetail-grid',
    'dataProvider'=>$model->searchDetail($sm_number),
	//'filter'=>$model,
	'columns'=>array(
        'cm_code',
        array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
        'sm_unit_qty',
        'sm_unit',
        'sm_quantity',
        'sm_rate',
        'sm_tax_amt',
        'sm_lineamt',

	),
)); ?>
