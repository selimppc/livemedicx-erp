<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
	'Invoice'=>array('smheader/admin'),
	'Invoice Details',
);

$this->menu=array(
    array('label'=>'<< Back to Invoice', 'url'=>array('smheader/admin')),

	/*array('label'=>'New Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('smheader/create')),
	array('label'=>'Manage Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/admin')),
	array('label'=>'Post to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('smheader/postToGl')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Invoice No', 'url'=>array('transaction/manageinvoiceno')),
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
    <div id="flag_desc_text">Invoice Details # <?php echo $sm_number; ?></div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sm-header-grid',
	'dataProvider'=>$model->searchInvoiceDetail($sm_number),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'sm_number',
		'cm_code',
		'cm_name',
		'sm_unit',
		'sm_rate',
		'sm_bonusqty',
		'sm_quantity',
		'sm_tax_rate',
		'sm_tax_amt',
		'sm_lineamt',

	),
)); ?>
