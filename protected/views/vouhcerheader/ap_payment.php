<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Account Payable'=>array('vouhcerheader/appayment'),
	'New  Account Payable',
);

$this->menu=array(
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
    <div id="flag_desc_text"> <b>Account Payable:</b> This screen will allow you to view supplier(s) invoice payable list. For payment, click on the link under <b>Supplier Code</b> column. The link will redirect you to a new entry screen for the Payment Voucher.</div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grndetail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'suppliercode',
		array(
					'class'=>'CLinkColumn',
                    'header'=>'Supplier Code',
                    'labelExpression'=>'$data->suppliercode',
					'urlExpression'=>'array("vouhcerheader/appaymentvoucher",
					        "suppliercode"=>$data->suppliercode, "suppliername"=>$data->suppliername,
					        "accoutcode"=>$data->accoutcode, "branch"=>$data->branch,
					        )',
                    ),
		'suppliername',
        'branch',
		'accoutcode',
        'description',
		'conperson',
		'payableamt',

	),
)); ?>
