<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Transfer'=>array('transferhd/admin'),
	'Transfer Number ',
);

$this->menu=array(
	//array('label'=>'List Transfer Detail', 'url'=>array('index')),
	array('label'=>'New Transfer Detail', 
		 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',
		'url'=>array('create', 'im_transfernum'=>$im_transfernum, 'im_status'=>$im_status ),
		'visible'=>$im_status=="Open",
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
    <div id="flag_desc_text"> Requisition Detail </div>
</div>



<?php 
	$updatearray = array
				(
					'label'=>'update',
					'url'=>
                    'Yii::app()->createUrl("transferdt/update/", 
                                            array("id"=>$data->id, "im_transfernum"=>$data->im_transfernum, "im_status"=>$data->im_status, 
											))',
					'visible'=>($im_status=="Open"?'true':'false'),
					//'options'=>array('onclick'=>$model->id),
				);
	$deletearray = array
				(
					'label'=>'delete',
					'visible'=>($im_status=="Open"?'true':'false'),
					//'options'=>array('onclick'=>$model->id),
				);
			
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	
	'columns'=>array(
		//'id',
		'im_transfernum',
		'cm_code',
		'cm_name',
		'im_unit',
		'im_quantity',
		'im_rate',
		//'im_status',

        array(
            'class'=>'CButtonColumn',
        	'header'=>'Action',
        	'template'=>'{view}{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


			'buttons'=>array
			(
				'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("transferdt/view/", 
                                            array("id"=>$data->id, "im_transfernum"=>$data->im_transfernum, "im_status"=>$data->im_status, 
											))',
                ),
				'update' => $updatearray,   
				'delete' => $deletearray, 
            ),
        ),
	),
)); ?>
