<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
    'Sales',
	'Settings'=>array('transaction/salesSettings'),
	'Sales Return Number',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('transaction/salesSettings')),
    //array('label'=>'New Sales Return Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/createSalesReturnNo')),

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
    <div id="flag_desc_text">New Sales Return Number</div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 46%; float: left; margin-right: 3%;">
        <?php echo $this->renderPartial('_from_sales_return_no', array('model'=>$model)); ?>
    </div>

    <div style="width: 51%; float: left;">

        <h1 style="background: #d3d3d3; padding: 5px; width: 98%; font-weight: bold;">
            Maintenance Sales Return Numbers :: Settings can be changed by System Administrator Only.
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$salesReturn,
            //'filter'=>$result,

            'columns'=>array(
                'cm_type',
                'cm_trncode',
                'cm_branch',
				'cm_lastnumber',
				/*
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
                            'Yii::app()->createUrl("transaction/updateSalesReturnNo/",
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
