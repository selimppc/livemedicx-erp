<?php
/* @var $this TransferdtController */
/* @var $model Transferdt */

$this->breadcrumbs=array(
	'Transfer'=>array('transferhd/admin'),
	//$model->id,
	'View Transfer Detail',
);

$this->menu=array(
	//array('label'=>'List Transfer Detail', 'url'=>array('index')),
	/*array('label'=>'New Transfer Detail',
			 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',
			'url'=>array('create', 'im_transfernum'=>$im_transfernum),
			'visible'=>$im_status=="Open",
	),*/
	//array('label'=>'Update Transfer Detail', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Transfer Detail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Transfer Detail', 'url'=>array('admin', 'im_transfernum'=>$im_transfernum, 'im_status'=>$im_status)),
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
    <div id="flag_desc_text"> View Transfer Detail </div>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'im_transfernum',
		'cm_code',
		'im_unit',
		'im_quantity',
		'im_rate',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
