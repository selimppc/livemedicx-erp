<?php
$this->breadcrumbs=array(
	'Transfer'=>array('transferhd/admin'),
	'New IM Transfer Number',
);

$this->menu=array(
	array('label'=>'New IM Transfer Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/CreateImTrnNum')),
    /*array('label'=>'Manage IM Transfer Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/ManageImTranNum')),
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
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
    <div id="flag_desc_text">New IM Transfer Number</div>
</div>




<div style="width: 98%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php echo $this->renderPartial('_from_im_trn_num', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">
		
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$imTrnNum,
            //'filter'=>$result,

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
                            'Yii::app()->createUrl("transaction/updateImTrnNum/",
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