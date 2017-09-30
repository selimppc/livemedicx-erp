<?php
$this->breadcrumbs=array(
	'Customer Master'=>array('customermst/admin'),
	'Settings >> Manage Market',
);


$this->menu=array(
	array('label'=>'New Market', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('codesparam/CreateMarket')),
    array('label'=>'Manage Market', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageMarket')),
	// array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
	// 	'items'=>array(
	// 			array('label'=>'Customer Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageCustomerGroup')),
	// 			array('label'=>'Market', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageMarket')),
	//),
	//),
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
    <div id="flag_desc_text">Manage Market</div>
</div>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'codesparamgrid',
    'dataProvider'=>$dataProvider,
    //'filter'=>$model,
    'columns'=>array(
        'cm_type',
        'cm_code',
        'cm_branch',
        'cm_active',

		/*
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/view/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/update/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
                'delete'=> array
                (	
                    'url'=>
                    'Yii::app()->createUrl("codesparam/delete/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                'visible'=> '$data->cm_active=="0"',
                ),
            ),
        ), */
    ),
)); ?>
