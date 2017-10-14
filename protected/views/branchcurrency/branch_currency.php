<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(

	'Requisition'=>array('index'),
	'Setting >> Requisition Detail',
);

$this->menu=array(
	//array('label'=>'List Requisition', 'url'=>array('index')),
	array('label'=>'New Requisition Detail', 'url'=>array('create', 'pp_requisitionno'=>$pp_requisitionno)),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Product Class', 'url'=>array('codesparam/CreateProductClass')),
				array('label'=>'Product Group', 'url'=>array('codesparam/CreateProductGroup')),
				array('label'=>'Product Category', 'url'=>array('codesparam/CreateProductCategory')),
				array('label'=>'Unit Of Measurement', 'url'=>array('codesparam/UnitOfMeasurement')),
	),
	),
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
    <div id="flag_desc_text">  Requisition Detail # <?php echo $pp_requisitionno; ?> </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	
	'columns'=>array(
		'id',
		'pp_requisitionno',
		'cm_code',
		'pp_unit',
		'pp_quantity',
    	
        array(
            'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
	),
)); ?>
