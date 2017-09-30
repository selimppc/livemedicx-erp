<?php
/* @var $this BranchmasterController */
/* @var $model Branchmaster */

$this->breadcrumbs=array(
	'Branch Master'=>array('admin'),
	//$model->cm_branch=>array('view','id'=>$model->cm_branch),
	'Update Branch Master',
);

$this->menu=array(
	//array('label'=>'List Branch Master', 'url'=>array('index')),
	//array('label'=>'Create Branch Master', 'url'=>array('create')),
	array('label'=>'View Branch Master', 'url'=>array('view', 'cm_branch'=>$model->cm_branch)),
	array('label'=>'Manage Branch Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        <div id="flag_desc_text">Update Branch Master </div>
    </div>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>