<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */

$this->breadcrumbs=array(
	'Manage GRN'=>array('purchaseordhd/ViewGrn'),
	'Manage GRN Detail'=>array('admin', 'im_grnnumber'=>$im_grnnumber,),
	'Update GRN Detail',
);

$this->menu=array(
	//array('label'=>'List Grndetail', 'url'=>array('index')),
	//array('label'=>'Create Grndetail', 'url'=>array('create')),
	//array('label'=>'View Grndetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GRN Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin', 'im_grnnumber'=>$im_grnnumber,  )),
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
    <div id="flag_desc_text">Update GRN Detail <?php echo $im_grnnumber; ?></div>
</div>



<?php $this->renderPartial('_form_update_grndt', array('model'=>$model, 'cm_code'=>$cm_code,)); ?>