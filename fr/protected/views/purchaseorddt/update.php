<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */

$this->breadcrumbs=array(
	'Purchase '=>array('purchaseordhd/admin'),
	//$model->id=>array('view','id'=>$model->id),
	'Update Purchase Order Detail',
);

$this->menu=array(
	//array('label'=>'List Purchase Order Details', 'url'=>array('index')),
	//array('label'=>'Create Purchase Order Details', 'url'=>array('create')),
	array('label'=>'View Purchase Order Details', 'url'=>array('view', 'id'=>$model->id , 'pp_purordnum'=>$pp_purordnum, 'pp_status'=>$pp_status)),
	array('label'=>'Manage Purchase Order Details', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('PurchaseOrderNumberS1', 'pp_purordnum'=>$pp_purordnum, 'pp_status'=>$pp_status )),
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
    <div id="flag_desc_text">Update Purchase Order Details:: You Can chnage the data / information as your needs. Then Click on Save.</div>
</div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>