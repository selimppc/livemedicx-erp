<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Account Payable'=>array('vouhcerheader/appayment'),
	'Accounts Payable',
);

$this->menu=array(
    array('label'=>'<< Back to Account Payable List', 'url'=>array('vouhcerheader/appayment')),
	array('label'=>'Manage Account Payable', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('vouhcerheader/manageAcPayment')),
);
?>

<style type="text/css">
	table .money-receipt-sales, td, th
	{
		border: 1px solid #4E8EC2;
	}

</style>


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
    <div id="flag_desc_text">In this screen you will be able to view the Payable History after Account Payable. You can also view the detail report by clicking the link under the <b>GL Voucher No</b>.
    </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grndetail-grid',
	'dataProvider'=>$model->searchAcPayment(),
	//'filter'=>$model,
	'columns'=>array(
		//'am_vouchernumber',
        array(
            'class'=>'CLinkColumn',
            'header'=>'GL Voucher No',
            'labelExpression'=>'$data->am_vouchernumber',
            'urlExpression'=>'array("sareport/singleVoucher","pVoucherNo"=>$data->am_vouchernumber)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),

		'am_date',
        'am_branch',
        'am_note',
		'am_status',

	),
)); ?>
