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
	array('label'=>"L'En- tête  d'un nouveau transfert", 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
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
        <b>Gérer l'En- tête du Transfert</b>: Cet écran vous permettra de visualiser l'ensemble des détails du transfert ; vous pouvez rechercher les données spécifiques en sélectionnant n'importe quel  titre des colonnes. En cliquant sur les icônes dans la colonne <b>"Acte"</b> , vous serez capable de mettre à  jour et de supprimer. Vous pouvez également confirmer la répartition  en cliquant sur l'onglet <b>"confirmer la répartition "</b> de la colonne <b>"confirmer la répartition "</b>.




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
			'header'=>'Acte',
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
            'header'=>'confirmer la répartition',
            'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
            'template'=>'{confirm}',

            'buttons'=>array
            (

                'confirm' => array(
                    'label'=>'confirmer la répartition',     // text label of the button
                    'url'=>'Yii::app()->createUrl("transferhd/ConfirmStatus/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->im_status=="Open" ',
                ),

            ),
        ),
	),
)); ?>
