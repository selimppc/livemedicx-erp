<?php
/* @var $this ImtransactionController */
/* @var $model Imtransaction */

$this->breadcrumbs=array(
	'Stock Transaction'=>array('admin'),
	'Transaction History ',
);

$this->menu=array(
	//array('label'=>'POST to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('PostToGl')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'IM Transaction', 'url'=>array('transaction/ManageImTrn')),
	),
	),*/
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
    <div id="flag_desc_text"><b>Transaction History:</b> In this screen you will be able to View all transaction history over all the Inventory</div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'imtransaction-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'im_number',
		'im_RefNumber',
		'cm_code',
        array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
        'im_storeid',
		'im_BatchNumber',
		'im_ExpireDate',
		'im_quantity',
		'im_unit',
		'im_rate',
		'im_note',
		'im_status',
	),
)); ?>
