<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Account Payable'=>array('vouhcerheader/appayment'),
	'New  Account Payable',
);

$this->menu=array(
	array('label'=>'Gérer les  comptes à  payer', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('vouhcerheader/manageAcPayment')),
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
    <div id="flag_desc_text"> <b>Compte à  payer:</b> Cet écran vous permettra de visualiser la  liste des factures des fournisseur (s) à payer. Pour le paiement, cliquer sur le lien dans la colonne <b>" Code du Fournisseur "</b>.  Le lien vous redirigera vers un nouvel écran d'entrée pour le coupon de paiement. </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grndetail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'suppliercode',
		array(
					'class'=>'CLinkColumn',
                    'header'=>'Code du fournisseur',
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
