<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Voucher Header'=>array('admin'),
	'Manage Receipt Voucher',
);

$this->menu=array(
	//array('label'=>'List Voucher Header', 'url'=>array('index')),
	array('label'=>'New Receipt Voucher', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('ReceiptVoucherCreate')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Voucher No', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/managevoucherno')),
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
    <div id="flag_desc_text"> Manage Receipt Voucher </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vouhcerheader-grid',
	'dataProvider'=>$model->searchReceiptVoucher(),
	'filter'=>$model,
	'columns'=>array(

			array(
					'class'=>'CLinkColumn',
                    'header'=>'Voucher Number',
                    'labelExpression'=>'$data->am_vouchernumber',
                    'urlExpression'=>'array("vouhcerheader/viewGlTrn","am_vouchernumber"=>$data->am_vouchernumber,
                    "am_date"=>$data->am_date, "am_year"=>$data->am_year, "am_period"=>$data->am_period,
                    )',
                ),
		'am_date',
		'am_referance',
		'am_year',
		'am_period',
		'am_branch',
		'am_note',
		'am_status',

		array(
			'class'=>'CButtonColumn',
			'header' => 'Action',
			'template'=> '{view}',
		),
	),
)); ?>
