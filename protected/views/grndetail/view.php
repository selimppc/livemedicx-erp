<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */

$this->breadcrumbs=array(
	'GRN Detail'=>array('admin'),
	//$model->id,
	'View GRN Detail',
);

$this->menu=array(
	//array('label'=>'List Grndetail', 'url'=>array('index')),
	array('label'=>'New View GRN Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	//array('label'=>'Update Grndetail', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Grndetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GRN Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
    <div id="flag_desc_text">View GRN Detail</div>
</div>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'im_grnnumber',
		'cm_code',
		'im_BatchNumber',
		'im_ExpireDate',
		'im_RcvQuantity',
		'im_costprice',
		'im_unit',
		'im_unitqty',
		'im_rowamount',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
