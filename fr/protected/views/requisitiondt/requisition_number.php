<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Requisition'=>array('requisitionhd/admin'),
	'Requisition Entry Detail',
);

$this->menu=array(
	//array('label'=>'List Requisition', 'url'=>array('index')),
	array('label'=>'New Requisition Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create', 'pp_requisitionno'=>$pp_requisitionno)),

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
    <div id="flag_desc_text">Requisition Detail # <?php echo $pp_requisitionno; ?></div>
</div>

<h1> </h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	
	'columns'=>array(
		//'id',
		'pp_requisitionno',
		'cm_code',
		'cm_name',
		'pp_unit',
		'pp_quantity',
    	
        array(
            'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
            	'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("requisitiondt/view/", 
                                            array("id"=>$data->id, "pp_requisitionno"=>$data->pp_requisitionno
											))',
                ),
                
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("requisitiondt/update/", 
                                            array("id"=>$data->id, "pp_requisitionno"=>$data->pp_requisitionno
											))',
                ),

            
        ),
            
        ),
	),
)); ?>
