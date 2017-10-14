<?php
/* @var $this TransferhdController */
/* @var $model Transferhd */

$this->breadcrumbs=array(
    'Inventory',
	'Transfer Header'=>array('admin'),
	'New Transfer Header',
);

$this->menu=array(
    array('label'=>'New Transfer Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Transfer Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        <b>New Transfer Header </b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Add Transfer Header”</b>. Fields marked with (*) are mandatory. You can go back to your homescreen to view Transfer Header’s information by clicking the menu tab <b>“Manage Transfer Header”</b>. Also you can add new voucher details on existing Transfer by clicking the link under <b> “Transfer  Number” </b> column; this link will redirect you to Transfer detail page. <b>Action</b> buttons will allow you to update and delete.

    </div>
</div>

<div style="width: 98%; float: left;">

    <div style="width: 47%; float: left; margin-right: 3%;">
        <h1 style="background: #FFCCFF; padding: 7px; width: 85%; font-weight: bold; border-radius: 5px;">
            Enter Transfer Header Information
        </h1>
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>

    <div style="width: 50%; float: left;">

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'transferhd-grid',
            'dataProvider'=>$transaferhd->search(),
            'filter'=>$transaferhd,
            'columns'=>array(
                //'id',
                //'im_transfernum',
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Transfer Number',
                    'labelExpression'=>'$data->im_transfernum',
                    'urlExpression'=>'$data->im_status=="Open" ? array("transferdt/create","im_transfernum"=>$data->im_transfernum, "im_status"=>$data->im_status, "branch"=>$data->im_fromstore) :
                            array("transferdt/admin","im_transfernum"=>$data->im_transfernum)',
                ),
                //'im_date',
                'im_condate',
                // 'im_note',
                'im_fromstore',
                //'fromstore',
                'im_tostore',
                //'tostore',
                //'im_status',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
                    'template'=>'{update}{delete}{confirm}',

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

                        'confirm' => array(
                            'label'=>'Confirm Transfer',     // text label of the button
                            'url'=>'Yii::app()->createUrl("transferhd/ConfirmStatus/", array("id"=>$data->id))',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                            'visible' => '$data->im_status=="Open" ',
                        ),

                    ),
                ),
            ),
        )); ?>
    </div>
</div>
