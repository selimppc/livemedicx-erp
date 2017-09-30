<?php
$this->breadcrumbs=array(
	'Customer Master'=>array('customermst/admin'),
	'Settings -> Manage Customer Transaction No',
);

$this->menu=array(
	array('label'=>'New Customer Transaction No', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/createCustmerTrnNo')),
    array('label'=>'Manage Customer Transaction No', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/manageCustmerTrnNo')),
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
    <div id="flag_desc_text"> Customer Transaction No </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	
	'columns'=>array(
		'cm_type',
		'cm_trncode',
		'cm_branch',
		'cm_lastnumber',
		'cm_increment',
		'cm_active',
		
		array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
  
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("transaction/updateCustmerTrnNo/", 
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
        ),
		
))); ?>

