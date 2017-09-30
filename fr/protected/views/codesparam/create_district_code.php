<?php
$this->breadcrumbs=array(
    'Master Setup',
	'Settings'=>array('codesparam/masterSetup'),
	'District Code',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('codesparam/masterSetup')),
	array('label'=>'New District Code', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('codesparam/CreateProductClass')),
    /*array('label'=>'Manage Product Class', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('productmaster/ProductClass')),
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Product Class Manage', 'url'=>array('productmaster/ProductClass')),
				array('label'=>'Product Group Manage', 'url'=>array('productmaster/ProductGroup')),
				array('label'=>'Product Category Manage', 'url'=>array('productmaster/ProductCategory')),
				array('label'=>'Unit Of Measurement Manage', 'url'=>array('productmaster/UnitOfMeasurement')),
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
        <b>District Code setup</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Enter District Code”</b>. Fields marked with (*) are mandatory. You can go back to your home screen to view all business setup tool(s) by clicking the menu tab <b>“Back to Settings”</b>. <b>Action</b> buttons will allow you to update and delete.
    </div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php echo $this->renderPartial('_form_district_code', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">
        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            District Code Details
        </h1>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$data,
            //'filter'=>$dataProvider,
            'columns'=>array(
                'cm_type',
                'cm_code',
                'cm_desc',
                //'cm_active',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (

                        
                        'delete'=> array
                        (
                            'url'=>
                            'Yii::app()->createUrl("codesparam/delete/",
                                                    array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
                                                    ))',
                        ),
                    ),
                ),
            ),
        )); ?>
    </div>
</div>


