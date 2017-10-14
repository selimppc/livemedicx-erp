<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */

$this->breadcrumbs=array(
	'Purchase'=>array('purchaseordhd/admin'),
	// $model->id,
	'View Purchase Order Detail',
);

$this->menu=array(
	array(
		'label'=>'Manage Purchase Order Details', 
		 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}',
		'url'=>array('PurchaseOrderNumberS1', 'pp_purordnum'=>$pp_purordnum, 'pp_status'=>$pp_status,    ),
	),
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
    <div id="flag_desc_text">View Purchase Order Details # <?php echo $model->pp_purordnum; ?></div>
</div>



<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'pp_purordnum',
		//'pp_serialno',
		'cm_code',
		'pp_quantity',
		'pp_grnqty',
		'pp_unit',
		'pp_unitqty',
		'pp_purchasrate',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
