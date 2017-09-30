<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */

$this->breadcrumbs=array(
	'Purchase'=>array('purchaseordhd/admin'),
	'Purchase Order Details',
);

$this->menu=array(
	array('label'=>'<< Back to Purchase Header', 'url'=>array('purchaseordhd/admin')),
	//array('label'=>'New Purchase Order Details', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
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
    <div id="flag_desc_text">In this screen you can only view purchase details information. You can go back to Purchase Header to view all Voucher Header information at a glance by clicking the menu tab <b>"<< Back to Purchase  Header"</b>.</div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseorddt-grid',
	'dataProvider'=>$model->searchDetail($pp_purordnum),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'pp_purordnum',
		//'pp_serialno',
		'cm_code',
        array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
		'pp_quantity',
        'pp_rowamt',
		/*
		'pp_unit',
		'pp_unitqty',
		'pp_purchasrate',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
	),
)); ?>
