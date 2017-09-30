<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
	'Sm Headers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Smheader', 'url'=>array('create')),
	array('label'=>'Update Smheader', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Smheader', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Smheader', 'url'=>array('admin')),
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
    <div id="flag_desc_text">View Smheader #<?php echo $model->id; ?></div>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sm_number',
		'sm_date',
		'cm_cuscode',
		'sm_sp',
		'sm_doc_type',
		'sm_territory',
		'sm_rsm',
		'sm_area',
		'sm_payterms',
		'sm_totalamt',
		'sm_total_tax_amt',
		'sm_disc_rate',
		'sm_disc_amt',
		'sm_netamt',
		'sm_sign',
		'sm_stataus',
		'sm_refe_code',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
