<?php
/* @var $this PurchaseordhdController */
/* @var $model Purchaseordhd */

$this->breadcrumbs=array(
	'Purchase Order'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Manage Purchase Order', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
    <div id="flag_desc_text">View Purchase Order #<?php echo $model->id; ?></div>
</div>


<h1></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pp_purordnum',
		'pp_date',
		'cm_supplierid',
		'pp_requisitionno',
		'pp_payterms',
		'pp_deliverydate',
		'pp_store',
		//'pp_taxrate',
		//'pp_taxamt',
		'pp_currency',
		'pp_discrate',
		'pp_discamt',
		'pp_amount',
		'pp_status',

	),
)); ?>
