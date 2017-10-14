<?php
/* @var $this SuppliermasterController */
/* @var $model Suppliermaster */

$this->breadcrumbs=array(
	'Supplier Masters'=>array('admin'),
	//$model->cm_supplierid,
	'View Supplier',
);

$this->menu=array(
	//array('label'=>'List Supplier Master', 'url'=>array('index')),
	array('label'=>'New Supplier Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	//array('label'=>'Update Supplier Master', 'url'=>array('update', 'id'=>$model->cm_supplierid)),
	//array('label'=>'Delete Supplier Master', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cm_supplierid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Supplier Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
    <div id="flag_desc_text">View Supplier Master</div>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cm_supplierid',
		'cm_group',
		'cm_orgname',
		'cm_address',
		'cm_district',
		'cm_post',
		'cm_policest',
		'cm_postcode',
		'cm_contactperson',
		'cm_phone',
		'cm_cellphone',
		'cm_fax',
		'cm_email',
		'cm_url',
		'cm_status',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
