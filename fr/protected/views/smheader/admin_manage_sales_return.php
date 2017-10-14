<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
	'Sales Return'=>array('smheader/adminsalesreturn'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Manage Sales Return',  'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/adminmanagesalesreturn')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Sales Return No', 'url'=>array('transaction/managesalesreturnno')),
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
    <div id="flag_desc_text">New Sales Return</div>
</div>


<p style="font-style: italic; color: #666;"> please click appropiate invoice number</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sm-header-grid',
	'dataProvider'=>$model->searchManageReturn(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'sm_number',
		array(
					'class'=>'CLinkColumn',
                    'header'=>'Sales Number',
                    'labelExpression'=>'$data->sm_number',
                    'urlExpression'=>'array("smheader/salesmanagedetails","sm_number"=>$data->sm_number)',
                    ),
		'sm_date',
		'cm_cuscode', //with customer name
		'sm_sp',
		//'sm_doc_type',
		//'sm_territory',
		//'sm_rsm',
		//'sm_area',
		'sm_payterms',
		'sm_totalamt',
		'sm_total_tax_amt',
		//'sm_disc_rate',
		'sm_disc_amt',
		'sm_netamt',
		//'sm_sign',
		'sm_stataus',

	),
)); ?>
