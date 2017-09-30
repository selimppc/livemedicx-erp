<?php
/* @var $this JournaldtController */
/* @var $model Voucherdetail */

$this->breadcrumbs=array(
	'Voucherdetails'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Voucherdetail', 'url'=>array('index')),
	array('label'=>'Create Voucherdetail', 'url'=>array('create')),
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
    <div id="flag_desc_text"> Voucher Detail Information </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'voucherdetail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'am_vouchernumber',
		'am_accountcode',
		'am_subacccode',
		'am_currency',
		'am_exchagerate',
		/*
		'am_primeamt',
		'am_baseamt',
		'am_branch',
		'am_note',
		*/
		array(
            array(
                'class'=>'CButtonColumn',
                'header'=>'Action',
                'template'=>'{update}{delete}',

                'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
            ),
		),
	),
)); ?>
