<?php
/* @var $this CustomermstController */
/* @var $model Customermst */

$this->breadcrumbs=array(
	'Customer Master'=>array('admin'),
	$model->cm_cuscode,
);

$this->menu=array(
	array('label'=>'New Customer', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
	array('label'=>'Manage Customer', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}',  'url'=>array('admin')),
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
    <div id="flag_desc_text">View Customer Master # <?php echo $model->cm_cuscode; ?></div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cm_cuscode',
		'cm_name',
		'cm_address',
		'cm_territory',
		'cm_cellnumber',
		'cm_phone',
		'cm_fax',
		'cm_email',
		'cm_branch',
		'cm_market',
		'cm_sp',
		'cm_creditlimit',
		'cm_hub',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
