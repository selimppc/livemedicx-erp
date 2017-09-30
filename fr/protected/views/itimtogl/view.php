<?php
/* @var $this ItimtoglController */
/* @var $model Itimtogl */

$this->breadcrumbs=array(
	'Itimtogls'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Itimtogl', 'url'=>array('index')),
	array('label'=>'Create Itimtogl', 'url'=>array('create')),
	array('label'=>'Update Itimtogl', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Itimtogl', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Itimtogl', 'url'=>array('admin')),
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
    <div id="flag_desc_text">View Itimtogl #<?php echo $model->id; ?></div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'c_branch',
		'c_trncode',
		'c_group',
		'c_accdr',
		'c_acccr',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
