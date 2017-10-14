<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
	'Transactions'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Transactions', 'url'=>array('index')),
	array('label'=>'New Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
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
    <div id="flag_desc_text">Manage Requisition Number</div>
</div>


<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'transactiongrid',
    'dataProvider'=>$model->search(),
    //'filter'=>$model,
    'columns'=>array(
        'cm_type',
        'cm_trncode',
        'cm_branch',
        'cm_lastnumber',
        'cm_increment',
        'cm_active',
        'inserttime',
        'insertuser',

        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("transaction/view/", 
                                            array("cm_type"=>$data->cm_type, "cm_trncode"=>$data->cm_trncode
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("transaction/update/", 
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
    ),
)); ?>
