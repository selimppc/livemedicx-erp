<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
    'Purchase Module',
    'Settings'=>array('transaction/purchaseSettings'),
	'New Purchase Order Number',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('transaction/purchaseSettings')),
	array('label'=>'New Purchase Order Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/createpo')),
    //array('label'=>'Manage Purchase Order Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/ManagePurchaseOrdNum')),
		/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Purcahse Order Number', 'url'=>array('transaction/ManagePurchaseOrdNum')),
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
    <div id="flag_desc_text"> New Purchase Order Number </div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 46%; margin-right: 3%; float: left;">
        <h1 style="background: #d3d3d3; padding: 7px; width: 85%; font-weight: bold;">
            Enter Purchase Order Number
        </h1>
            <?php echo $this->renderPartial('purchase_order_form', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">
        <h1 style="background: #d3d3d3; padding: 7px; width: 85%; font-weight: bold;">
            Purchase Order NO list
        </h1>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$purchase,
            //'filter'=>$requisition,

            'columns'=>array(
                'cm_type',
                'cm_trncode',
                'cm_branch',
                'cm_lastnumber',
                //'cm_increment',
                //'cm_active',

                /*array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>
                            'Yii::app()->createUrl("transaction/UpdatePurchaseOrderNumber/",
                                                    array("cm_type"=>$data->cm_type, "cm_trncode"=>$data->cm_trncode
                                                    ))',
                        ),
                        'delete'=> array
                        (
                            'url'=>
                            'Yii::app()->createUrl("transaction/delete/",
                                                    array("cm_type"=>$data->cm_type, "cm_trncode"=>$data->cm_trncode
                                                    ))',
                        ),
                    ),
                ),*/

            ))); ?>
    </div>
</div>