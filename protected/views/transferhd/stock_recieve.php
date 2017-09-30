<?php
/* @var $this TransferhdController */
/* @var $model Transferhd */

$this->breadcrumbs=array(
    'Inventory',
	'Stock Receive'=>array('stockReceive'),
	'Stock Receive',
);

$this->menu=array(
	//array('label'=>'List Transfer Header', 'url'=>array('index')),
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
    <div id="flag_desc_text"> <b>Stock Receive:</b> In this screen you will be able to confirm receive by clicking the button under the column <b>Confirm Receive</b>. You can also view full information, click on the button under the column<b>"View Full Information"</b> </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transferhd-grid',
	'dataProvider'=>$model->stockReceive($user),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'im_transfernum',
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
            'header'=>'View Full Information',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                        'url'=>'Yii::app()->createUrl("transferdt/admin", array("im_transfernum"=>$data->im_transfernum,"asDialog"=>1))',
                        //'url'=>'Yii::app()->createUrl("transferhd/view", array("id"=>$data->id,"asDialog"=>1))',
                        'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                // ajax post will use 'url' specified above
                                'url'=>"js:$(this).attr('href')",
                                'update'=>'#id_view',
                            ),
                        ),
                ),
            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Confirm Receive',
            'template'=>'{confirm}',

            'buttons'=>array
            (

                'confirm' => array(
                    'label'=>'Confirm Receive',     // text label of the button
                    'url'=>'Yii::app()->createUrl("transferhd/ConfirmReceived/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->im_status!=="Received" ',
                ),

            ),
        ),
	),
)); ?>



<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'stock_receive',
    'options'=>array(
        'title'=>'Stock Details',
        'width'=> 'auto',
        'height'=>'auto',
        'autoOpen'=>false,
        'resizable'=>true,
        'modal'=>true,
        'closeOnEscape' => true,
        'show'=>array('effect'=>'blur', 'duration'=>500,),
        'hide'=>array('effect'=>'blind', 'duration'=>500,),
    ),
    'htmlOptions' => array(
        'style' => 'font-size: 12px; line-height: 30px;',
    ),

)); ?>


    <div id="id_view"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>