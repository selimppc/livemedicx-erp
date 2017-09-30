<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
	'Invoice'=>array('smheader/admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'New Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('invoicehd/create')),
	array('label'=>'Manage Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/admin')),
	//array('label'=>'Post to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('smheader/postToGl')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
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
    <div id="flag_desc_text"><b>Gérer les factures:</b> Sur cet écran vous pouvez afficher l'historique des factures de vente. Pour afficher les détails d'un article, cliquer sur le lien dans la colonne <b>"Nombre de ventes"</b>.  Pour Annuler ou Confirmer, Cliquer sur le bouton dans la colonne <b>"Annuler la facture"</b> ou <b>"Annuler la facture "</b>.  Sous la rubrique <b>"Rapports "</b> , sélectionner  pdf ou xls pour visualiser le rapport.  Après confirmation de la facture un lien apparaîtra dans la colonne <b>"Numéro du Coupon"</b> pour regarder les rapports.  Pour créer une nouvelle facture cliquez sur l'onglet du menu  <b>"Nouvelle facture"</b>. cela va vous rediriger vers nouvel écran d'entrée.
    </div>
</div>

<h1></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sm-header-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'sm_number',
			array(
				'class'=>'CLinkColumn',
            	'header'=>'Nombre de ventes',
            	'labelExpression'=>'$data->sm_number',
                'urlExpression'=>'$data->sm_stataus=="Open" ? array("invoicedt/create","sm_number"=>$data->sm_number, "sm_date"=>$data->sm_date, "sm_storeid"=>$data->sm_storeid ) : array("invoicedt/admin","sm_number"=>$data->sm_number)',
            ),
		'sm_date',
        array( 'name'=>'customer_search', 'value'=>'$data->customer->cm_name' ),
		//'sm_sp',
		'sm_storeid',
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
        array(
            'class'=>'CLinkColumn',
            'header'=>'Numéro du coupon',
            'labelExpression'=>'$data->glvoucher',
            'urlExpression'=>'array("sareport/singleVoucher","pVoucherNo"=>$data->glvoucher)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),

		array(
            'class'=>'CButtonColumn',
			'header'=>'Annuler la facture ',
            'template'=>'{cancel}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
                'cancel'=> array
                (
                    'label'=>'Annuler la facture',     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/cancelInvoice/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/cancel.png',
        			'visible' => '$data->sm_stataus=="Open"',
                    'click'=>'function(){return confirm("Invoice will be Canceled. Continue ?");}'
                ),

            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Annuler la facture ',
            'template'=>'{confirm}',

            'buttons'=>array
            (
                'confirm'=> array
                (
                    'label'=>'Annuler la facture ',     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/approveStatus", array("id"=>$data->id,"sm_number"=>$data->sm_number ))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->sm_stataus=="Open"',
                ),
            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header' => 'Rapports',
            'template'=>'{toPDF}{toExcel}',
            'buttons'=>array
            (
                'toPDF' => array
                (
                    'label'=>'toPDF',
                    'url'=>'Yii::app()->createUrl("sareport/salesOrder/", array("psmnumber"=>$data->sm_number) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png',
                    'options'=>array('target'=>'_blank'),
                ),
                'toExcel' => array
                (
                    'label'=>'toExcel',
                    'url'=>'Yii::app()->createUrl("sareport/salesOrders/", array("psmnumber"=>$data->sm_number) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),

	),



)); ?>
