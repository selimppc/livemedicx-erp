<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Master Setup',
	'Service Product'=>array('service'),
	'Service Master',
);

$this->menu=array(
	array('label'=>'New Service', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('service')),
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
        In this screen all of the required fields need to be filled before clicking the button <b>“Enter Service”</b>. You will be able to view the service and details table on your right-hand side corner. By clicking icons under <b>“Action”</b> column will allow you to update and delete.
        </div>
</div>

<div style="width: 98%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php $this->renderPartial('_form_service', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">

        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            Service List & Details
        </h1>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'productmaster-grid',
            'dataProvider'=>$data,
            'columns'=>array(
                array(
                    'name'=>'cm_code',
                    'htmlOptions'=>array('style'=>'width: 100px; text-align: left;'),
                ),
                array(
                    'name'=>'image',
                    'type' => 'html',
                    //'value'=>'!empty($data->image)?CHtml::image(Yii::app()->baseUrl.$data->image):CHtml::image(Yii::app()->baseUrl."/images/product_icon.png")',
                    'value'=>'!empty($data->image)?CHtml::image($data->image):CHtml::image(Yii::app()->baseUrl."/images/product_icon.png")',
                    'htmlOptions'=>array('style'=>'width: 50px; text-align: center;', 'class'=>'product-image'),
                ),
                'cm_name',
                //'cm_description',
                //'cm_class',
                //'cm_group',
                //'cm_category',
                'cm_sellrate',
                'currency',
                'exchange_rate',

                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>
                            'Yii::app()->createUrl("productmaster/updateService/",
                                                    array("cm_code"=>$data->cm_code,
                                                    ))',
                        ),
                        'delete'=> array
                        (
                            'url'=>
                            'Yii::app()->createUrl("productmaster/delete/",
                                                    array("cm_code"=>$data->cm_code,
                                                    ))',
                        ),
                    ),
                ),
            ),
        )); ?>
    </div>
</div>

