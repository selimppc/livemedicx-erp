<?php
/* @var $this RequisitiondtController */
/* @var $model Requisitiondt */

$this->breadcrumbs=array(
	'Requisition'=>array('requisitionhd/admin'),
	'View Requisition Entry Detail',
);

$this->menu=array(
	//array('label'=>'List Requisition Details', 'url'=>array('index')),
	//array('label'=>'Create Requisition Details', 'url'=>array('create')),
	//array('label'=>'Update Requisition Details', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Requisition Details', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Requisition Details', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin' , 'pp_requisitionno'=>$pp_requisitionno)),
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
    <div id="flag_desc_text">View Requisition Details # <?php echo $model->pp_requisitionno; ?></div>
</div>

<p>&nbsp;</p>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'pp_requisitionno',
		'cm_code',
		'pp_unit',
		'pp_quantity',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>





