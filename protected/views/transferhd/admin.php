<?php
/* @var $this TransferhdController */
/* @var $model Transferhd */

$this->breadcrumbs=array(
    'Inventory',
	'Transfer header'=>array('admin'),
	'Manage Transfer Header',
);

$this->menu=array(
	//array('label'=>'List Transfer Header', 'url'=>array('index')),
	array('label'=>'New Transfer Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'IM Transfer Number', 'url'=>array('transaction/ManageImTranNum')),
	),
	),*/
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
    <div id="flag_desc_text">
        <b>Manage Transfer Header</b>: This screen will allow you to view the overall Transfer Header’s detail; you can search specific data by selecting any title columns. By clicking the icons under <b>“Action”</b> column will allow you to update and delete. You can also confirm Dispatch by clicking the button <b>“ Confirm Dispatch”</b> under the column <b>” Confirm Dispatch” </b>.




         </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transferhd-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'im_transfernum',
				array(
					'class'=>'CLinkColumn',
                    'header'=>'Transfer Number',
                    'labelExpression'=>'$data->im_transfernum',
                    //'urlExpression'=>'array("transferdt/create","im_transfernum"=>$data->im_transfernum, "im_status"=>$data->im_status)',
                    'urlExpression'=>'$data->im_status=="Open" ? array("transferdt/create","im_transfernum"=>$data->im_transfernum, "im_status"=>$data->im_status, "branch"=>$data->im_fromstore) :
                            array("transferdt/admin","im_transfernum"=>$data->im_transfernum)',
                    ),
		'im_date',
		'im_condate',
		// 'im_note',
		'im_fromstore',
        'im_fcur',
        'im_fexchrate',
		'im_tostore',
        'im_tcur',
        'im_texchrate',
		'im_status',

		array(
			'class'=>'CButtonColumn',
			'header'=>'Action',
			'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
			'template'=>'{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

			'buttons'=>array
			(
				'update' => array
				(
					'label'=>'update',
					'visible'=>'$data->im_status=="Open"',
					//'options'=>array('onclick'=>$model->id),
				),   
				
				'delete' => array
				(
					'label'=>'delete',
					'visible'=>'$data->im_status=="Open"',
					//'options'=>array('onclick'=>$model->id),
				),  

			),
		),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Confirm Dispatch',
            'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
            'template'=>'{confirm}',

            'buttons'=>array
            (

                'confirm' => array(
                    'label'=>'Confirm Dispatch',     // text label of the button
                    'url'=>'Yii::app()->createUrl("transferhd/ConfirmStatus/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->im_status=="Open" ',
                ),

            ),
        ),
	),
)); ?>
