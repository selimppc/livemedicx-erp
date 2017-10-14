<?php
/* @var $this GroupthreeController */
/* @var $model Groupthree */

$this->breadcrumbs=array(
	'Group Three'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'New Group Three', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Update Group Three', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/update_a.png" /></span>{menu}', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Group Three', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
    <div id="flag_desc_text">View Group Three #<?php echo $model->id; ?></div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'am_groupone',
		'am_grouptwo',
		'am_groupthree',
		'am_description',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
