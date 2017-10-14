<?php
/* @var $this RequisitiondtController */
/* @var $model Requisitiondt */

$this->breadcrumbs=array(
	'Requisition'=>array('requisitionhd/admin'),
	'Manage',
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
    <div id="flag_desc_text">Requisition Details</div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-view-grid',
	'dataProvider'=>$model->searchEmployees(),
    'filter'=>$model,
	'columns'=>array(
		//'id',
		'pp_requisitionno',
		'cm_code',
		'pp_unit',
		'pp_quantity',

		'cm_supplierid',
		'pp_date',
		'pp_branch',
		'pp_note',
		'pp_status',
	
		array(
			'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>





