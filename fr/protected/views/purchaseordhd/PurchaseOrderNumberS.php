<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Purchase'=>array('admin'),
	'Setting >> Class',
);

$this->menu=array(
	//array('label'=>'List Productmaster', 'url'=>array('index')),
	array('label'=>'New  Purchase Order Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Purchase Order Number', 'url'=>array('transaction/createpo')),
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
    <div id="flag_desc_text">Purchase Order</div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$result,
	
	'columns'=>array(
		//'id',
		'pp_purordnum',
		'pp_serialno',
		'cm_code',
		'pp_quantity',
		'pp_grnqty',
		'pp_unit',
		'pp_unitqty',
		'pp_purchasrate',
		'pp_currency',
    	
        array(
            'class'=>'CButtonColumn',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
            
        ),
	),
)); ?>
