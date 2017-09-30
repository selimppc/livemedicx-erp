<?php
/* @var $this SuppliermasterController */
/* @var $model Suppliermaster */

$this->breadcrumbs=array(
	'Supplier Masters'=>array('admin'),
	'New Supplier',
);

$this->menu=array(
	//array('label'=>'List Supplier Master', 'url'=>array('index')),
	array('label'=>'Manage Supplier Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
    <div id="flag_desc_text">
        <b>New Supplier Master</b>: In this screen, all of the required fields need to be filled before clicking the button “Save”. Fields marked with (*) are mandatory. You can go back to your homescreen to view supplier information(s) by clicking the menu tab <b>“Manage Supplier Master”</b>.
       </div>
</div>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>