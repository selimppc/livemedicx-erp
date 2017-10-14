<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Supplier Master'=>array('admin'),
	'Setting >> Supplier Group',
);

$this->menu=array(
	//array('label'=>'List Supplier Master', 'url'=>array('index')),
	array('label'=>'New Supplier Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('codesparam/CreateSupplierGroup')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Supplier Group Manage', 'url'=>array('suppliermaster/SupplierGroup')),
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
    <div id="flag_desc_text">Supplier Group</div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	'columns'=>array(
		'cm_type',
		'cm_code',
		'cm_desc',
		'cm_active',
		//'inserttime',
		//'updatetime',
		'insertuser',
		//'updateuser',

    	
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/viewsm/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/updatesm/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
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
