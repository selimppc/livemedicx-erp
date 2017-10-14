<?php
/* @var $this RequisitiondtController */
/* @var $model Requisitiondt */

$this->breadcrumbs=array(
    'Purchase',
	'Requisition'=>array('requisitionhd/admin'),
	'Requisition Entry Detail',
);

$this->menu=array(
	array('label'=>'<< Go Back to Header', 'url'=>array('requisitionhd/admin')),
	//array('label'=>'New Requisition Entry Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create', 'pp_requisitionno'=>$pp_requisitionno)),
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
    <div id="flag_desc_text">In this screen you can view only Requisition Details information. You can not create any details because it's status is not Open. You can go back to Voucher Header to view all Voucher Header information at a glance by clicking the menu tab <b>"<< Go Back to Header"</b>. </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'requisitiondt-grid',
	'dataProvider'=>$model->search($pp_requisitionno),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'pp_requisitionno',
		'cm_code',
        array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
		'pp_unit',
		'pp_quantity',
		/*
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/

	),
)); ?>
