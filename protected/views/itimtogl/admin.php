<?php
/* @var $this ItimtoglController */
/* @var $model Itimtogl */

$this->breadcrumbs=array(
	'Itimtogls'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Itimtogl', 'url'=>array('index')),
	//array('label'=>'Create Itimtogl', 'url'=>array('create')),
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
    <div id="flag_desc_text">Manage</div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'itimtogl-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'c_branch',
		'c_trncode',
		'c_group',
		'c_accdr',
		'c_acccr',
		/*
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
		array(
			'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
