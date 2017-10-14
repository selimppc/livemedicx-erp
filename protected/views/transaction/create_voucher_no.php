<?php
$this->breadcrumbs=array(
    'General Ledger',
	'Settings'=>array('transaction/glsettings'),
	'New Voucher Number',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('transaction/glsettings')),
    array('label'=>'New Voucher Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/createvoucherno')),
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
        In this screen you need to fill in all the fields, before clicking the button <b>"Enter Voucher No"</b>, a Voucher detail has been created on your right hand side table, under <b>Voucher No Details</b>.
        You can go back to the Settings for viewing all GL Setup tools by clicking the menu tab <b>“<< Back to Settings”</b>.

    </div>
</div>

<div style="width: 98%; float: left;">
    <div style="width: 46%; float: left; margin-right: 3%;">
        <?php echo $this->renderPartial('_from_voucher_no', array('model'=>$model)); ?>
    </div>

    <div style="width: 51%; float: left;">

        <h1 style="background: #FFCCFF; padding: 5px; width: 98%; font-weight: bold; text-align: center;">
            Voucher No Details
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$voucherNo,
            //'filter'=>$result,

            'columns'=>array(
                'cm_type',
                'cm_trncode',
                'cm_branch',
				'cm_lastnumber',
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
                            'Yii::app()->createUrl("transaction/UpdateVoucherNo/",
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






