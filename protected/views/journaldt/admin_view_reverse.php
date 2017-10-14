<?php
/* @var $this JournaldtController */
/* @var $model Voucherdetail */

$this->breadcrumbs=array(
    'General Ledger',
    'Reverse Voucher'=>array('journal/admin'),
    'View Voucher Detail',
);

$this->menu=array(
    array('label'=>'<< Go Back to Header', 'url'=>array('journal/adminReverse')),
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
    <div id="flag_desc_text"> Voucher Detail Information # <b style="color: blue;"> <?php echo $am_vouchernumber; ?> </b></div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vwvoucher-grid',
	'dataProvider'=>$model->search($am_vouchernumber),
	'filter'=>$model,
	'columns'=>array(
		'am_accountcode',
		'am_description',
		'am_currency',
		'am_exchagerate',
		'prime_debit',
        'prime_credit',
        'base_debit',
        'base_credit',


        array(
            'class'=>'CButtonColumn',
            'header' => 'Reports',
            'template'=>'{toPDF}{toExcel}',
            'buttons'=>array
            (
                'toPDF' => array
                (
                    'label'=>'toPDF',
                    'url'=>'Yii::app()->createUrl("sareport/singleVoucher/", array("pVoucherNo"=>$data->am_vouchernumber) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png',
                    'options'=>array('target'=>'_blank'),
                ),
                'toExcel' => array
                (
                    'label'=>'toExcel',
                    'url'=>'Yii::app()->createUrl("sareport/singleVoucher/", array("pVoucherNo"=>$data->am_vouchernumber) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),
	),
)); ?>
