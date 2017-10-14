<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
	'Supplier Master'=>array('suppliermaster/admin'),
	//'View'=>array('viewsm', 'cm_type'=>$model->cm_type, 'cm_code'=>$model->cm_code),
	'Settings >> Update Supplier Group',
);

$this->menu=array(
	//array('label'=>'List Codesparam', 'url'=>array('index')),
	//array('label'=>'Create Codesparam', 'url'=>array('create')),
	//array('label'=>'View Codesparam', 'url'=>array('view', 'cm_type'=>$model->cm_type, 'cm_code'=>$model->cm_code)),
	//array('label'=>'Manage Codesparam', 'url'=>array('admin')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Supplier Group Manage', 'url'=>array('suppliermaster/SupplierGroup')),
	),
	),
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
    <div id="flag_desc_text">Update <?php echo $model->cm_type; ?></div>
</div>




<?php echo $this->renderPartial('_form_supplier_group', array('model'=>$model)); ?>
