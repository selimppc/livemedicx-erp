<?php
/* @var $this TransferdtController */
/* @var $model Transferdt */

$this->breadcrumbs=array(
    'Inventory',
	'Transfer Header'=>array('transferhd/admin'),
	'New Transfer Detail',
);

$this->menu=array(
	array('label'=>'<< Back to Transfer Header', 'url'=>array('transferhd/admin')),
	//array('label'=>'New Transfer Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create' ,'im_transfernum'=>$im_transfernum)),
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
        In this screen you need to fill in the fields, before clicking the button <b>“Add Transfer Detail”</b>. Fields marked with (*) are mandatory. You can go back to Transfer Header to view all Transfer Header information at a glance by clicking the menu tab <b>“<< Back to Transfer Header”</b>.<b> Action</b> button will allow you to update and delete.
    </div>
</div>

<div style="width: 98%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php $this->renderPartial('_form', array('model'=>$model, 'branch'=>$branch,)); ?>
    </div>
    <div style="width: 50%; float: left;">

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'transferdt-grid',
            'dataProvider'=>$transferdt->search($im_transfernum),
            'filter'=>$transferdt,
            'columns'=>array(
                'cm_code',
                array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
                'im_unit',
                'im_quantity',
                'im_rate',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>
                            'Yii::app()->createUrl("transferdt/update/",
                                                    array("id"=>$data->id, "im_transfernum"=>$data->im_transfernum,
                                                    ))',
                        ),

                    ),
                ),
            ),
        )); ?>
    </div>
</div>
